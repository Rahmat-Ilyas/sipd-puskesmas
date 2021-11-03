<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Poli;
use App\Models\Jadwal;
use App\Models\Admin;
use App\Models\Antrian;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->cancelAntrian();
    }
    
    public function home()
    {
        return view('admin/home');
    }

    public function page($page)
    {
        return view('admin/'.$page);
    }

    public function pagedir($dir = NULL, $page)
    {
        return view('admin/'.$dir.'/'.$page);
    }

    public function store(Request $request, $target)
    {
        if ($target == 'datadokter') {
            $this->validate($request, [
                'nip' => 'unique:dokter',
            ]);

            $data = $request->all();
            $data['password'] = bcrypt($request->nip);
            Doctor::create($data);

            return back()->with('success', 'Data dokter berhasil ditambahkan');
        } else if ($target == 'datapoli') {
            $data = $request->all();
            $data['kode_poli'] = 'pl'.mt_rand(1111, 9999);
            $data['password'] = bcrypt('12345');
            Poli::create($data);

            return back()->with('success', 'Data poli baru berhasil ditambahkan');
        } 
    }

    public function update(Request $request, $target)
    {
        if ($target == 'datadokter') {
            $dokter = Doctor::where('id', $request->id)->first();
            if ($request->password == '') $except = ['_token', 'id', 'password'];
            else {
                $except = ['_token', 'id'];
                $request['password'] = bcrypt($request->password);
            }
            foreach ($request->except($except) as $key => $data) {
                $dokter->$key = $data;
            }
            $dokter->save();

            return back()->with('success', 'Data dokter berhasil diupdate');
        } else if ($target == 'datapasien') {
            $pasien = User::where('id', $request->id)->first();
            if ($request->password == '') $except = ['_token', 'id', 'password'];
            else {
                $except = ['_token', 'id'];
                $request['password'] = bcrypt($request->password);
            }
            foreach ($request->except($except) as $key => $data) {
                $pasien->$key = $data;
            }
            $pasien->save();

            return back()->with('success', 'Data pasien berhasil diupdate');
        } else if ($target == 'datapoli') {
            $poli = Poli::where('id', $request->id)->first();
            if ($request->password == '') $except = ['_token', 'id', 'password'];
            else {
                $except = ['_token', 'id'];
                $request['password'] = bcrypt($request->password);
            }
            foreach ($request->except($except) as $key => $data) {
                $poli->$key = $data;
            }
            $poli->save();

            return back()->with('success', 'Data poli berhasil diupdate');
        } else if ($target == 'setjadwal') {
            $poli = Poli::where('id', $request->id)->first();
            $poli->dokter_id = $request->dokter_id;
            $poli->save();

            $jadwal = Jadwal::where('poli_id', $request->id)->get();
            foreach ($jadwal as $jdw) {
                $jdw->delete();
            }

            foreach ($request->hari_awal as $i => $dta) {
                $hari_akhir = ($request->hari_akhir[$i] == '') ? '' : ' - '.$request->hari_akhir[$i];
                $hari = $request->hari_awal[$i].$hari_akhir;
                $jam = $request->jam_awal[$i].' - '.$request->jam_akhir[$i];
                Jadwal::create([
                    'poli_id' => $request->id,
                    'hari' => $hari,
                    'jam' => $jam,
                ]);
            }

            return back()->with('success', 'Jadwal poli berhasil diupdate');
        } else if ($target == 'akun') {
            $akun = Admin::where('id', $request->id)->first();
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
        if ($target == 'datadokter') {
            $dokter = Doctor::where('id', $id)->first();
            $dokter->delete();

            return back()->with('success', 'Data dokter berhasil dihapus');
        } else if ($target == 'datapoli') {
            $dokter = Poli::where('id', $id)->first();
            $dokter->delete();

            return back()->with('success', 'Data poli berhasil dihapus');
        }
    }
}
