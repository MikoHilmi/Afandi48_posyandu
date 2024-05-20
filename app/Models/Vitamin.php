<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    use HasFactory;

    protected $fillable = ['nama_vitamin', 'deskripsi'];

    public function masuk()
    {
        return $this->hasMany(VitaminMasuk::class, 'id_vitamin');
    }

    public function keluar()
    {
        return $this->hasMany(VitaminKeluar::class, 'id_vitamin');
    }
}