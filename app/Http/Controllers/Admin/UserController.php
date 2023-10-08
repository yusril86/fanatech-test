<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::orderBy('created_at','Desc')->get();
        $users = User::with('roles')->get();
        return view('pages.backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('pages.backend.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required',            
        ]);

        $validation['password'] = Hash::make($request->password);

        // $role = Role::create(['name' => $request->roles]);
        $user = User::create($validation);     
        
        $user->assignRole($request->role);

        return redirect(route('admin.user.index'))->with([
            'status' => 'success',
            'message' => "Berhasil ditambahkan"
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
        $user = User::findOrFail($id);
        $userRole =  Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('pages.backend.user.edit',compact('user','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validation = $request->validate([
            'name' => 'required',
            'email' => "required|unique:users,email, $user->id",
            'number_phone' => 'required',
            'status' => 'required'
        ]);

        $user->update($validation);

        $user->syncRoles($request->role);

        return redirect(route('admin.user.index'))->with([
            'status' => 'Data updated succesfully',
            'type'   => 'success'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('SuperAdmin')) {
            return back()->with([
                'status'=> 'Kamu adalah super admin !', 
                'type' => 'danger']);
        }

        $user->delete();

        return redirect()->back();
    }
}
