<?php

namespace App\Exports;

use App\Models\Balita;
use Maatwebsite\Excel\Concerns\FromCollection;

class BalitaExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Balita::select(
            'nama_balita',
            'tanggal_lahir_balita',
            'jenis_kelamin_balita',
        )->get();
    }
}
