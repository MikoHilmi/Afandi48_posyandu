<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ayah',
        'nama_ibu',
        'tanggal_lahir_ayah',
        'tanggal_lahir_ibu',
        'nik_ayah',
        'nik_ibu',
        'phone',
        'alamat',
    ];

    public function usiaAyah()
    {
        $tglLahirAyah = Carbon::parse($this->attributes['tanggal_lahir_ayah']);
        $usiaAyah = $tglLahirAyah->diff(Carbon::now());

        $tahun = $usiaAyah->y;
        $bulan = $usiaAyah->m;
        $hari = $usiaAyah->d;

        return "$tahun thn, $bulan bln, $hari hr";
    }

    public function usiaIbu()
    {
        $tglLahirAyah = Carbon::parse($this->attributes['tanggal_lahir_ibu']);
        $usiaAyah = $tglLahirAyah->diff(Carbon::now());

        $tahun = $usiaAyah->y;
        $bulan = $usiaAyah->m;
        $hari = $usiaAyah->d;

        return "$tahun thn, $bulan bln, $hari hr";
    }

    public function balitas()
    {
        return $this->hasMany(Balita::class);
    }
}
