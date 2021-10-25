<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function home()
    {
        return view('user/home');
    }

    public function page($page)
    {
        return view('user/'.$page);
    }

    public function pagedir($dir = NULL, $page)
    {
        return view('user/'.$dir.'/'.$page);
    }
}
