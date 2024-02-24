<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $users->load('role');
        return view('users.users-list',compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('users.user-create',compact('roles'));
    }

    public function store(Request $request)
    {
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
        $roles = Role::get();
        return view('users.user-edit',compact('roles','user'));
    }

    public function update(Request $request, User $user)
    {
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
        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e);
        }
        return redirect()->route('users.list')->with('success', 'User Removed');  
    }
}
