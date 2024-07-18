<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manageUsers()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        $role = Role::find($request->role_id);
        $user->roles()->sync([$role->id]);

        return redirect()->route('admin.users')->with('success', 'Role assigned successfully.');
    }
}
