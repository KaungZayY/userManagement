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

        $user = User::create([
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

        if(!$user)
        {
            return redirect()->back()->with('error','Cannot Create New User');
        }
        return redirect()->route('users.list')->with('success', 'New User Added');  
    }
}
