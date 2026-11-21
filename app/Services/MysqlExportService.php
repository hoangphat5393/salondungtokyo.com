<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;
use Symfony\Component\Process\Process;

class MysqlExportService
{
    public function getDumpPath(): string
    {
        return database_path('salondungtokyo_mysql_latest.sql');
    }

    /**
     * @return array{
     *     pgsql_connected: bool,
     *     mysql_connected: bool,
     *     dump_exists: bool,
     *     filename: string,
     *     size_bytes: int,
     *     size_human: string|null,
     *     updated_at: string|null
     * }
     */
    public function getStatus(): array
    {
        $path = $this->getDumpPath();
        $exists = File::exists($path);
        $sizeBytes = $exists ? (int) File::size($path) : 0;
        $updatedAt = $exists
            ? Carbon::createFromTimestamp(File::lastModified($path))->format('d/m/Y H:i:s')
            : null;

        $defaultConn = (string) config('database.default', 'mysql');
        $isMysqlNative = in_array($defaultConn, ['mysql', 'mariadb'], true);

        return [
            'pgsql_connected' => $isMysqlNative ? false : $this->canConnect('pgsql'),
            'mysql_connected' => $isMysqlNative ? $this->canConnect($defaultConn) : $this->canConnect('mysql_sync'),
            'dump_exists' => $exists,
            'filename' => basename($path),
            'size_bytes' => $sizeBytes,
            'size_human' => $exists ? $this->formatBytes($sizeBytes) : null,
            'updated_at' => $updatedAt,
        ];
    }

    /**
     * @return array{
     *     path: string,
     *     filename: string,
     *     size_bytes: int,
     *     size_human: string,
     *     updated_at: string,
     *     duration_ms: int
     * }
     */
    public function export(): array
    {
        @set_time_limit(180);

        $defaultConn = (string) config('database.default', 'mysql');
        if (in_array($defaultConn, ['mysql', 'mariadb'], true)) {
            return $this->exportDirectMysqlDump($defaultConn);
        }

        $startedAt = microtime(true);
        $exitCode = Artisan::call('db:sync-to-mysql');
        $output = trim(Artisan::output());
        $durationMs = (int) round((microtime(true) - $startedAt) * 1000);

        if ($exitCode !== 0) {
            throw new RuntimeException($output !== '' ? $output : 'Đồng bộ dữ liệu sang MySQL thất bại.');
        }

        $path = $this->getDumpPath();
        if (! File::exists($path) || File::size($path) === 0) {
            throw new RuntimeException('Không tìm thấy file SQL đầu ra sau khi đồng bộ.');
        }

        $sizeBytes = (int) File::size($path);

        return [
            'path' => $path,
            'filename' => basename($path),
            'size_bytes' => $sizeBytes,
            'size_human' => $this->formatBytes($sizeBytes),
            'updated_at' => Carbon::createFromTimestamp(File::lastModified($path))->format('d/m/Y H:i:s'),
            'duration_ms' => $durationMs,
        ];
    }

    /**
     * Xuất trực tiếp bằng mysqldump khi dự án đang chạy native MySQL / MariaDB.
     *
     * @return array{
     *     path: string,
     *     filename: string,
     *     size_bytes: int,
     *     size_human: string,
     *     updated_at: string,
     *     duration_ms: int
     * }
     */
    protected function exportDirectMysqlDump(string $connection): array
    {
        $binary = $this->resolveMysqlDumpBinary();
        if ($binary === null) {
            throw new RuntimeException('Không tìm thấy công cụ mysqldump trên máy chủ.');
        }

        $cfg = config("database.connections.{$connection}");
        $host = (string) ($cfg['host'] ?? '127.0.0.1');
        if ($host === 'localhost') {
            $host = '127.0.0.1';
        }
        $port = (string) ($cfg['port'] ?? '3306');
        $database = (string) ($cfg['database'] ?? '');
        $username = (string) ($cfg['username'] ?? 'root');
        $password = (string) ($cfg['password'] ?? '');

        $path = $this->getDumpPath();
        File::ensureDirectoryExists(dirname($path));

        $startedAt = microtime(true);
        $args = [
            $binary,
            "--host={$host}",
            "--port={$port}",
            "--user={$username}",
            '--default-character-set=utf8mb4',
            '--single-transaction',
            "--result-file={$path}",
            $database,
        ];

        $env = $password !== '' ? ['MYSQL_PWD' => $password] : [];
        $process = new Process($args, base_path(), $env);
        $process->setTimeout(180);
        $process->run();

        if (! $process->isSuccessful()) {
            $err = trim($process->getErrorOutput() ?: $process->getOutput());

            throw new RuntimeException('Xuất MySQL (mysqldump) thất bại: '.($err !== '' ? $err : 'Lỗi không xác định.'));
        }

        if (! File::exists($path) || File::size($path) === 0) {
            throw new RuntimeException('File SQL MySQL xuất ra bị rỗng.');
        }

        $sizeBytes = (int) File::size($path);

        return [
            'path' => $path,
            'filename' => basename($path),
            'size_bytes' => $sizeBytes,
            'size_human' => $this->formatBytes($sizeBytes),
            'updated_at' => Carbon::createFromTimestamp(File::lastModified($path))->format('d/m/Y H:i:s'),
            'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
        ];
    }

    protected function resolveMysqlDumpBinary(): ?string
    {
        $candidates = array_merge(
            glob('E:\\laragon\\bin\\mysql\\*\\bin\\mysqldump.exe') ?: [],
            glob('C:\\laragon\\bin\\mysql\\*\\bin\\mysqldump.exe') ?: [],
            ['/usr/bin/mysqldump', '/usr/local/bin/mysqldump']
        );

        foreach ($candidates as $candidate) {
            if (File::exists($candidate)) {
                return $candidate;
            }
        }

        $probe = new Process([PHP_OS_FAMILY === 'Windows' ? 'where' : 'which', 'mysqldump']);
        $probe->run();
        if ($probe->isSuccessful()) {
            $first = trim(explode("\n", trim($probe->getOutput()))[0] ?? '');
            if ($first !== '' && File::exists($first)) {
                return $first;
            }
        }

        return null;
    }

    protected function canConnect(string $connection): bool
    {
        try {
            DB::connection($connection)->getPdo();

            return true;
        } catch (\Throwable) {
            return false;
        }
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
