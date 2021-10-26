<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Poli extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'poli';
    protected $guard = 'poli';
    protected $guarded = [];

    public function dokter()
    {
        return $this->belongsTo(Doctor::class);
    }
}
