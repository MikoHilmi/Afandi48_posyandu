<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VitaminMasuk extends Model
{
    use HasFactory;

    protected $fillable = ['id_vitamin', 'jumlah_masuk', 'tanggal_masuk'];

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class, 'id_vitamin');
    }

    public function getFormattedTanggalMasukAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_masuk'])->format('d-m-Y');
    }
}
