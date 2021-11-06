<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Poli;
use App\Models\Jadwal;
use App\Models\Admin;
use App\Models\Antrian;

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

    public function update(Request $request, $target)
    {
        if ($target == 'datadiri') {
            $user = Doctor::where('id', $request->id)->first();

            $cek_nip = Doctor::where('nip', $request->nip)->where('id', '!=', $request->id)->first();
            if ($cek_nip) {
                return redirect()->back()->withInput($request->all())->withErrors(['error' => ['NIP sudah terdaftar']]);
            }

            foreach ($request->except(['_token', 'id']) as $key => $data) {
                $user->$key = $data;
            }
            $user->save();

            return back()->with('success', 'Data diri anda berhasil diupdate');
        } else if ($target == 'akun') {
            $akun = Doctor::where('id', $request->id)->first();
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

    public function config(Request $request)
    {
        if ($request->req == 'getAntrian') {
            $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->orderBy('nomor_antrian', 'asc')->where('poli_id', $request->poli_id)->get();
            $result = '';
            foreach ($antrian as $i => $dta) {
                $result .= '
                <tr>
                <td>'.($i+1).'</td>
                <td>'.date('d-m-Y H:i',  strtotime($dta->created_at)).'</td>
                <td>'.$dta->nomor_antrian.'</td>
                <td>'.$dta->user->no_rekam_medik.'</td>
                <td>'.$dta->user->nama.'</td>
                <td>
                <span class="badge badge-success">'.$dta->status.'</span>
                </td>
                <td class="text-center">
                <button class="btn btn-sm btn-success"><i class="fa fa-volume-up"></i> Panggil</button>
                <button class="btn btn-sm btn-danger"><i class="fa fa-arrow-circle-right"></i> Lewati</button>
                <button class="m-t-10 btn btn-sm btn-primary"><i class="fa fa-stethoscope"></i> Lanjutkan Pemeriksaan</button>
                </td>
                </tr>';
            }
            
            return response()->json($result, 200);
        }
    }
}
