<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'nama_ibu',
        'nomor_urut',
        'status',
    ];

    use HasFactory;
}
