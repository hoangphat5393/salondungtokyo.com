<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\OrderExport;
use App\Models\Frontend\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Backend\Setting, App\Models\Backend\Admin, App\Models\Backend\Addtocard;
use Auth, DB, File, Image, Redirect, Cache;
use App\Models\Backend\AdminRole;

class UserAdminController extends Controller
{
    public $data, $all_roles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $routes = app()->routes->getRoutes();
        foreach ($routes as $route) {
            if (Str::startsWith($route->uri(), SC_ADMIN_PREFIX)) {
                $prefix = SC_ADMIN_PREFIX ? $route->getPrefix() : ltrim($route->getPrefix(), '/');
                $routeAdmin[$prefix] = [
                    'uri'    => 'ANY::' . $prefix . '/*',
                    'name'   => $prefix . '/*',
                    'method' => 'ANY',
                ];
                foreach ($route->methods as $key => $method) {
                    if ($method != 'HEAD' && !collect($this->without())->first(function ($exp) use ($route) {
                        return Str::startsWith($route->uri, $exp);
                    })) {
                        $routeAdmin[] = [
                            'uri'    => $method . '::' . $route->uri,
                            'name'   => $route->uri,
                            'method' => $method,
                        ];
                    }
                }
            }
        }

        $this->data['routeAdmin'] = $routeAdmin;
        $this->all_roles = AdminRole::pluck('name', 'id')->all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::guard('admin')->user()->admin_level == 99999) {
            $users = Admin::filter($request)
                ->orderBy('id')
                ->paginate(20)
                ->appends($request->all());
            $total_item = $users->count();
        }
        return view('backend.user-admin.index', compact('users', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['all_roles'] = $this->all_roles;
        return view('backend.user-admin.single', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $user, int $id)
    {
        $user = Admin::find($id);

        $this->data = [
            'data_admin' => $user,
            'all_roles' => $this->all_roles,
            'user_roles' => $user->roles->pluck('id')->toArray(),
        ];

        if ($user) {
            return view('backend.user-admin.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function store(UpdateUserRequest $request)
    {
        $data = request()->except(['_token', 'roles', 'check_pass', 'password', 'password_confirmation', 'created_at', 'submit', 'tab_lang']);

        // dd($data);
        $save = $data['submit'] ?? 'apply';

        $respons = Admin::create($data);
        $insert_id = $respons->id;

        // SAVE ROLE
        $role_id = $request->roles ?? '';

        if ($role_id != '') {
            $admin = Admin::find($insert_id);
            $admin->roles()->sync($role_id);
        }

        if ($save == 'apply') {
            $msg = "User has been Updated";
            $url = route('admin.userAdmin.edit', array($insert_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.userAdmin.index'));
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, Admin $user)
    {
        $data = request()->except(['_token', 'roles', 'check_pass', 'password', 'password_confirmation', 'created_at', 'submit', 'tab_lang']);

        $sid = $request->id ?? 0;

        $post_id = $sid;

        // NẾU CÓ THAY ĐỔI PASSWORD
        if (isset($request->check_pass)) {
            $data['password']  = bcrypt($request->password);
        }

        $user = Admin::findOrFail($request->id);
        $user->update($data);

        // SAVE ROLE
        $role_id = $request->roles ?? '';

        if ($role_id != '') {
            $admin = Admin::find($post_id);
            $admin->roles()->sync($role_id);
        }

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            $msg = "User has been updated successfully";
            $url = route('admin.userAdmin.edit', array($request->id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.userAdmin.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $user, int $id)
    {
        // $user->find($id)->destroy();
        // return redirect()->route('admin.userAdmin.index')->with('success', 'User deleted successfully.');

        $user_current = auth()->user();
        if (auth()->check() && $user_current->id != $id) {
            $loadDelete = Admin::find($id)->delete();
            $msg = "Admin account has been Delete";
            $url = route('admin.userAdmin.index');
            Helpers::msg_move_page($msg, $url);
        }
        $msg = "Không thực hiện được thao tác này";
        $url = route('admin.userAdmin.index');
        Helpers::msg_move_page($msg, $url);
    }


    public function deleteUserAdmin($id)
    {
        $user_current = auth()->user();
        if (auth()->check() && $user_current->id != $id) {
            $loadDelete = Admin::find($id)->delete();
            $msg = "Admin account has been Delete";
            $url = route('admin.userAdmin.index');
            Helpers::msg_move_page($msg, $url);
        }
        $msg = "Không thực hiện được thao tác này";
        $url = route('admin.userAdmin.index');
        Helpers::msg_move_page($msg, $url);
    }


    public function without()
    {
        $prefix = SC_ADMIN_PREFIX ? SC_ADMIN_PREFIX . '/' : '';
        return [
            $prefix . 'login',
            $prefix . 'logout',
            $prefix . 'forgot',
            $prefix . 'deny',
            $prefix . 'locale',
            $prefix . 'uploads',
        ];
    }
}
