<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Poli;
use App\Models\Jadwal;
use App\Models\Admin;
use App\Models\Antrian;
use App\Models\Pemeriksaan;

use App\Events\AmbilAntrian;
use App\Events\PanggilAntrian;

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

    public function store(Request $request, $target)
    {
        if ($target == 'pemeriksaan') {
            $data = $request->all();
            $data['tggl_pemeriksaan'] = date('Y-m-d H:i:s');
            ($data['prb']) ? $data['prb'] : $data['prb'] = '';
            ($data['prolanis']) ? $data['prolanis'] : $data['prolanis'] = '';
            unset($data['antrian_id']);
            Pemeriksaan::create($data);

            $antrian = Antrian::where('id', $request->antrian_id)->first();
            $antrian->status = 'finish';
            $antrian->save();

            event(new AmbilAntrian('rahmat_ryu'));

            return redirect('doctor/antrian-pasien')->with('success', 'Data pemeriksaan berhasil disimpan');
        }
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
            $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $request->poli_id)->where('status', '!=', 'finish')->orderByRaw("FIELD(status, 'new', 'skip') asc")->orderBy('nomor_antrian', 'asc')->get();
            $result = '';
            foreach ($antrian as $i => $dta) {
                if ($dta->status == 'new' || $dta->status == 'skip') $proses = '';
                else $proses = '<button class="m-t-10 btn btn-sm btn-primary proses" data-toggle1="tooltip" title="Lanjutkan Pemeriksaan Pasien" data-id="'.$dta->id.'" data-status="proccess"><i class="fa fa-stethoscope"></i> Lanjutkan Pemeriksaan</button>';

                if ($i == 0) $disabled = '';
                else $disabled = 'disabled';

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
                <td>
                <span class="badge badge-'.$color.'">'.$dta->status.'</span>
                </td>
                <td class="text-center">
                <button class="btn btn-sm btn-success '.$disabled.' proses" data-toggle1="tooltip" title="Panggil Antrian" data-id="'.$dta->id.'" data-status="calling"><i class="fa fa-volume-up"></i> Panggil</button>
                <button class="btn btn-sm btn-danger '.$disabled.' proses" data-toggle1="tooltip" title="Lewati Antrian" data-id="'.$dta->id.'" data-status="skip"><i class="fa fa-arrow-circle-right"></i> Lewati</button>
                '.$proses.'
                </td>
                </tr>';
            }
            
            return response()->json($result, 200);
        } else if ($request->req == 'setSessionPoli') {
            session()->put('poli_id', $request->poli_id);
            return response()->json(true, 200);
        } else if ($request->req == 'updateAntrian') {
            $updt = Antrian::where('id', $request->id)->first();
            $updt->status = $request->status;
            $updt->save();
            event(new AmbilAntrian('rahmat_ryu'));


            if ($request->status == 'calling') {
                $poli = Poli::where('id', $updt->poli_id)->first();
                event(new PanggilAntrian($updt->id));                
            }

            return response()->json(true, 200);
        }
    }
}
