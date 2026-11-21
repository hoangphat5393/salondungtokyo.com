<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;
use Symfony\Component\Process\Process;
use ZipArchive;

class DatabaseExportService
{
    public const FORMAT_MYSQL = 'mysql';

    public const FORMAT_PGSQL = 'pgsql';

    public const FORMAT_MONGODB = 'mongodb';

    /**
     * @var array<int, string>
     */
    public const SUPPORTED_FORMATS = [
        self::FORMAT_MYSQL,
        self::FORMAT_PGSQL,
        self::FORMAT_MONGODB,
    ];

    public function __construct(
        protected MysqlExportService $mysqlExportService
    ) {}

    /**
     * @return array<string, array{
     *     format: string,
     *     label: string,
     *     extension: string,
     *     ready: bool,
     *     status_text: string,
     *     dump_exists: bool,
     *     filename: string,
     *     size_bytes: int,
     *     size_human: string|null,
     *     updated_at: string|null,
     *     download_url: string
     * }>
     */
    public function getAllStatuses(): array
    {
        $mysqlStatus = $this->mysqlExportService->getStatus();
        $defaultConn = (string) config('database.default', 'mysql');
        $isMysqlNative = in_array($defaultConn, ['mysql', 'mariadb'], true);
        $activeConnected = $isMysqlNative ? $mysqlStatus['mysql_connected'] : $mysqlStatus['pgsql_connected'];

        $pgDumpBinary = $this->resolvePgDumpBinary();
        $zipLoaded = extension_loaded('zip');

        $pgsqlMeta = $this->readFileMeta($this->getDumpPath(self::FORMAT_PGSQL));
        $mongoMeta = $this->readFileMeta($this->getDumpPath(self::FORMAT_MONGODB));

        return [
            self::FORMAT_MYSQL => [
                'format' => self::FORMAT_MYSQL,
                'label' => 'MySQL / MariaDB (.sql)',
                'extension' => 'sql',
                'ready' => $isMysqlNative
                    ? $mysqlStatus['mysql_connected']
                    : ($mysqlStatus['pgsql_connected'] && $mysqlStatus['mysql_connected']),
                'status_text' => $isMysqlNative
                    ? ($mysqlStatus['mysql_connected'] ? 'Sẵn sàng (mysqldump trực tiếp)' : 'Mất kết nối MySQL/MariaDB')
                    : (($mysqlStatus['pgsql_connected'] && $mysqlStatus['mysql_connected']) ? 'Sẵn sàng (PostgreSQL + MySQL Sync)' : 'Cần bật cả PostgreSQL & MySQL'),
                'dump_exists' => $mysqlStatus['dump_exists'],
                'filename' => $mysqlStatus['filename'],
                'size_bytes' => $mysqlStatus['size_bytes'],
                'size_human' => $mysqlStatus['size_human'],
                'updated_at' => $mysqlStatus['updated_at'],
                'download_url' => route('admin.database-maintenance.download', ['format' => self::FORMAT_MYSQL]),
            ],
            self::FORMAT_PGSQL => [
                'format' => self::FORMAT_PGSQL,
                'label' => 'PostgreSQL (.sql)',
                'extension' => 'sql',
                'ready' => ! $isMysqlNative && $mysqlStatus['pgsql_connected'] && $pgDumpBinary !== null,
                'status_text' => $isMysqlNative
                    ? 'Dự án đang chạy MariaDB/MySQL'
                    : (! $mysqlStatus['pgsql_connected']
                        ? 'Mất kết nối PostgreSQL'
                        : ($pgDumpBinary !== null ? 'Sẵn sàng (pg_dump)' : 'Không tìm thấy pg_dump')),
                'dump_exists' => $pgsqlMeta['exists'],
                'filename' => $pgsqlMeta['filename'],
                'size_bytes' => $pgsqlMeta['size_bytes'],
                'size_human' => $pgsqlMeta['size_human'],
                'updated_at' => $pgsqlMeta['updated_at'],
                'download_url' => route('admin.database-maintenance.download', ['format' => self::FORMAT_PGSQL]),
            ],
            self::FORMAT_MONGODB => [
                'format' => self::FORMAT_MONGODB,
                'label' => 'MongoDB (.zip chứa các file .json)',
                'extension' => 'zip',
                'ready' => $activeConnected && $zipLoaded,
                'status_text' => ! $activeConnected
                    ? 'Mất kết nối Database'
                    : ($zipLoaded ? 'Sẵn sàng (JSON Collections + Script)' : 'Thiếu PHP ZipArchive'),
                'dump_exists' => $mongoMeta['exists'],
                'filename' => $mongoMeta['filename'],
                'size_bytes' => $mongoMeta['size_bytes'],
                'size_human' => $mongoMeta['size_human'],
                'updated_at' => $mongoMeta['updated_at'],
                'download_url' => route('admin.database-maintenance.download', ['format' => self::FORMAT_MONGODB]),
            ],
        ];
    }

