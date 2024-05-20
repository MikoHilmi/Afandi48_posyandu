<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VaksinMasuk extends Model
{
    use HasFactory;

    protected $fillable = ['id_vaksin', 'jumlah_masuk', 'tanggal_masuk'];

    public function vaksin()
    {
        return $this->belongsTo(Vaksin::class, 'id_vaksin');
    }

    public function getFormattedTanggalMasukAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_masuk'])->format('d-m-Y');
    }
}
