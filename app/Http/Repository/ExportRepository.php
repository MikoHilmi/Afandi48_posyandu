<?php

namespace App\Http\Repository;

use App\Models\Balita;
use Milon\Barcode\DNS2D;
use App\Models\Barang;
use App\Models\Goods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExportRepository
{
    public function data()
    {
        $data = Balita::select(
            'balitas.id',
            'balitas.nama_balita',
            'balitas.tempat_lahir',
            'balitas.tanggal_lahir_balita',
            'balitas.jenis_kelamin_balita',
            'orang_tuas.nama_ayah',
            'orang_tuas.nama_ibu',
            'orang_tuas.tanggal_lahir_ayah',
            'orang_tuas.tanggal_lahir_ibu',
            DB::raw('GROUP_CONCAT(imunisasis.tanggal_imunisasi) AS tanggal_imunisasi'),
            DB::raw('GROUP_CONCAT(imunisasis.berat_badan) AS berat_badan'),
            DB::raw('GROUP_CONCAT(imunisasis.tinggi_badan) AS tinggi_badan'),
            DB::raw('(SELECT catatan FROM imunisasis WHERE imunisasis.id_balita = balitas.id ORDER BY tanggal_imunisasi DESC LIMIT 1) AS catatan_terakhir')
        )
        ->join('orang_tuas', 'balitas.id_ortu', '=', 'orang_tuas.id')
        ->leftJoin('imunisasis', 'balitas.id', '=', 'imunisasis.id_balita')
        ->groupBy(
            'balitas.id',
            'balitas.nama_balita',
            'balitas.tempat_lahir',
            'balitas.tanggal_lahir_balita',
            'balitas.jenis_kelamin_balita',
            'orang_tuas.nama_ayah',
            'orang_tuas.nama_ibu',
            'orang_tuas.tanggal_lahir_ayah',
            'orang_tuas.tanggal_lahir_ibu'
        )
        ->get();

        return $data;
    }
}
