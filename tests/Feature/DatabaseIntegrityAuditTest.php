<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseIntegrityAuditTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config([
            'database.connections.pgsql.database' => 'salondungtokyo',
            'database.connections.pgsql.username' => 'postgres',
            'database.connections.pgsql.password' => '',
            'database.connections.pgsql.host' => '127.0.0.1',
            'database.connections.pgsql.port' => '5432',
        ]);
        DB::purge('pgsql');
        DB::setDefaultConnection('pgsql');
    }

    /**
     * Test PostgreSQL connection and active schema.
     */
    public function test_postgresql_connection_is_active(): void
    {
        $db = DB::connection('pgsql');
        $driver = $db->getDriverName();
        $this->assertEquals('pgsql', $driver, 'Database driver must be pgsql');

        $dbName = $db->selectOne('SELECT current_database() as db')->db;
        $this->assertEquals('salondungtokyo', $dbName, 'Database name must be salondungtokyo');
    }

    /**
     * Test all foreign keys exist in PostgreSQL catalog.
     */
    public function test_all_foreign_keys_are_present(): void
    {
        $foreignKeys = DB::connection('pgsql')->select("
            SELECT
                tc.table_name,
                kcu.column_name,
                ccu.table_name AS foreign_table_name,
                ccu.column_name AS foreign_column_name
            FROM information_schema.table_constraints AS tc
            JOIN information_schema.key_column_usage AS kcu
              ON tc.constraint_name = kcu.constraint_name
              AND tc.table_schema = kcu.table_schema
            JOIN information_schema.constraint_column_usage AS ccu
              ON ccu.constraint_name = tc.constraint_name
              AND ccu.table_schema = tc.table_schema
            WHERE tc.constraint_type = 'FOREIGN KEY'
              AND tc.table_schema = 'public'
            ORDER BY tc.table_name, kcu.column_name;
        ");

        $this->assertNotEmpty($foreignKeys, 'Foreign keys should exist');

        $fkList = array_map(fn ($fk) => "{$fk->table_name}.{$fk->column_name} -> {$fk->foreign_table_name}.{$fk->foreign_column_name}", $foreignKeys);

        // Check core FKs
        $this->assertContains('album_items.album_id -> albums.id', $fkList);
        $this->assertContains('menu_items.menu_id -> menus.id', $fkList);
        $this->assertContains('role_user.user_id -> users.id', $fkList);
        $this->assertContains('role_user.role_id -> roles.id', $fkList);
        $this->assertContains('permission_role.role_id -> roles.id', $fkList);
        $this->assertContains('permission_role.permission_id -> permissions.id', $fkList);
        $this->assertContains('pages.user_id -> users.id', $fkList);
    }

    /**
     * Test data integrity across critical business tables.
     */
    public function test_business_data_integrity_and_joins(): void
    {
        $db = DB::connection('pgsql');

        // 1. Albums & Album Items Join
        $albumCount = $db->table('albums')->count();
        $this->assertGreaterThan(0, $albumCount, 'Albums table must contain data');

        $albumsWithItems = $db->table('albums')
            ->join('album_items', 'albums.id', '=', 'album_items.album_id')
            ->select('albums.id', 'albums.name as album_name', 'album_items.name as item_name')
            ->get();
        $this->assertNotEmpty($albumsWithItems, 'Albums should join cleanly with album_items');

        // 2. Menus & Menu Items Join
        $menuCount = $db->table('menus')->count();
        $this->assertGreaterThan(0, $menuCount, 'Menus table must contain data');

        $menusWithItems = $db->table('menus')
            ->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')
            ->select('menus.name as menu_name', 'menu_items.label')
            ->get();
        $this->assertNotEmpty($menusWithItems, 'Menus should join cleanly with menu_items');

        // 3. User & Roles Join
        $userCount = $db->table('users')->count();
        $this->assertGreaterThan(0, $userCount, 'Users table must contain data');

        $usersWithRoles = $db->table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('users.email', 'roles.name as role_name')
            ->get();
        $this->assertNotEmpty($usersWithRoles, 'Users should join cleanly with roles');

        // 4. Pages data
        $pageCount = $db->table('pages')->count();
        $this->assertGreaterThan(0, $pageCount, 'Pages table must contain data');
        $samplePage = $db->table('pages')->first();
        $this->assertNotEmpty($samplePage->name);
    }

    /**
     * Test sequence auto-increment works without primary key collision.
     */
    public function test_sequences_and_crud_insert_delete(): void
    {
        $db = DB::connection('pgsql');

        // Test inserting and deleting a temporary page
        $insertedId = $db->table('pages')->insertGetId([
            'name' => 'Trang kiểm tra khóa ngoại salondungtokyo',
            'slug' => 'trang-kiem-tra-khoa-ngoai-salon-' . time(),
            'description' => 'Kiểm tra sequence PostgreSQL',
            'content' => 'Nội dung kiểm tra',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertGreaterThan(0, $insertedId);

        // Verify it exists
        $record = $db->table('pages')->where('id', $insertedId)->first();
        $this->assertNotNull($record);

        // Clean up
        $db->table('pages')->where('id', $insertedId)->delete();
        $this->assertNull($db->table('pages')->where('id', $insertedId)->first());
    }

    /**
     * Test that zero orphan records exist after wiring foreign keys.
     */
    public function test_zero_orphan_records(): void
    {
        $db = DB::connection('pgsql');

        // No orphaned album_items
        $orphanAlbumItems = $db->table('album_items')
            ->leftJoin('albums', 'album_items.album_id', '=', 'albums.id')
            ->whereNull('albums.id')
            ->count();
        $this->assertEquals(0, $orphanAlbumItems, 'Zero orphan album_items allowed');

        // No orphaned menu_items
        $orphanMenuItems = $db->table('menu_items')
            ->leftJoin('menus', 'menu_items.menu_id', '=', 'menus.id')
            ->whereNull('menus.id')
            ->count();
        $this->assertEquals(0, $orphanMenuItems, 'Zero orphan menu_items allowed');

        // No orphaned role_user
        $orphanRoleUser = $db->table('role_user')
            ->leftJoin('users', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereNull('users.id')
            ->orWhereNull('roles.id')
            ->count();
        $this->assertEquals(0, $orphanRoleUser, 'Zero orphan role_user allowed');
    }

    /**
     * Test bulk delete functionality executes cleanly on PostgreSQL without SQL errors.
     */
    public function test_bulk_delete_functions_correctly_on_postgresql(): void
    {
        $db = DB::connection('pgsql');

        // 1. Create a dummy test post in pages
        $testId = $db->table('pages')->insertGetId([
            'name' => 'Test Bulk Delete Salon Page',
            'slug' => 'test-bulk-delete-salon-' . time(),
            'type' => 'page',
            'status' => 0,
            'sort' => 9999,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertNotNull($db->table('pages')->where('id', $testId)->first());

        // 2. Execute bulk delete via AjaxController
        $controller = new \App\Http\Controllers\Admin\AjaxController();
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'type' => 'page',
            'seq_list' => [$testId],
        ]);

        $result = $controller->ajax_delete($request);
        $this->assertEquals(1, $result, 'Bulk delete must return 1 on success');

        // 3. Verify record was removed
        $this->assertNull($db->table('pages')->where('id', $testId)->first(), 'Record must be deleted');

        // 4. Verify subsequent insert succeeds and sequence increments properly
        $newId = $db->table('pages')->insertGetId([
            'name' => 'Page After Bulk Delete',
            'slug' => 'page-after-bulk-delete-' . time(),
            'type' => 'page',
            'status' => 0,
            'sort' => 9999,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertGreaterThan(0, $newId, 'New record should have valid incremented ID');
        $db->table('pages')->where('id', $newId)->delete();
    }
}