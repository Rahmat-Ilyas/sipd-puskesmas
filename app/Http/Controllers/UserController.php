<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Poli;
use App\Models\Jadwal;
use App\Models\Admin;

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

    public function store(Request $request, $target)
    {
        // if ($target == 'datadokter') {
        //     $this->validate($request, [
        //         'nip' => 'unique:dokter',
        //     ]);

        //     $data = $request->all();
        //     $data['password'] = bcrypt($request->nip);
        //     Doctor::create($data);

        //     return back()->with('success', 'Data dokter berhasil ditambahkan');
        // }
    }

    public function update(Request $request, $target)
    {
        if ($target == 'datadiri') {
            $user = User::where('id', $request->id)->first();

            $cek_nik = User::where('nik', $request->nik)->where('id', '!=', $request->id)->first();
            if ($cek_nik) {
                return redirect()->back()->withInput($request->all())->withErrors(['error' => ['NIK yang anda masukkan telah terdaftar']]);
            }

            foreach ($request->except(['_token', 'id']) as $key => $data) {
                $user->$key = $data;
            }
            $user->save();

            return back()->with('success', 'Data dokter berhasil diupdate');
        } else if ($target == 'akun') {
            $akun = User::where('id', $request->id)->first();
            if ($request->password == '') $except = ['_token', 'id', 'password'];
            else {
                $except = ['_token', 'id'];
                $request['password'] = bcrypt($request->password);
            }
            foreach ($request->except($except) as $key => $data) {
                $akun->$key = $data;
            }
            $akun->save();

            return back()->with('success', 'Data akun berhasil diupdate');
        }
    }

    public function delete($target, $id)
    {
        // if ($target == 'datadokter') {
        //     $dokter = Doctor::where('id', $id)->first();
        //     $dokter->delete();

        //     return back()->with('success', 'Data dokter berhasil dihapus');
        // } else if ($target == 'datapoli') {
        //     $dokter = Poli::where('id', $id)->first();
        //     $dokter->delete();

        //     return back()->with('success', 'Data poli berhasil dihapus');
        // }
    }
}
