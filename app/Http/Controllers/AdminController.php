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
        } else if ($target == 'pasien') {
            $this->validate($request, [
                'nik' => 'unique:user',
            ]);

            $user = User::orderBy('id', 'desc')->first();
            $rekam_medik = $user ? $user->id+1 : 1;

            $data = $request->all();
            $data['no_rekam_medik'] = 'P'.sprintf('%06s', $rekam_medik);
            $data['password'] = bcrypt($request->password);

            $user = User::create($data);

            return redirect('admin/ambil-antrian')->with('success', 'Pasien baru berhasil di daftar, silahkan ambil antrian')->with('user_id', $user->id);

        } else if ($target == 'antrian') {
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

            return redirect('admin/antrian')->with('success', 'Nomor Antrian baru telah ditambahkan');
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

    public function config(Request $request)
    {
        if ($request->req == 'getAntrian') {
            if ($request->poli_id == 'all') 
                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->orderBy('nomor_antrian', 'asc')->get();
            else
                $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->orderBy('nomor_antrian', 'asc')->where('poli_id', $request->poli_id)->get();
            $result = '';
            foreach ($antrian as $i => $dta) {
                if ($dta->status == 'new') $color = 'default';
                elseif ($dta->status == 'calling') $color = 'info';
                elseif ($dta->status == 'skip') $color = 'warning';
                elseif ($dta->status == 'proccess') $color = 'primary';
                elseif ($dta->status == 'finish') $color = 'success';
                elseif ($dta->status == 'cancel') $color = 'danger';
                
                $result .= '
                <tr>
                <td>'.($i+1).'</td>
                <td>'.date('d/m/Y H:i',  strtotime($dta->created_at)).'</td>
                <td>'.$dta->nomor_antrian.'</td>
                <td>'.$dta->user->no_rekam_medik.'</td>
                <td>'.$dta->user->nama.'</td>
                <td>'.$dta->poli->nama_poli.'</td>
                <td>
                <span class="badge badge-'.$color.'">'.$dta->status.'</span>
                </td>
                </tr>';
            }
            
            return response()->json($result, 200);
        } else if ($request->req == 'getAntrianLast') {
            $poli = Poli::where('status_layanan', 'Aktif')->get();

            $result = '';
            $poli_id = $request->poli_id;
            $get_poli = Poli::where('status_layanan', 'Aktif')->get();
            $kode = '';
            foreach ($get_poli as $i => $pli) {
                if ($poli_id == $pli->id) {
                    $kode = range('A', 'Z')[$i];
                }
            }

            $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->get();
            $antrian_poli = count($antrian)+1;

            $antrian_tersedia = $kode.'-'.sprintf('%03s', $antrian_poli);
            $result = $antrian_tersedia;

            return response()->json($result, 200);
        } else if ($request->req == 'cekAntrian') {
            $result = false;
            $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('user_id', $request->user_id)->where('status', '!=', 'finish')->where('status', '!=', 'cancel')->first();
            if ($antrian) $result = true;

            return response()->json($result, 200);
        }
    }
}
