<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tampilkan_form_login()
    {
        $response = $this->get('/user/login');
        $response->assertSee('Login User - UPT Puskesmas Bontonompo II');
        $response->assertViewIs('user.login');

        $response->assertStatus(200);
    }

    public function test_tidak_bisa_akses_dashboard_jika_belum_login()
    {
        $response = $this->get('/user/home');
        $response->assertRedirect('user/login');

        $this->assertGuest();
    }

    public function test_tidak_bisa_akses_form_login_jika_sudah_login()
    {
        $cridential = [
            'username' => $username = 'P000011',
            'password' => 'admin',
        ];

        $response = $this->post('/user/login', $cridential);
        $response->assertRedirect('/user');
        $user = User::where('no_rekam_medik', $username)->first();
        $this->assertAuthenticatedAs($user);

        $cek = $this->get('/user/login');
        $cek->assertRedirect('/user');
    }

    public function test_tidak_bisa_login_jika_kridensial_salah()
    {
        $cridential = [
            'username' => 'P000011',
            'password' => 'invalid-password',
        ];

        $response = $this->from('user/login')->post('user/login', $cridential);
        $response->assertRedirect('user/login');
        $response->assertSessionHasErrors('error');

        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertGuest();
    }

    public function test_login_jika_kridensial_benar()
    {
        $cridential = [
            'username' => $username = 'P000011',
            'password' => 'admin',
        ];

        $response = $this->post('/user/login', $cridential);
        $response->assertRedirect('/user');
        $user = User::where('no_rekam_medik', $username)->first();
        $this->assertAuthenticatedAs($user);
    }
}
