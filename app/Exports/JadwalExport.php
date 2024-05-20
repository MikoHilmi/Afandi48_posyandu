<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kegiatan::select(
            'judul_kegiatan',
            'waktu',
            'tempat',
            'deskripsi',
            // 'image',
        )->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Judul Kegiatan',
            'Waktu',
            'Tempat',
            'Deskripsi',
            // 'Image', // Uncomment this line if you include the image column later
        ];
    }
}
