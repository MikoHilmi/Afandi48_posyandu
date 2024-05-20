<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    use HasFactory;

    protected $fillable = ['nama_vaksin', 'deskripsi'];

    public function masuk()
    {
        return $this->hasMany(VaksinMasuk::class, 'id_vaksin');
    }

    public function keluar()
    {
        return $this->hasMany(VaksinKeluar::class, 'id_vaksin');
    }
}
