<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_kegiatan',
        'tempat',
        'waktu',
        'image',
        'deskripsi',
    ];

    public function getFormattedWaktuAttribute()
    {
        return Carbon::parse($this->attributes['waktu'])->format('d-m-Y');
    }
}
