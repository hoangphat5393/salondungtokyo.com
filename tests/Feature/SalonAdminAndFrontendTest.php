<?php

namespace Tests\Feature;

use App\Models\Backend\AdminMenu;
use App\Models\Backend\Album;
use App\Models\Backend\Category;
use App\Models\Backend\Contact;
use App\Models\Backend\Page;
use App\Models\Backend\Permission;
use App\Models\Backend\Role;
use App\Models\Backend\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SalonAdminAndFrontendTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Đảm bảo user admin tồn tại với username 'admin' và mật khẩu '123456'
        $user = User::first();
        if (! $user) {
            $user = User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@local',
                'password' => Hash::make('123456'),
                'admin_level' => 1,
                'status' => 1,
            ]);
        } else {
            $user->username = 'admin';
            $user->email = 'admin@local';
            $user->password = Hash::make('123456');
            $user->status = 1;
            $user->admin_level = 1;
            $user->save();
        }

        // Gắn role administrator
        $adminRole = Role::where('slug', 'administrator')->first();
        if ($adminRole && ! $user->roles()->where('slug', 'administrator')->exists()) {
            $user->roles()->attach($adminRole->id);
        }
    }

    /**
     * 1. Kiểm tra hiển thị trang đăng nhập admin
     */
    public function test_admin_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Đăng nhập để tiếp tục phiên làm việc');
    }

    /**
     * 2. Kiểm tra đăng nhập admin thành công với username 'admin' và password '123456'
     */
    public function test_admin_can_login_successfully(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin',
            'password' => '123456',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated('admin');
    }

    /**
     * 2.1 Kiểm tra đăng xuất admin thành công bằng cả POST và GET
     */
    public function test_admin_can_logout_successfully_via_post_and_get(): void
    {
        $user = User::first();

        // 1. Đăng xuất bằng POST (từ Header / Sidebar Form)
        $responsePost = $this->actingAs($user, 'admin')->post('/admin/logout');
        $responsePost->assertRedirect(route('admin.login'));
        $this->assertGuest('admin');

        // 2. Đăng xuất bằng GET (trực tiếp URL hoặc link)
        $responseGet = $this->actingAs($user, 'admin')->get('/admin/logout');
        $responseGet->assertRedirect(route('admin.login'));
        $this->assertGuest('admin');
    }

    /**
     * 3. Kiểm tra Admin Dashboard hiển thị đầy đủ widget
     */
    public function test_admin_dashboard_renders_successfully(): void
    {
        $user = User::first();
        $response = $this->actingAs($user, 'admin')->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Dịch Vụ Salon');
        $response->assertSee('Bộ Sưu Tập Mẫu Tóc');
        $response->assertSee('Khách Đặt Lịch');
    }

    /**
     * 4. Kiểm tra trang Admin Menu hiển thị & thực hiện CRUD
     */
    public function test_admin_menu_renders_and_crud(): void
    {
        $user = User::first();

        // GET trang quản lý menu
        $response = $this->actingAs($user, 'admin')->get('/admin/admin-menu');
        $response->assertStatus(200);

        // POST tạo mới một menu item
        $createResponse = $this->actingAs($user, 'admin')->post('/admin/admin-menu/create', [
            'title' => 'Menu Thử Nghiệm Salon',
            'parent_id' => 0,
            'uri' => 'admin.dashboard',
            'icon' => 'fa fa-scissors',
            'sort' => 99,
        ]);
        $createResponse->assertRedirect(route('admin.admin-menu.index'));

        $menu = AdminMenu::where('title', 'Menu Thử Nghiệm Salon')->first();
        $this->assertNotNull($menu);

        // AJAX Xóa menu item vừa tạo
        $deleteResponse = $this->actingAs($user, 'admin')->postJson('/admin/admin-menu/delete', [
            'id' => $menu->id,
        ]);
        $deleteResponse->assertStatus(200);
        $deleteResponse->assertJson(['error' => 0]);

        $this->assertDatabaseMissing('admin_menus', [
            'id' => $menu->id,
        ]);
    }

    /**
     * 5. Kiểm tra Danh sách, Thêm, Sửa, Xóa Dịch vụ trong Admin
     */
    public function test_admin_can_create_and_delete_service(): void
    {
        $user = User::first();

        // 1. GET danh sách dịch vụ (đảm bảo không bị lỗi Undefined variable $data)
        $indexResponse = $this->actingAs($user, 'admin')->get('/admin/service');
        $indexResponse->assertStatus(200);

        // 2. GET trang thêm dịch vụ
        $createPageResponse = $this->actingAs($user, 'admin')->get('/admin/service/create');
        $createPageResponse->assertStatus(200);

        // 3. Thêm dịch vụ
        $createResponse = $this->actingAs($user, 'admin')->post('/admin/service', [
            'name' => 'Uốn Tóc Phục Hồi Tokyo Test',
            'slug' => 'uon-toc-phuc-hoi-tokyo-test',
            'description' => 'Dịch vụ uốn tóc thử nghiệm công nghệ Nhật Bản',
            'content' => '<p>Chi tiết dịch vụ uốn phục hồi.</p>',
            'status' => 1,
            'sort' => 1,
        ]);

        $createResponse->assertRedirect(route('admin.service.index'));
        $this->assertDatabaseHas('pages', [
            'slug' => 'uon-toc-phuc-hoi-tokyo-test',
            'type' => 'service',
        ]);

        $service = Page::where('slug', 'uon-toc-phuc-hoi-tokyo-test')->first();
        $this->assertNotNull($service);

        // 4. GET trang sửa dịch vụ
        $editPageResponse = $this->actingAs($user, 'admin')->get('/admin/service/'.$service->id.'/edit');
        $editPageResponse->assertStatus(200);

        // 5. Xóa dịch vụ
        $deleteResponse = $this->actingAs($user, 'admin')->delete('/admin/service/'.$service->id);
        $deleteResponse->assertRedirect(route('admin.service.index'));

        $this->assertDatabaseMissing('pages', [
            'id' => $service->id,
        ]);
    }

    /**
     * 6. Kiểm tra Quản lý Danh mục Dịch vụ
     */
    public function test_admin_service_category_crud(): void
    {
        $user = User::first();

        // GET danh mục dịch vụ
        $response = $this->actingAs($user, 'admin')->get('/admin/service-category');
        $response->assertStatus(200);

        // Tạo danh mục dịch vụ mới
        $createResponse = $this->actingAs($user, 'admin')->post('/admin/service-category', [
            'name' => 'Dịch Vụ Uốn Nhuộm Salon',
            'slug' => 'dich-vu-uon-nhuom-salon-test',
            'type' => 'service',
            'status' => 1,
        ]);
        $createResponse->assertRedirect(route('admin.service-category.index'));

        $cat = Category::where('slug', 'dich-vu-uon-nhuom-salon-test')->first();
        $this->assertNotNull($cat);

        // Xóa danh mục
        $deleteResponse = $this->actingAs($user, 'admin')->delete('/admin/service-category/'.$cat->id);
        $deleteResponse->assertRedirect(route('admin.service-category.index'));

        $this->assertDatabaseMissing('categories', [
            'id' => $cat->id,
        ]);
    }

    /**
     * 7. Kiểm tra Quản lý Album Mẫu Tóc
     */
    public function test_admin_album_management(): void
    {
        $user = User::first();

        // GET danh sách Album
        $response = $this->actingAs($user, 'admin')->get('/admin/album');
        $response->assertStatus(200);

        // Tạo Album mới
        $createResponse = $this->actingAs($user, 'admin')->post('/admin/album', [
            'name' => 'BST Mẫu Tóc Nam Nữ 2026 Test',
            'status' => 1,
            'submit' => 'save',
        ]);
        $createResponse->assertRedirect(route('admin.album.index'));

        $album = Album::where('name', 'BST Mẫu Tóc Nam Nữ 2026 Test')->first();
        $this->assertNotNull($album);

        // Xóa Album
        $deleteResponse = $this->actingAs($user, 'admin')->delete('/admin/album/'.$album->id);
        $deleteResponse->assertRedirect(route('admin.album.index'));

        $this->assertDatabaseMissing('albums', [
            'id' => $album->id,
        ]);
    }

    /**
     * 8. Kiểm tra Xem danh sách Khách Đặt Lịch & Liên Hệ
     */
    public function test_admin_contact_management(): void
    {
        $user = User::first();

        // Tạo contact giả lập
        $contact = Contact::create([
            'name' => 'Nguyễn Văn Test',
            'email' => 'test@salondungtokyo.com',
            'phone' => '0901234567',
            'content' => 'Tư vấn cắt tóc layer',
            'status' => 0,
        ]);

        $response = $this->actingAs($user, 'admin')->get('/admin/contact');
        $response->assertStatus(200);
        $response->assertSee('Nguyễn Văn Test');

        // Xem chi tiết
        $showResponse = $this->actingAs($user, 'admin')->get('/admin/contact/'.$contact->id);
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Tư vấn cắt tóc layer');

        // Dọn dẹp
        $contact->delete();
    }

    /**
     * 9. Kiểm tra Trang Cấu Hình Theme Option
     */
    public function test_admin_theme_options_page(): void
    {
        $user = User::first();

        $response = $this->actingAs($user, 'admin')->get('/admin/theme-option');
        $response->assertStatus(200);
        $response->assertSee('theme-option');
    }

    /**
     * 10. Kiểm tra AJAX Quick Change Status
     */
    public function test_admin_ajax_quickchange(): void
    {
        $user = User::first();

        $service = Page::create([
            'name' => 'Test Quick Change Service',
            'slug' => 'test-quick-change-service',
            'type' => 'service',
            'user_id' => $user->id,
            'status' => 0,
        ]);

        $response = $this->actingAs($user, 'admin')->postJson('/admin/quick-change', [
            'table' => 'pages',
            'id' => $service->id,
            'field' => 'status',
            'value' => 1,
        ]);

        $response->assertStatus(200);
        $this->assertEquals(1, $service->fresh()->status);

        $service->delete();
    }

    /**
     * 11. Kiểm tra Trang chủ Frontend hiển thị thành công
     */
    public function test_frontend_homepage_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('NÂNG TẦM VẺ ĐẸP');
        $response->assertSee('ĐẶT LỊCH LÀM TÓC NHANH');
    }

    /**
     * 12. Kiểm tra gửi form Đặt Lịch từ Frontend
     */
    public function test_frontend_booking_form_submission(): void
    {
        $response = $this->postJson('/contact-submit', [
            'contact' => [
                'name' => 'Khách Hàng Test',
                'phone' => '0988777666',
                'email' => 'khachhang@test.com',
                'content' => 'Tư vấn nhuộm tóc màu khói',
            ],
        ]);

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /**
     * 13. Kiểm tra danh sách và chức năng Quản lý Vai trò (Roles)
     */
    public function test_admin_roles_management(): void
    {
        $user = User::first();

        // 1. GET danh sách vai trò
        $response = $this->actingAs($user, 'admin')->get('/admin/role');
        $response->assertStatus(200);
        $response->assertSee('admin');
        $response->assertSee('Administrator');

        // 2. Tạo vai trò mới
        $createResponse = $this->actingAs($user, 'admin')->post('/admin/role', [
            'name' => 'Test Stylist Role',
            'slug' => 'test-stylist-role',
            'display_name' => 'Thợ Tạo Mẫu',
            'description' => 'Quyền quản lý dịch vụ mẫu tóc',
            'permission' => [1, 2],
        ]);
        $createResponse->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseHas('roles', [
            'slug' => 'test-stylist-role',
        ]);

        // 3. Xóa vai trò vừa tạo
        $role = Role::where('slug', 'test-stylist-role')->first();
        $this->assertNotNull($role);

        $deleteResponse = $this->actingAs($user, 'admin')->delete('/admin/role/'.$role->id);
        $deleteResponse->assertRedirect(route('admin.role.index'));

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
        ]);
    }

    /**
     * 14. Kiểm tra danh sách và chức năng Phân quyền (Permissions)
     */
    public function test_admin_permissions_management(): void
    {
        $user = User::first();

        // 1. GET danh sách phân quyền
        $response = $this->actingAs($user, 'admin')->get('/admin/permission');
        $response->assertStatus(200);
        $response->assertSee('role-create');
        $response->assertSee('user-list');

        // 2. Tạo permission mới
        $createResponse = $this->actingAs($user, 'admin')->post('/admin/permission', [
            'name' => 'service-manager-test',
            'slug' => 'service-manager-test',
            'display_name' => 'Quản lý Dịch vụ Test',
            'description' => 'Quyền xem và thêm dịch vụ test',
            'http_uri' => 'ANY::admin/service/*',
        ]);
        $createResponse->assertRedirect(route('admin.permission.index'));

        $this->assertDatabaseHas('permissions', [
            'name' => 'service-manager-test',
        ]);

        // 3. Xóa permission vừa tạo
        $perm = Permission::where('name', 'service-manager-test')->first();
        $this->assertNotNull($perm);

        $deleteResponse = $this->actingAs($user, 'admin')->delete('/admin/permission/'.$perm->id);
        $deleteResponse->assertRedirect(route('admin.permission.index'));

        $this->assertDatabaseMissing('permissions', [
            'id' => $perm->id,
        ]);
    }

    /**
     * 15. Kiểm tra danh sách, thêm, sửa, xóa Bài Viết (Posts) trong Admin
     */
    public function test_admin_post_management(): void
    {
        $user = User::first();

        // 1. GET danh sách bài viết
        $response = $this->actingAs($user, 'admin')->get('/admin/post');
        $response->assertStatus(200);

        // 2. GET trang thêm bài viết
        $createPageResponse = $this->actingAs($user, 'admin')->get('/admin/post/create');
        $createPageResponse->assertStatus(200);

        // 3. Tạo bài viết mới
        $createResponse = $this->actingAs($user, 'admin')->post('/admin/post', [
            'name' => 'Top 5 Xu Hướng Tóc Nữ 2026 Test',
            'slug' => 'top-5-xu-huong-toc-nu-2026-test',
            'description' => 'Mô tả bài viết xu hướng tóc nữ',
            'content' => '<p>Nội dung chi tiết bài viết xu hướng.</p>',
            'status' => 1,
            'sort' => 1,
        ]);
        $createResponse->assertRedirect(route('admin.post.index'));

        $this->assertDatabaseHas('pages', [
            'slug' => 'top-5-xu-huong-toc-nu-2026-test',
            'type' => 'post',
        ]);

        $post = Page::where('slug', 'top-5-xu-huong-toc-nu-2026-test')->first();
        $this->assertNotNull($post);

        // 4. GET trang sửa bài viết
        $editPageResponse = $this->actingAs($user, 'admin')->get('/admin/post/'.$post->id.'/edit');
        $editPageResponse->assertStatus(200);

        // 5. Xóa bài viết
        $deleteResponse = $this->actingAs($user, 'admin')->delete('/admin/post/'.$post->id);
        $deleteResponse->assertRedirect(route('admin.post.index'));

        $this->assertDatabaseMissing('pages', [
            'id' => $post->id,
        ]);
    }

    /**
     * 16. Kiểm tra danh sách, thêm, sửa, xóa Quản Trị Viên / Thành Viên (/admin/user)
     */
    public function test_admin_user_management(): void
    {
        $admin = User::first();

        // 1. GET danh sách người dùng (không bị lỗi Undefined variable $users)
        $indexResponse = $this->actingAs($admin, 'admin')->get('/admin/user');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee($admin->email);

        // 2. GET trang thêm người dùng
        $createPageResponse = $this->actingAs($admin, 'admin')->get('/admin/user/create');
        $createPageResponse->assertStatus(200);

        // 3. Tạo người dùng mới
        $createResponse = $this->actingAs($admin, 'admin')->post('/admin/user', [
            'name' => 'Nhân Viên Tokyo Test',
            'username' => 'staff_test_2026',
            'email' => 'staff_test_2026@salondungtokyo.test',
            'password' => '123456',
            'admin_level' => 2,
            'status' => 1,
        ]);
        $createResponse->assertRedirect(route('admin.user.index'));

        $newUser = User::where('username', 'staff_test_2026')->first();
        $this->assertNotNull($newUser);

        // 4. GET trang sửa người dùng
        $editPageResponse = $this->actingAs($admin, 'admin')->get('/admin/user/'.$newUser->id.'/edit');
        $editPageResponse->assertStatus(200);

        // 5. Cập nhật người dùng
        $updateResponse = $this->actingAs($admin, 'admin')->put('/admin/user/'.$newUser->id, [
            'name' => 'Nhân Viên Tokyo Updated',
            'status' => 1,
        ]);
        $updateResponse->assertRedirect(route('admin.user.index'));

        // 6. Xóa người dùng
        $deleteResponse = $this->actingAs($admin, 'admin')->delete('/admin/user/'.$newUser->id);
        $deleteResponse->assertRedirect(route('admin.user.index'));

        $this->assertDatabaseMissing('users', [
            'id' => $newUser->id,
        ]);
    }
}
