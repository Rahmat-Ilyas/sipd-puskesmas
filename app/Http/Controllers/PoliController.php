<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:poli');
    }

    public function home()
    {
        return view('poli/home');
    }

    public function page($page)
    {
        return view('poli/'.$page);
    }

    public function pagedir($dir = NULL, $page)
    {
        return view('poli/'.$dir.'/'.$page);
    }
}
