<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'antrian';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
