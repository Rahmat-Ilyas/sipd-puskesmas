<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthDoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('doctor/login');
    }

    public function login(Request $request)
    {
        config()->set('auth.defaults.guard', 'doctor');

        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required'
        ]);

        $credential = [
            'nip' => $request->nip,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)) {
            Auth::guard('doctor')->attempt($credential, $request->filled('remember'));
            return redirect()->intended(route('doctor.home'));
        }

        return redirect()->back()->withInput($request->only('nip', 'password'))->withErrors(['error' => ['NIP atau password yang anda masukkan salah!']]);
    }

    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        return redirect('/doctor');
    }
}
