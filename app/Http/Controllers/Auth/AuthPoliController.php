<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthPoliController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:poli')->except('logout');
    }

    public function showLoginForm()
    {
        return view('poli/login');
    }

    public function login(Request $request)
    {
        config()->set('auth.defaults.guard', 'poli');

        $this->validate($request, [
            'kode_poli' => 'required',
            'password' => 'required'
        ]);

        $credential = [
            'kode_poli' => $request->kode_poli,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)) {
            Auth::guard('poli')->attempt($credential, $request->filled('remember'));
            return redirect()->intended(route('poli.home'));
        }

        return redirect()->back()->withInput($request->only('kode_poli', 'password'))->withErrors(['error' => ['Kode Poli atau password yang anda masukkan salah!']]);
    }

    public function logout(Request $request)
    {
        Auth::guard('poli')->logout();

        $request->session()->invalidate();

        return redirect('/poli');
    }
}
