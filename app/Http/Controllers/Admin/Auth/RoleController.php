<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Backend\Permission;
use App\Models\Backend\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public $template;

    public $data;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::filter($request)
            ->orderBy('id')
            ->paginate(20)
            ->appends($request->all());
        $total_item = $roles->count();

        return view('backend.role.index', compact('roles', 'total_item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['permission'] = Permission::pluck('name', 'id')->all();

        return view('backend.role.single', $this->data);
    }

    /**
     * Post create new item in admin
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->except(['created_at', 'submit', '_token']);

        $dataInsert = [
            'name' => $data['name'],
            'name_en' => $data['name_en'] ?? null,
            'slug' => ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']),
            'display_name' => $data['display_name'] ?? $data['name'],
            'description' => $data['description'] ?? null,
        ];

        $role = Role::create($dataInsert);
        $permission = $data['permission'] ?? [];
        $administrators = $data['administrators'] ?? [];

        // Insert permission
        if ($permission) {
            $role->permissions()->attach($permission);
        }
        // Insert administrators
        if ($administrators) {
            $role->administrators()->attach($administrators);
        }

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.role.edit', $role->id)->with('success', 'Role has been created successfully');
        }

        return redirect()->route('admin.role.index')->with('success', 'Role has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role, int $id)
    {
        $role = Role::find($id);

        return view('backend.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role, int $id)
    {
        $this->data['role'] = Role::findOrFail($id);

        if ($this->data['role']) {
            $this->data['permission_selected'] = $this->data['role']->permissions()->pluck('permissions.id')->toArray();
            $this->data['permission'] = Permission::pluck('name', 'id')->all();

            return view('backend.role.single', $this->data);
        }

        return view('404');
    }

    /**
     * Update role in admin
     */
    public function update(Request $request, int $id = 0)
    {
        $id = $id ?: ($request->input('id') ?: 0);
        $data = $request->except(['_token', '_method', 'submit']);

        $dataUpdate = [
            'name' => $data['name'],
            'name_en' => $data['name_en'] ?? null,
            'slug' => ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']),
            'display_name' => $data['display_name'] ?? $data['name'],
            'description' => $data['description'] ?? null,
        ];

        $role = Role::findOrFail($id);
        $role->update($dataUpdate);

        $permission = $data['permission'] ?? [];
        $administrators = $data['administrators'] ?? [];

        $role->permissions()->detach();
        if ($permission) {
            $role->permissions()->attach($permission);
        }

        $role->administrators()->detach();
        if ($administrators) {
            $role->administrators()->attach($administrators);
        }

        $save = $request->submit ?? 'save';
        if ($save == 'apply') {
            return redirect()->route('admin.role.edit', $id)->with('success', 'Role has been updated successfully');
        }

        return redirect()->route('admin.role.index')->with('success', 'Role has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->permissions()->detach();
            $role->administrators()->detach();
            $role->delete();
        }

        return redirect()->route('admin.role.index')->with('success', 'Role deleted successfully.');
    }
}
