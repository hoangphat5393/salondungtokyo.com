<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Backend\Role;
use App\Models\Backend\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $data;

    public $all_roles;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $routeAdmin = [];
        $routes = app()->routes->getRoutes();
        foreach ($routes as $route) {
            if (Str::startsWith($route->uri(), SC_ADMIN_PREFIX)) {
                $prefix = SC_ADMIN_PREFIX ? $route->getPrefix() : ltrim($route->getPrefix(), '/');
                $routeAdmin[$prefix] = [
                    'uri' => 'ANY::'.$prefix.'/*',
                    'name' => $prefix.'/*',
                    'method' => 'ANY',
                ];
                foreach ($route->methods as $key => $method) {
                    if ($method != 'HEAD' && ! collect($this->without())->first(function ($exp) use ($route) {
                        return Str::startsWith($route->uri(), $exp);
                    })) {
                        $routeAdmin[] = [
                            'uri' => $method.'::'.$route->uri(),
                            'name' => $route->uri(),
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
        $users = User::filter($request)
            ->orderByDesc('id')
            ->paginate(20)
            ->appends($request->all());

        $total_item = $users->total();

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
        $data = $request->except(['roles', 'submit', 'check_pass', 'password_confirmation', 'created_at', '_token']);

        if (! empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user = User::create($data);

        if ($request->has('roles') && is_array($request->roles)) {
            $user->roles()->sync($request->roles);
        }

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.user.edit', $user->id)->with('success', __('Thêm thành viên thành công!'));
        }

        return redirect()->route('admin.user.index')->with('success', __('Thêm thành viên thành công!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $this->data = [
            'user' => $user,
            'all_roles' => $this->all_roles,
            'user_roles' => $user->roles->pluck('id')->toArray(),
        ];

        return view('backend.user.single', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->except(['roles', 'submit', 'check_pass', 'password', 'password_confirmation', 'created_at', '_token', '_method']);

        if ($request->filled('password') && $request->has('check_pass')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->has('roles')) {
            $user->roles()->sync((array) $request->roles);
        }

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.user.edit', $user->id)->with('success', __('Cập nhật thành viên thành công!'));
        }

        return redirect()->route('admin.user.index')->with('success', __('Cập nhật thành viên thành công!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currentUser = Auth::guard('admin')->user();
        if ($currentUser && (int) $currentUser->id !== (int) $id) {
            $user = User::findOrFail($id);
            $user->roles()->detach();
            $user->delete();

            return redirect()->route('admin.user.index')->with('success', __('Xóa tài khoản thành công!'));
        }

        return redirect()->route('admin.user.index')->with('error', __('Không thể xóa tài khoản đang đăng nhập!'));
    }

    public function without()
    {
        $prefix = SC_ADMIN_PREFIX ? SC_ADMIN_PREFIX.'/' : '';

        return [
            $prefix.'login',
            $prefix.'logout',
            $prefix.'forgot',
            $prefix.'deny',
            $prefix.'locale',
            $prefix.'uploads',
        ];
    }
}
