<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'dokter';
    protected $guard = 'doctor';
    protected $guarded = [];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
