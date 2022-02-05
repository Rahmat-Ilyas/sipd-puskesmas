<?php

namespace Tests\Feature;

use App\Models\Antrian;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProsesAntrianTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_panggil_antrian()
    {
        $poli_id = 1;
        $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->where('status', '!=', 'finish')->orderByRaw("FIELD(status, 'new', 'skip') asc")->orderBy('nomor_antrian', 'asc')->first();
        $antrian_id = $antrian->id;
        $updt = Antrian::where('id', $antrian_id)->first();
        $updt->status = 'calling';
        $updt->save();

        $this->assertDatabaseHas('antrian', ['id' => $antrian_id, 'status' => 'calling']);
    }

    public function test_lewati_antrian()
    {
        $poli_id = 1;
        $antrian = Antrian::whereDate('created_at', date('Y-m-d'))->where('poli_id', $poli_id)->where('status', '!=', 'finish')->orderByRaw("FIELD(status, 'new', 'skip') asc")->orderBy('nomor_antrian', 'asc')->first();
        $antrian_id = $antrian->id;
        $updt = Antrian::where('id', $antrian_id)->first();
        $updt->status = 'skip';
        $updt->save();

        $this->assertDatabaseHas('antrian', ['id' => $antrian_id, 'status' => 'skip']);
    }
}
