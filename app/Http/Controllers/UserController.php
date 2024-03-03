<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

//include custom file
use App\Helpers\PermissionHelper;

/**
 * @param featureName = Users
 * @param permissionName = View,Create,Update,Delete
 */

class UserController extends Controller
{
    protected $pHelper;

    public function __construct()
    {
        $this->pHelper = new PermissionHelper();
    }

    public function index()
    {
        $this->pHelper->authorizeUser('Users','View');
        $users = User::paginate(10);
        $users->load('role');
        return view('users.users-list',compact('users'));
    }

    public function create()
    {
        $this->pHelper->authorizeUser('Users','Create');
        $roles = Role::get();
        return view('users.user-create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->pHelper->authorizeUser('Users','Create');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:8','max:11'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'address' => ['required', 'string','min:3', 'max:255'],
            'gender' => ['required'],
            'role_id' => ['required','numeric'],
            'is_active' => ['nullable'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);
        // dd($request);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'gender' => $request->gender,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('users.list')->with('success', 'New User Added');  
    }
    
    public function edit(User $user)
    {
        $this->pHelper->authorizeUser('Users','Update');
        $roles = Role::get();
        return view('users.user-edit',compact('roles','user'));
    }

    public function update(Request $request, User $user)
    {
        $this->pHelper->authorizeUser('Users','Update');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:8','max:11'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'address' => ['required', 'string','min:3', 'max:255'],
            'gender' => ['required'],
            'role_id' => ['required','numeric'],
            'is_active' => ['nullable'],

        ]);
        // dd($request);

        try {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'gender' => $request->gender,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'role_id' => $request->role_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('users.list')->with('success', 'User Info has Updated');  
    }

    public function destroy(User $user)
    {
        $this->pHelper->authorizeUser('Users','Delete');
        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('users.list')->with('success', 'User Removed');  
    }
}
