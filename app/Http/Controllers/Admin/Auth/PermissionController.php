<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Backend\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public $data;

    public $template;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $routes = app()->routes->getRoutes();
        $routeAdmin = [];
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
                        return Str::startsWith($route->uri, $exp);
                    })) {
                        $routeAdmin[] = [
                            'uri' => $method.'::'.$route->uri,
                            'name' => $route->uri,
                            'method' => $method,
                        ];
                    }
                }
            }
        }

        $this->data['routeAdmin'] = $routeAdmin;
        $this->template = 'admin.permission';
        $this->data['title_head'] = 'Permissions';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = Permission::filter($request)
            ->orderBy('id')
            ->paginate(20)
            ->appends($request->all());
        $total_item = $permissions->count();

        return view('backend.permission.index', compact('permissions', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.permission.single', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $data = $request->except(['created_at', 'submit', '_token']);

        $data['slug'] = ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']);
        $data['http_uri'] = is_array($data['http_uri'] ?? null) ? implode(',', $data['http_uri']) : ($data['http_uri'] ?? '');

        // Create
        $permission = Permission::create($data);
        $insert_id = $permission->id;

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.permission.edit', $insert_id)->with('success', 'Permission has been created successfully');
        }

        return redirect()->route('admin.permission.index')->with('success', 'Permission has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission, int $id)
    {
        $permission = $permission::find($id);

        return view('backend.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission, int $id)
    {
        $this->data['permission'] = Permission::findOrFail($id);

        return view('backend.permission.single', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, int $id)
    {
        $data = $request->except(['_token', '_method', 'submit']);

        $data['slug'] = ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']);
        $data['http_uri'] = is_array($data['http_uri'] ?? null) ? implode(',', $data['http_uri']) : ($data['http_uri'] ?? '');

        $permission = Permission::findOrFail($id);
        $permission->update($data);

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.permission.edit', $id)->with('success', 'Permission has been updated successfully');
        }

        return redirect()->route('admin.permission.index')->with('success', 'Permission has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->roles()->detach();
            $permission->delete();
        }

        return redirect()->route('admin.permission.index')->with('success', 'Permission deleted successfully.');
    }

    public function roleGroup()
    {
        dd('roleGroup');
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
