<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        
        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array|nullable'
        ]);

        // Sync roles
        $user->syncRoles($request->roles ?? []);

        return redirect()->route('users.index')->with('success', 'User roles updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting the current user
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
