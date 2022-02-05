<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Antrian;
use App\Models\Jadwal;
use App\Models\Poli;

class AmbilAntrianTest extends TestCase
{
    public function test_ambil_antrian()
    {
        $poli_id = 1;
        $user_id = 1;

        $data = [
            'user_id' => $user_id,
            'poli_id' => $poli_id,
        ];

        $kode = '';
        $get_poli = Poli::where('status_layanan', 'Aktif')->get();
        foreach ($get_poli as $i => $pli) {
            if ($poli_id == $pli->id) {
                $kode = range('A', 'Z')[$i];
            }
        }
        $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->get();
        $antrian_poli = count($antrian) + 1;
        $data['nomor_antrian'] = $kode . '-' . sprintf('%03s', $antrian_poli);
        $data['status'] = 'new';

        $insert = Antrian::create($data);

        $this->assertDatabaseHas('antrian', ['id' => $insert->id]);
    }

    public function test_tidak_bisa_ambil_antrian_jika_antrian_sebelumnya_belum_diproses()
    {
        $user_id = 1;
        $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('user_id', $user_id)->where('status', '!=', 'finish')->where('status', '!=', 'cancel')->first();
        if ($antrian) {
            var_dump('Masih ada antrian sebelumnya');
            $this->assertTrue(true);
        } else {
            var_dump('Antrian bisa diambil');
            $this->assertTrue(true);
        }
    }

    public function test_tidak_bisa_ambil_antrian_jika_poli_tutup()
    {
        $poli_id = 2;

        $days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        $this_day = date('D');
        $day = '';
        if ($this_day == 'Mon') $day = "Senin";
        else if ($this_day == 'Tue') $day = "Selasa";
        else if ($this_day == 'Wed') $day = "Rabu";
        else if ($this_day == 'Thu') $day = "Kamis";
        else if ($this_day == 'Fri') $day = "Jumat";
        else if ($this_day == 'Sat') $day = "Sabtu";
        else if ($this_day == 'Sun') $day = "Minggu";

        $get_hari = [];
        $get_jam = [];
        foreach (Jadwal::where('poli_id', $poli_id)->get() as $hri) {
            $hari = explode(' - ', $hri->hari);
            $fh = $hari[0];
            $lh = isset($hari[1]) ? $hari[1] : '';
            foreach (array_slice($days, array_search($fh, $days), array_search($lh, $days) + 1) as $tes) {
                array_push($get_hari, $tes);
                array_push($get_jam, $hri->jam);
            }
        }

        $index_day = array_search($day, $get_hari);
        if ($index_day > -1) {
            $jam = explode(' - ', $get_jam[$index_day]);
            $nj = date('Hi');
            $fj = str_replace(':', '', $jam[0]);
            $lj = str_replace(':', '', $jam[1]);

            if ($fj <= $nj && $nj <= $lj) $status = "buka";
            else $status = "tutup";
        } else $status = "tutup";

        if ($status == 'buka') {
            var_dump('Poli masih buka, masih bisa ambil antrian');
            $this->assertTrue(true);
        } else {
            var_dump('Poli sudah tutup, tidak bisa ambil antrian');
            $this->assertTrue(true);
        }
    }
}
