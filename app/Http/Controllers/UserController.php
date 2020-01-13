<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;

class UserController extends Controller
{
    //

    

    public function user()
    {
        return view('dashboard.user');
    }

    public function admin()
    {
        $blogs = Blog::all();
        $users = User::with('roles')->get();
        return view('dashboard.admin', ['users' => $users],['blogs'=>$blogs]);
    }
}
