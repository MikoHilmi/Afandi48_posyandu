<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Vaksin;

class VaksinExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vaksin::select(
            'nama_vaksin',
            'stok',
            'deskripsi'
        )->get();
    }
}
