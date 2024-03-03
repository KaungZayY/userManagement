<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Role;
use Illuminate\Http\Request;

//include custom file
use App\Helpers\PermissionHelper;

/**
 * @param featureName = Roles
 * @param permissionName = View,Create,Update,Delete
 */

class RoleController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function index()
    {
        $this->pHelper->authorizeUser('Roles','View');
        $roles = Role::all();
        return view('roles.roles-list',compact('roles'));
    }

    public function create()
    {
        $this->pHelper->authorizeUser('Roles','Create');
        $features = Feature::all();
        $features->load('permissions');
        return view('roles.roles-create',compact('features'));
    }

    public function store(Request $request)
    {
        $this->pHelper->authorizeUser('Roles','Create');
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
        $this->pHelper->authorizeUser('Roles','Update');
        $features = Feature::all();
        $features->load('permissions');
        return view('roles.role-edit',compact('role','features'));
    }

    public function update(Request $request, Role $role)
    {
        $this->pHelper->authorizeUser('Roles','Update');
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
        $this->pHelper->authorizeUser('Roles','Delete');
        try {
            $role->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('roles.list')->with('success', 'Role Removed');  
    }
}
