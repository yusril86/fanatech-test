<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('pages.backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate(['name' => 'required']);

        Role::create($validation);

        return to_route('admin.role.index')->with([
            'status' => 'Berhasil !',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        return view('pages.backend.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $validation = $request->validate(['name' => 'required']);
        $role->update($validation);

        return to_route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if ($role->name == 'SuperAdmin') {
            return back()->with('message', 'Kamu adalah super admin');
        }

        $role->delete();
        return back()->with([
            'status' => 'Berhasil ! di hapus',
            'type' => 'success'
        ]);
    }

    public function rolePermission($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('pages.backend.role.givepermission', compact('permissions', 'role'));

        // return dd($role->id);
    }


    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with([
                "status" => "Hak akses sudah ada",
                "type" => "danger"
            ]);
        }

        $role->givePermissionTo($request->permission);
        return back()->with([
            "status" => "Hak akses ditambahkan",
            "type" => "success"
        ]);
    }

    public function revokePermission($roleId, Permission $permission){
        $role = Role::findOrFail($roleId);
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with([
                "status" => "Hak akses dicabut",
                "type" => "success"
            ]);
        }

        return back()->with([
            "status" => "Hak akses tidak tersedia",
            "type" => "success"
        ]);

        // dd($role->id, $permission->id);
    }
}
