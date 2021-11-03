<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Antrian;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function cancelAntrian()
    {
        $antrian = Antrian::whereDate('created_at', '!=', date('Y-m-d'))->where('status', '!=', 'finish')->get();
        foreach ($antrian as $dta) {
            $dta->status = 'cancel';
            $dta->save();
        }
    }
}
