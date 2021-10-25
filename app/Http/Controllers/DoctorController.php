<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:doctor');
    }

    public function home()
    {
        return view('doctor/home');
    }

    public function page($page)
    {
        return view('doctor/'.$page);
    }

    public function pagedir($dir = NULL, $page)
    {
        return view('doctor/'.$dir.'/'.$page);
    }
}
