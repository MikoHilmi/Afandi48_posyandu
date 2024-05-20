<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Imunisasi extends Model
{
    protected $fillable = [
        'id_balita',
        'tanggal_imunisasi',
        'berat_badan',
        'tinggi_badan',
        'catatan',
    ];

    public function getFormattedTanggalImunisasiAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_imunisasi'])->format('d-m-Y');
    }

    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }
}
