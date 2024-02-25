<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.roles-list',compact('roles'));
    }

    public function create()
    {
        $features = Feature::all();
        $features->load('permissions');
        return view('roles.roles-create',compact('features'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['required','array','min:1'],
            'permissions.*' => ['exists:permissions,id'],
        ]);
        try {
            $role = Role::create([
                'name' => $request->name,
            ]);

            foreach ($request->input('permissions') as $permissionId) {
                $role->permissions()->attach($permissionId);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('roles.list')->with('success', 'New Role Added');  
    }

    public function edit(Role $role)
    {
        $features = Feature::all();
        $features->load('permissions');
        return view('roles.role-edit',compact('role','features'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'permissions' => ['required','array','min:1'],
            'permissions.*' => ['exists:permissions,id'],
        ]);
        try {
            $role->update([
                'name' => $request->name,
            ]);

            $role->permissions()->sync($request->permissions);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('roles.list')->with('success', 'Role Permissions Updated');  
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('roles.list')->with('success', 'Role Removed');  
    }
}
