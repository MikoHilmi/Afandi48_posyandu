<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VaksinKeluar extends Model
{
    use HasFactory;

    protected $fillable = ['id_vaksin', 'jumlah_keluar', 'tanggal_keluar'];

    public function vaksin()
    {
        return $this->belongsTo(Vaksin::class, 'id_vaksin');
    }

    public function getFormattedTanggalKeluarAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_keluar'])->format('d-m-Y');
    }
}
