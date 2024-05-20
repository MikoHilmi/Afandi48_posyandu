<?php

namespace App\Exports;

use App\Models\Imunisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImunisasiExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Nama Balita',
            'Tanggal Imunisasi',
            'Berat Badan',
            'Tinggi Badan',
            'Catatan',
        ];
    }
}

