<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class AuthUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function showLoginForm()
    {
        return view('user/login');
    }

    public function daftar()
    {
        return view('user/daftar');
    }

    public function login(Request $request)
    {
        config()->set('auth.defaults.guard', 'user');

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credential1 = [
            'no_rekam_medik' => $request->username,
            'password' => $request->password,
        ];

        $credential2 = [
            'nik' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential1)) {
            Auth::guard('user')->attempt($credential1, $request->filled('remember'));
            return redirect()->intended(route('user.home'));
        }

        if (Auth::attempt($credential2)) {
            Auth::guard('user')->attempt($credential2, $request->filled('remember'));
            return redirect()->intended(route('user.home'));
        }

        return redirect()->back()->withInput($request->only('username', 'password'))->withErrors(['error' => ['NIK / No. Rekam Medik atau password salah!']]);
    }

    public function storeDaftar(Request $request)
    {
        $this->validate($request, [
            'nik' => 'unique:user|max:16|min:16',
        ]);

        $user = User::orderBy('id', 'desc')->first();
        $rekam_medik = $user ? $user->id + 1 : 1;

        $data = $request->all();
        $data['no_rekam_medik'] = 'P' . sprintf('%06s', $rekam_medik);
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect('user/login')->with('success', 'Pendaftaran Berhasil, silahkan login');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        return redirect('/user');
    }
}
