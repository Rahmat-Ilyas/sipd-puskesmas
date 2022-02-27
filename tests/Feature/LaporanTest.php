<?php

namespace Tests\Feature;

use App\Models\Pemeriksaan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LaporanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tampilkan_laporan_bulan_ini()
    {
        $laporan = Pemeriksaan::whereMonth('created_at', date('m'))->get();
        $this->assertDatabaseHas('pemeriksaan', ['tggl_pemeriksaan' => '2022-02-03']);
    }
}