    public function getDumpPath(string $format): string
    {
        $this->assertSupportedFormat($format);

        if ($format === self::FORMAT_MYSQL) {
            return $this->mysqlExportService->getDumpPath();
        }

        $dir = storage_path('app/private/db-exports');
        $dbName = $this->getActiveDatabaseName();

        return match ($format) {
            self::FORMAT_PGSQL => $dir.DIRECTORY_SEPARATOR."{$dbName}_pgsql_latest.sql",
            self::FORMAT_MONGODB => $dir.DIRECTORY_SEPARATOR."{$dbName}_mongodb_latest.zip",
        };
    }

    /**
     * @return array{filename: string, content_type: string}
     */
    public function getDownloadDescriptor(string $format): array
    {
        $this->assertSupportedFormat($format);

        $dbName = $this->getActiveDatabaseName();
        $timestamp = now()->format('Ymd_His');

        return match ($format) {
            self::FORMAT_MYSQL => [
                'filename' => "{$dbName}_mysql_{$timestamp}.sql",
                'content_type' => 'application/sql; charset=UTF-8',
            ],
            self::FORMAT_PGSQL => [
                'filename' => "{$dbName}_pgsql_{$timestamp}.sql",
                'content_type' => 'application/sql; charset=UTF-8',
            ],
            self::FORMAT_MONGODB => [
                'filename' => "{$dbName}_mongodb_{$timestamp}.zip",
                'content_type' => 'application/zip',
            ],
        };
    }

    /**
     * @return array{
     *     format: string,
     *     path: string,
     *     filename: string,
     *     size_bytes: int,
     *     size_human: string,
     *     updated_at: string,
     *     duration_ms: int,
     *     tables_count?: int
     * }
     */
    public function export(string $format): array
    {
        $this->assertSupportedFormat($format);
        @set_time_limit(180);

        return match ($format) {
            self::FORMAT_MYSQL => array_merge(
                ['format' => self::FORMAT_MYSQL],
                $this->mysqlExportService->export()
            ),
            self::FORMAT_PGSQL => $this->exportPostgres(),
            self::FORMAT_MONGODB => $this->exportMongoDbZip(),
        };
    }

