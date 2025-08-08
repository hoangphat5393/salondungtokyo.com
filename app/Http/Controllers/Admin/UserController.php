<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\OrderExport;

use App\Models\Backend\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\Backend\Setting, App\Models\Backend\Addtocard;
use App\Models\Backend\Role;

use App\Libraries\Helpers;

class UserController extends Controller
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
        $this->all_roles = Role::pluck('name', 'id')->all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::guard('admin')->user()->admin_level == 99999) {
            $users = User::filter($request)
                ->orderBy('id')
                ->paginate(20)
                ->appends($request->all());

            $total_item = $users->count();
        }
        return view('backend.user.index', compact('users', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['all_roles'] = $this->all_roles;
        return view('backend.user.single', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = request()->except(['roles', 'submit', 'check_pass', 'password_confirmation', 'created_at']);

        // dd($data);
        $save = $data['submit'] ?? 'apply';

        $data['password'] = Hash::make($request->password);

        $respons = User::create($data);
        $insert_id = $respons->id;

        // SAVE ROLE
        $role_id = $request->roles ?? '';

        if ($role_id != '') {
            $admin = User::find($insert_id);
            $admin->roles()->sync($role_id);
        }

        if ($save == 'apply') {
            // $msg = "User has been Updated";
            return redirect(route('admin.user.edit', array($insert_id)));
        } else {
            return redirect(route('admin.user.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, int $id)
    {
        $user = $user::find($id);
        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, int $id)
    {
        $user = User::find($id);

        $this->data = [
            'user' => $user,
            'all_roles' => $this->all_roles,
            'user_roles' => $user->roles->pluck('id')->toArray(),
        ];

        if ($user) {
            return view('backend.user.single', $this->data);
        } else {
            return view('404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = request()->except(['roles', 'submit', 'check_pass', 'password', 'password_confirmation', 'created_at', 'submit']);

        $sid = $request->id ?? 0;

        $post_id = $sid;

        // NẾU CÓ THAY ĐỔI PASSWORD
        if (isset($request->check_pass)) {
            $data['password']  = bcrypt($request->password);
        }

        $user = User::findOrFail($request->id);
        $user->update($data);

        // SAVE ROLE
        $role_id = $request->roles ?? '';

        if ($role_id != '') {
            $admin = User::find($post_id);
            $admin->roles()->sync($role_id);
        }

        $save = $request->submit ?? 'apply';

        if ($save == 'apply') {
            // $msg = "User has been updated successfully";
            // $url = route('admin.user.edit', array($request->id));
            return redirect(route('admin.user.edit', array($request->id)));
        } else {
            return redirect(route('admin.user.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, int $id)
    {
        // $user->find($id)->destroy();
        // return redirect()->route('admin.userAdmin.index')->with('success', 'User deleted successfully.');

        $user_current = auth()->user();
        if (auth()->check() && $user_current->id != $id) {
            $loadDelete = User::find($id)->delete();
            $msg = "Admin account has been Delete";
            // $url = route('admin.user.index');
            // Helpers::msg_move_page($msg, $url);
            return redirect(route('admin.user.index'));
        }
        $msg = "Không thực hiện được thao tác này";
        $url = route('admin.user.index');
        Helpers::msg_move_page($msg, $url);
        // return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Page $page, $id)
    // {
    //     $page->find($id)->delete();
    //     return redirect()->route('admin.page.index')->with('success', 'Page deleted successfully.');
    // }


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
