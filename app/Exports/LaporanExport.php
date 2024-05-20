<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use App\Http\Repository\ExportRepository;

class LaporanExport implements FromView, WithStyles
{
    use Exportable;

    public function view(): View
    {
        $report = new ExportRepository();
        $data = $report->data();
        return view('admin.laporan.laporan', [
            'data' => $data,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Set border style
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        // Apply style to range of cells A4:S13
        $sheet->getStyle('A4:S13')->applyFromArray($styleArray);

        // Auto size columns based on content
        foreach (range('B', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