    protected function exportPostgres(): array
    {
        $binary = $this->resolvePgDumpBinary();
        if ($binary === null) {
            throw new RuntimeException('Không tìm thấy công cụ pg_dump trên máy chủ.');
        }

        $path = $this->getDumpPath(self::FORMAT_PGSQL);
        File::ensureDirectoryExists(dirname($path));

        $cfg = config('database.connections.pgsql');
        $host = (string) ($cfg['host'] ?? '127.0.0.1');
        $port = (string) ($cfg['port'] ?? '5432');
        $database = (string) ($cfg['database'] ?? '');
        $username = (string) ($cfg['username'] ?? 'postgres');
        $password = (string) ($cfg['password'] ?? '');

        $startedAt = microtime(true);
        $process = new Process([
            $binary,
            '--host='.$host,
            '--port='.$port,
            '--username='.$username,
            '--format=p',
            '--encoding=UTF8',
            '--clean',
            '--if-exists',
            '--no-owner',
            '--no-privileges',
            '--file='.$path,
            $database,
        ], base_path(), ['PGPASSWORD' => $password]);

        $process->setTimeout(180);
        $process->run();

        if (! $process->isSuccessful()) {
            $err = trim($process->getErrorOutput() ?: $process->getOutput());

            throw new RuntimeException('Xuất PostgreSQL (pg_dump) thất bại: '.($err !== '' ? $err : 'Lỗi không xác định.'));
        }

        $meta = $this->readFileMeta($path);

        return [
            'format' => self::FORMAT_PGSQL,
            'path' => $path,
            'filename' => $meta['filename'],
            'size_bytes' => $meta['size_bytes'],
            'size_human' => (string) $meta['size_human'],
            'updated_at' => (string) $meta['updated_at'],
            'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
        ];
    }

