<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Poli;
use App\Models\Jadwal;
use App\Models\Admin;
use App\Models\Antrian;

use App\Events\AmbilAntrian;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
        $this->cancelAntrian();
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
        if ($target == 'ambilantrian') {
            $data = $request->all();

            $poli_id = $request->poli_id;
            $kode = '';
            $get_poli = Poli::where('status_layanan', 'Aktif')->get();
            foreach ($get_poli as $i => $pli) {
                if ($poli_id == $pli->id) {
                    $kode = range('A', 'Z')[$i];
                }
            }
            $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->get();
            $antrian_poli = count($antrian)+1;
            $data['nomor_antrian'] = $kode.'-'.sprintf('%03s', $antrian_poli);
            $data['status'] = 'new';

            Antrian::create($data);
            event(new AmbilAntrian('rahmat_ryu'));

            return back()->with('success', 'Anda telah mengambil nomor antrian');
        }
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

            return back()->with('success', 'Data diri anda berhasil diupdate');
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

    public function config(Request $request)
    {
        if ($request->req == 'getAntrian') {
            $poli = Poli::where('status_layanan', 'Aktif')->get();

            $result = [];
            foreach ($poli as $i => $pli) {
                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $pli->id)->get();
                $antrian_poli = count($antrian)+1;

                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $pli->id)->where('status', 'proccess')->first();
                $antrian_dilayani = ($antrian) ? $antrian->nomor_antrian : '--';

                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $pli->id)->where('status', '!=', 'finish')->where('status', '!=', 'proccess')->get();
                $sisa_antrian = count($antrian).' Antrian';

                $antrian_tersedia = range('A', 'Z')[$i].'-'.sprintf('%03s', $antrian_poli);
                $result[] = [
                    "poli_id" => $pli->id,
                    "antrian_tersedia" => $antrian_tersedia,
                    "antrian_dilayani" => $antrian_dilayani,
                    "sisa_antrian" => $sisa_antrian,
                ];
            }

            if (isset($request->poli_id)) {
                $poli_id = $request->poli_id;
                $get_poli = Poli::where('status_layanan', 'Aktif')->get();
                $poli = [];
                foreach ($get_poli as $i => $pli) {
                    if ($poli_id == $pli->id) {
                        $poli = $pli;
                        $poli['kode'] = range('A', 'Z')[$i];
                    }
                }

                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->get();
                $antrian_poli = count($antrian)+1;

                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->where('status', 'proccess')->first();
                $antrian_dilayani = ($antrian) ? $antrian->nomor_antrian : '--';

                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->where('status', '!=', 'finish')->where('status', '!=', 'proccess')->get();
                $sisa_antrian = count($antrian).' Antrian';

                $antrian_tersedia = $poli->kode.'-'.sprintf('%03s', $antrian_poli);
                $result = [
                    "chg_nama_poli" => $poli->nama_poli,
                    "chg_antrian_tersedia" => $antrian_tersedia,
                    "chg_antrian_dilayani" => $antrian_dilayani,
                    "chg_sisa_antrian" => $sisa_antrian,
                ];
            }
            
            return response()->json($result, 200);
        }
    }
}
