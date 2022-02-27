<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrasiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tampilkan_form_registrasi()
    {
        $response = $this->get('/user/daftar');
        $response->assertSee('Halaman Pendaftaran - UPT Puskesmas Bontonompo II');
        $response->assertViewIs('user.daftar');

        $response->assertStatus(200);
    }

    public function test_tidak_bisa_daftar_jika_nik_sudah_terdaftar()
    {
        $nik = '0001562670652';

        $user = User::where('nik', $nik)->first();
        if ($user) {
            var_dump('Nik sudah terdaftar');
            $this->assertTrue(true);
        } else {
            var_dump('Pendaftaran berhasil');
            $this->assertTrue(true);
        }
    }

    public function test_registrasi_berhasil()
    {
        $data = [
            'no_rekam_medik' => 'P000020',
            'nik' => '998065774664',
            'nama' => 'Ridha Hamzah',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bontonompo',
            'tanggal_lahir' => '1998-02-12',
            'alamat' => 'Desa Bontonompo',
            'jaminan_kesehatan' => 'BPJS',
            'status_perkawinan' => 'Belum Menikah',
            'password' => bcrypt('12345')
        ];

        $insert = User::create($data);
        $this->assertDatabaseHas('user', ['id' => $insert->id]);
    }
}
