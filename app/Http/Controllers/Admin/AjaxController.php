<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Album;
use App\Models\Backend\AlbumItem;
use App\Models\Backend\Category;
use App\Models\Backend\Contact;
use App\Models\Backend\EmailTemplate;
use App\Models\Backend\Menu;
use App\Models\Backend\MenuItems;
use App\Models\Backend\Page;
use App\Models\Backend\Permission;
use App\Models\Backend\Role;
use App\Models\Backend\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    // public $response = [
    //     "success" => '', // True or false
    //     "message" => '',
    //     "data" => [],
    //     "errors" => [
    //         "code" => 404,
    //         "details" => "The user with the given ID does not exist."
    //     ]
    // ];

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function ajax_delete(Request $rq)
    {
        $type = $rq->type;
        $check_data = $rq->seq_list;
        $arr = [];
        $values = '';

        for ($i = 0; $i < count($check_data); $i++) {
            $values .= (int) $check_data[$i].',';
            $arr[] = (int) $check_data[$i];
        }

        if ($type == 'page' || $type == 'post' || $type == 'service') {
            $type = 'page';
        }

        session()->flash('success', __('Đã xóa dữ liệu thành công!'));

        switch ($type) {
            case 'user':
                // DELETE DATA FROM PIVOT TABLE
                DB::table('role_user')->whereIn('user_id', $arr)->delete();

                // DELETE USER
                User::whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'role':

                // DELETE DATA FROM PIVOT TABLE
                DB::table('permission_role')->whereIn('role_id', $arr)->delete();
                DB::table('role_user')->whereIn('role_id', $arr)->delete();

                Role::whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'permission':

                // DELETE DATA FROM PIVOT TABLE
                DB::table('permission_role')->whereIn('permission_id', $arr)->delete();

                Permission::whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'page':
                Page::whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'email-template':
                EmailTemplate::whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'menuwp':
                $menuWp = Menu::whereIn('id', $arr)->get();

                if ($menuWp->count() > 0) {
                    foreach ($menuWp as $item) {
                        // DELETE LIST CHILD
                        if ($item->items->count() > 0) {
                            $item_child_id = $item->items->pluck('id');
                            MenuItems::whereIn('id', $item_child_id)->delete();
                        }
                        // DELETE SLIDER
                        $item->delete();
                    }
                }

                return 1;
                break;
            case 'post':
                Page::where('type', 'post')->whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'service-category':
                Category::whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'contact':
                Contact::whereIn('id', $arr)->delete();

                return 1;
                break;
            case 'album':

                AlbumItem::whereIn('album_id', $arr)->delete();
                Album::whereIn('id', $arr)->delete();

                return 1;
                break;
            default:
                // code...
                break;
        }
    }

    public function ajax_replicate(Request $rq)
    {
        $type = $rq->type;
        $check_data = $rq->seq_list;
        $arr = [];
        $values = '';

        for ($i = 0; $i < count($check_data); $i++) {
            $values .= (int) $check_data[$i].',';
            $arr[] = (int) $check_data[$i];
        }

        if ($type == 'post-categories' || $type == 'product-categories') {
            $type = 'categories';
        }

        if ($type == 'post' || $type == 'campagin') {
            $type = 'post';
        }

        session()->flash('success', __('Đã nhân bản dữ liệu thành công!'));

        switch ($type) {
            case 'user':
                // Replicate User + Role
                $i = 1;
                $newUser = '';
                foreach ($arr as $id) {
                    $user = User::find($id);

                    // Get categories of current post
                    // $category_id = $user->categories->pluck('id')->toArray();
                    $role_id = $user->roles->pluck('id')->toArray();

                    // Replicate post
                    $newUser = $user->replicate();
                    // $newUser->name = $newUser->name . ' ' . $i;
                    $newUser->name = $newUser->name.' (Copy '.time().')';
                    $newUser->email = $newUser->email.' (Copy '.time().')';
                    $newUser->created_at = Carbon::now(); // changing the created_at date
                    $newUser->save(); // saving it to the database

                    // $name = $newUser->name . ' (Copy id: ' . $newUser->id . ')';

                    // Update name
                    // Admin::where("id", $newUser->id)->update(['name' => $name]);

                    // Replicate User Role
                    $newUser = User::find($newUser->id);
                    $newUser->roles()->sync($role_id);
                    $i++;
                }

                return 1;
                break;
            case 'role':
                // Replicate Role + Permission
                $i = 1;
                $newRole = '';
                foreach ($arr as $id) {
                    $role = Role::find($id);

                    // Get categories of current post
                    $permission_id = $role->permissions->pluck('id')->toArray();

                    // Replicate role
                    $newRole = $role->replicate();
                    $newRole->created_at = Carbon::now(); // changing the created_at date
                    $newRole->save(); // saving it to the database

                    $slug = Str::slug($newRole->name.'-'.$newRole->id);

                    // Update slug
                    Role::where('id', $newRole->id)->update(['slug' => $slug]);

                    // Replicate Role Permission
                    $newRole = Role::find($newRole->id);
                    $newRole->permissions()->sync($permission_id);
                    $i++;
                }

                return 1;
                break;
            case 'permission':
                // Replicate Permission
                $i = 1;
                $newPermission = '';
                foreach ($arr as $id) {
                    $permission = Permission::find($id);

                    // Replicate permission
                    $newPermission = $permission->replicate();
                    // $newPermission->slug = Str::slug($newPermission->name);
                    // $newPermission->name = $newPermission->name . ' - Copy ' . time(); // Hoặc sử dụng bất kỳ phương pháp nào để tạo giá trị duy nhất
                    $newPermission->created_at = Carbon::now(); // changing the created_at date
                    $newPermission->save(); // saving it to the database

                    $name = $newPermission->name.'-'.$i;
                    $slug = Str::slug($newPermission->name.'-'.$newPermission->id);

                    // update sort = id
                    Permission::where('id', $newPermission->id)->update(['slug' => $slug, 'name' => $name]);
                    $i++;
                }

                return 1;
                break;
            case 'page':
                // Replicate Post + Category
                $i = 1;
                $newPage = '';
                foreach ($arr as $id) {
                    $page = Page::find($id);

                    // Replicate post
                    $newPage = $page->replicate();
                    // $newPost->name = $newPost->name . ' ' . $i;
                    // $newPost->slug = Str::slug($newPost->name);
                    $newPage->created_at = Carbon::now(); // changing the created_at date
                    $newPage->save(); // saving it to the database

                    $slug = Str::slug($newPage->name.'-'.$newPage->id);

                    // update sort = id
                    Page::where('id', $newPage->id)->update(['slug' => $slug, 'sort' => $newPage->id]);

                    // Tạo file blade
                    $fileName = "page-{$newPage->id}.blade.php";
                    $filePath = resource_path("views/frontend/landing/{$fileName}");

                    // Kiểm tra nếu file đã tồn tại, nếu chưa có thì tạo file
                    if (! File::exists($filePath)) {

                        // Nội dung mặc định trong file
                        $fileContent = "@extends('frontend.layouts.master')\n\n@section('content')\n<h1>{$newPage->name}</h1>\n@endsection";

                        // Tạo thư mục nếu chưa tồn tại
                        File::ensureDirectoryExists(resource_path('views/frontend/landing'));

                        // Ghi nội dung vào file
                        File::put($filePath, $fileContent);
                    }

                    // Replicate Post Category
                    $newPage = Page::find($newPage->id);
                    $i++;
                }

                return 1;
                break;
            case 'email-template':
                // Replicate Email Template
                $i = 1;
                $newTemplate = '';
                foreach ($arr as $id) {

                    $template = EmailTemplate::find($id);

                    // Replicate post
                    $newTemplate = $template->replicate();
                    $newTemplate->created_at = Carbon::now(); // changing the created_at date
                    $newTemplate->save(); // saving it to the database

                    // update sort = id
                    EmailTemplate::where('id', $newTemplate->id)->update(['sort' => $newTemplate->id]);
                    $i++;
                }

                return 1;
                break;
            case 'menuwp':
                // Replicate Slider + list image
                $i = 1;
                $newMenuWP = '';
                foreach ($arr as $id) {
                    $menuWP = Menu::find($id);

                    // Get menu list items
                    $list_items = $menuWP->items;

                    // Replicate Slider
                    $newMenuWP = $menuWP->replicate();
                    $newMenuWP->created_at = Carbon::now(); // changing the created_at date
                    $newMenuWP->save(); // saving it to the database

                    // update sort = id
                    // Slider::where("id", $newSlider->id)->update(['sort' => $newSlider->id]);

                    // Replicate Slider list image
                    if ($list_items->count() > 0) {
                        foreach ($list_items as $item) {
                            $menuItem = MenuItems::find($item->id);
                            $newMenuItem = $menuItem->replicate();
                            $newMenuItem->menu_id = $newMenuWP->id; // changing the maenu_id
                            $newMenuItem->created_at = Carbon::now(); // changing the created_at date
                            $newMenuItem->save(); // saving it to the database
                        }
                    }
                    $i++;
                }

                return 1;
                break;
            case 'categories':
                // Replicate Category Product
                $i = 1;
                $newCaterory = '';
                foreach ($arr as $id) {
                    $category = Category::find($id);

                    // Get categories of current post
                    // $category_id = $post->categories->pluck('id')->toArray();

                    // Replicate post
                    $newCaterory = $category->replicate();
                    $newCaterory->name = $newCaterory->name.' '.$i;
                    $newCaterory->slug = Str::slug($newCaterory->name);
                    $newCaterory->created_at = Carbon::now(); // changing the created_at date
                    $newCaterory->save(); // saving it to the database

                    // update sort = id
                    Category::where('id', $newCaterory->id)->update(['sort' => $newCaterory->id]);

                    // Replicate Post Category
                    // $newPost = Post::find($newCaterory->id);
                    // $newPost->categories()->sync($category_id);
                    $i++;
                }

                return 1;
                break;
            case 'post':
            case 'service':
                $i = 1;
                foreach ($arr as $id) {
                    $page = Page::find($id);
                    if (! $page) {
                        continue;
                    }
                    $newPage = $page->replicate();
                    $newPage->created_at = Carbon::now();
                    $newPage->save();

                    $slug = Str::slug(($newPage->name ?? 'post').'-'.$newPage->id);
                    Page::where('id', $newPage->id)->update(['slug' => $slug, 'sort' => $newPage->id]);
                    $i++;
                }

                return 1;
                break;
            case 'album':
                $i = 1;
                foreach ($arr as $id) {
                    $album = Album::with('items')->find($id);
                    if (! $album) {
                        continue;
                    }
                    $newAlbum = $album->replicate();
                    $newAlbum->name = $newAlbum->name.' (Bản sao)';
                    $newAlbum->created_at = Carbon::now();
                    $newAlbum->save();

                    Album::where('id', $newAlbum->id)->update(['sort' => $newAlbum->id]);

                    foreach ($album->items as $item) {
                        $newItem = $item->replicate();
                        $newItem->album_id = $newAlbum->id;
                        $newItem->created_at = Carbon::now();
                        $newItem->save();
                    }
                    $i++;
                }

                return 1;
                break;
            default:
                // code...
                break;
        }
    }

    // Quick change value of data list
    public function ajax_quickchange(Request $rq)
    {
        $rq->validate([
            'id' => 'required|integer',
            'model' => 'nullable|string',
            'table' => 'nullable|string',
            'column' => 'nullable|string',
            'field' => 'nullable|string',
            'value' => 'nullable',
        ]);

        $id = $rq->id;
        $column = $rq->column ?? $rq->field ?? 'status';
        $value = $rq->value;
        $modelClass = $rq->model;

        if (! $modelClass && $rq->table) {
            $tableMap = [
                'pages' => Page::class,
                'category' => Category::class,
                'albums' => Album::class,
                'contacts' => Contact::class,
                'email_templates' => EmailTemplate::class,
                'users' => User::class,
            ];
            $modelClass = $tableMap[$rq->table] ?? null;
        }

        if (! $modelClass) {
            $modelClass = Page::class;
        }

        // Whitelist allowed models for safety
        $allowedModels = [
            Page::class,
            Category::class,
            Album::class,
            AlbumItem::class,
            Contact::class,
            EmailTemplate::class,
            User::class,
        ];

        // Whitelist allowed columns for safety
        $allowedColumns = ['status', 'sort', 'is_home', 'is_hot', 'hot', 'hidden'];

        if (in_array($modelClass, $allowedModels) && in_array($column, $allowedColumns)) {
            $modelClass::where('id', $id)->update([$column => $value]);

            return response()->json(['success' => true, 'message' => __('Cập nhật thành công!')]);
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized action'], 403);
    }

    public function update_new_item_status(Request $request)
    {
        if (isset($request['check']) && $request['sid'] != '') {
            $status = $request['check'];
            $postID = (int) $request['sid'];
            if ($postID > 0) {
                // $respons1 = Theme::where("id", "=", $postID)->update(array('item_new' => $status));
                echo 'OK';
            } else {
                echo 'Lỗi';
            }
        }
    }

    public function checkPassword(Request $request)
    {
        $request->current_password;
        if (! Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            echo 'Mật khẩu hiện tại không chính xác';
        }
    }

    public function ajaxUpdateSort(Request $request)
    {
        $sort = $request->input('sort');
        if ($sort) {
            // Lưu thứ tự mới vào cơ sở dữ liệu
            foreach ($sort as $index => $id) {
                // Cập nhật thứ tự cho từng mục, giả sử bạn có model AlbumItem
                AlbumItem::find($id)->update(['sort' => $index]);
            }

            return response()->json(['Update success' => true]);
        } else {
            return response('404 data Not Found');
        }
    }
}
