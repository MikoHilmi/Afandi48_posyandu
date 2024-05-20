<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VitaminKeluar extends Model
{
    use HasFactory;

    protected $fillable = ['id_vitamin', 'jumlah_keluar', 'tanggal_keluar'];

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class, 'id_vitamin');
    }

    public function getFormattedTanggalKeluarAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_keluar'])->format('d-m-Y');
    }
}
