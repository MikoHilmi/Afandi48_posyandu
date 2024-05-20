<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Balita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ortu',
        'nama_balita',
        'tempat_lahir',
        'tanggal_lahir_balita',
        'jenis_kelamin_balita',
    ];

    public function getUsiaAttribute()
    {
        // Hitung perbedaan tanggal lahir dengan tanggal saat ini
        $tanggalLahir = Carbon::parse($this->attributes['tanggal_lahir_balita']);
        $usia = $tanggalLahir->diff(Carbon::now());

        // Format usia dalam tahun, bulan, dan hari
        $tahun = $usia->y;
        $bulan = $usia->m;
        $hari = $usia->d;

        return "$tahun thn, $bulan bln, $hari hr";
    }

    public function getUsia()
    {
        // Hitung perbedaan tanggal lahir dengan tanggal saat ini
        $tanggalLahir = Carbon::parse($this->attributes['tanggal_lahir_balita']);
        $umur = $tanggalLahir->diffInMonths(Carbon::now());

        return "$umur";
    }

    public function getFormattedTanggalLahirAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_lahir_balita'])->format('d-m-Y');
    }

    public function countImunisasi($id)
    {
        return Imunisasi::where('id_balita', $id)->count();
    }

    public static function jenisKelamin($jenisKelamin)
    {
        return static::where('jenis_kelamin_balita', $jenisKelamin)->count();
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class);
    }
}