    /**
     * Xuất toàn bộ bảng từ kết nối đang hoạt động (MySQL/MariaDB hoặc PostgreSQL) thành ZIP JSON chuẩn MongoDB.
     */
    protected function exportMongoDbZip(): array
    {
        if (! extension_loaded('zip')) {
            throw new RuntimeException('PHP chưa bật extension zip (ZipArchive).');
        }

        $startedAt = microtime(true);
        $path = $this->getDumpPath(self::FORMAT_MONGODB);
        File::ensureDirectoryExists(dirname($path));

        $connName = (string) config('database.default', 'mysql');
        $driver = (string) config("database.connections.{$connName}.driver", 'mysql');
        $tables = $this->getActiveTables($connName, $driver);

        $tempPath = $path.'.tmp';
        $zip = new ZipArchive;
        if ($zip->open($tempPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new RuntimeException('Không thể khởi tạo file nén ZIP cho MongoDB.');
        }

        $dbName = $this->getActiveDatabaseName();
        $batLines = [
            '@echo off',
            'chcp 65001 > nul',
            'echo Importing JSON collections into MongoDB database: '.$dbName,
        ];
        $shLines = [
            '#!/usr/bin/env bash',
            'set -e',
            'DB_NAME="${1:-'.$dbName.'}"',
            'echo "Importing JSON collections into MongoDB database: $DB_NAME"',
        ];

        try {
            foreach ($tables as $table) {
                $documents = [];
                $rows = DB::connection($connName)->table($table)->get();

                foreach ($rows as $row) {
                    $doc = [];
                    foreach ((array) $row as $col => $value) {
                        if (is_string($value) && strlen($value) >= 2 && ($value[0] === '{' || $value[0] === '[')) {
                            $decoded = json_decode($value, true);
                            $doc[$col] = (json_last_error() === JSON_ERROR_NONE) ? $decoded : $value;
                        } else {
                            $doc[$col] = $value;
                        }
                    }
                    $documents[] = $doc;
                }

                $jsonContent = json_encode(
                    $documents,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                );

                $zip->addFromString("collections/{$table}.json", $jsonContent !== false ? $jsonContent : '[]');
                $batLines[] = "mongoimport --db {$dbName} --collection {$table} --file collections\\{$table}.json --jsonArray --drop";
                $shLines[] = "mongoimport --db \"\$DB_NAME\" --collection {$table} --file collections/{$table}.json --jsonArray --drop";
            }

            $batLines[] = 'echo Done!';
            $batLines[] = 'pause';
            $shLines[] = 'echo "Done!"';

            $readme = implode("\n", [
                "# MongoDB JSON Export — {$dbName}",
                '',
                '- Xuất lúc: '.now()->format('d/m/Y H:i:s'),
                '- Tổng số collection: '.count($tables),
                '- Định dạng: JSON Array chuẩn cho `mongoimport --jsonArray` & MongoDB Compass.',
                '',
            ]);

            $zip->addFromString('README_IMPORT_MONGODB.md', $readme);
            $zip->addFromString('import_mongodb.bat', implode("\r\n", $batLines)."\r\n");
            $zip->addFromString('import_mongodb.sh', implode("\n", $shLines)."\n");
            $zip->close();

            File::move($tempPath, $path);
        } catch (\Throwable $e) {
            $zip->close();
            if (File::exists($tempPath)) {
                File::delete($tempPath);
            }

            throw $e;
        }

        $meta = $this->readFileMeta($path);

        return [
            'format' => self::FORMAT_MONGODB,
            'path' => $path,
            'filename' => $meta['filename'],
            'size_bytes' => $meta['size_bytes'],
            'size_human' => (string) $meta['size_human'],
            'updated_at' => (string) $meta['updated_at'],
            'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
            'tables_count' => count($tables),
        ];
    }

    /**
     * @return array<int, string>
     */
    protected function getActiveTables(string $connName, string $driver): array
    {
        if ($driver === 'pgsql') {
            $rows = DB::connection($connName)->select("
                SELECT tablename FROM pg_catalog.pg_tables
                WHERE schemaname = 'public' AND tablename != 'migrations'
                ORDER BY tablename ASC
            ");

            return array_map(fn ($r): string => (string) $r->tablename, $rows);
        }

        $rows = DB::connection($connName)->select('SHOW TABLES');
        $tables = [];
        foreach ($rows as $row) {
            $values = array_values((array) $row);
            $name = (string) ($values[0] ?? '');
            if ($name !== '' && $name !== 'migrations') {
                $tables[] = $name;
            }
        }
        sort($tables);

        return $tables;
    }

    protected function getActiveDatabaseName(): string
    {
        $connName = (string) config('database.default', 'mysql');
        $db = (string) config("database.connections.{$connName}.database", 'salondungtokyo');

        return $this->sanitizeFilename($db);
    }

    public function resolvePgDumpBinary(): ?string
    {
        $configured = env('PG_DUMP_PATH');
        if (is_string($configured) && $configured !== '' && File::exists($configured)) {
            return $configured;
        }

        $candidates = array_merge(
            glob('E:\\laragon\\bin\\postgresql\\*\\bin\\pg_dump.exe') ?: [],
            glob('C:\\laragon\\bin\\postgresql\\*\\bin\\pg_dump.exe') ?: [],
            glob('C:\\Program Files\\PostgreSQL\\*\\bin\\pg_dump.exe') ?: [],
            ['/usr/bin/pg_dump', '/usr/local/bin/pg_dump', '/opt/homebrew/bin/pg_dump']
        );

        foreach ($candidates as $candidate) {
            if (File::exists($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    protected function assertSupportedFormat(string $format): void
    {
        if (! in_array($format, self::SUPPORTED_FORMATS, true)) {
            throw new RuntimeException("Định dạng xuất [{$format}] không được hỗ trợ.");
        }
    }

    protected function sanitizeFilename(string $name): string
    {
        $clean = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name) ?: 'database';

        return trim($clean, '_') ?: 'database';
    }

    /**
     * @return array{exists: bool, filename: string, size_bytes: int, size_human: string|null, updated_at: string|null}
     */
    protected function readFileMeta(string $path): array
    {
        $exists = File::exists($path);
        $sizeBytes = $exists ? (int) File::size($path) : 0;

        return [
            'exists' => $exists,
            'filename' => basename($path),
            'size_bytes' => $sizeBytes,
            'size_human' => $exists ? $this->formatBytes($sizeBytes) : null,
            'updated_at' => $exists
                ? Carbon::createFromTimestamp(File::lastModified($path))->format('d/m/Y H:i:s')
                : null,
        ];
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1).' KB';
        }

        return $bytes.' B';
    }
}
