<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function store()
    {
        dd('hit');
    }
}
