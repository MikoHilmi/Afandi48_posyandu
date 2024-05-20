<?php

namespace App\Http\Controllers\admin;

use App\Exports\LaporanExport;
use App\Exports\WordExport;
use App\Http\Controllers\Controller;
use App\Http\Repository\ExportRepository;
use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\Word2007;

class LaporanController extends Controller
{
    public function index()
    {
        // // Rentang usia balita
        // $usiaMax = 60; // 5 tahun = 60 bulan
        // $rentangUsia = 12;
        // $data = [];

        // // Loop untuk setiap kelompok usia
        // for ($usiaMin = 0; $usiaMin <= $usiaMax - $rentangUsia; $usiaMin += $rentangUsia) {
        //     $usiaMaxKelompok = $usiaMin + $rentangUsia - 1;

        //     // Mengambil data balita berdasarkan rentang usia
        //     $rekapitulasi = Balita::select(
        //         'balitas.id',
        //         'balitas.nama_balita',
        //         'balitas.tanggal_lahir_balita',
        //         'orang_tuas.nama_ayah',
        //         'orang_tuas.nama_ibu',
        //         'orang_tuas.tanggal_lahir_ayah',
        //         'orang_tuas.tanggal_lahir_ibu',
        //         DB::raw('GROUP_CONCAT(imunisasis.tanggal_imunisasi) AS tanggal_imunisasi'),
        //         DB::raw('GROUP_CONCAT(imunisasis.berat_badan) AS berat_badan'),
        //         DB::raw('GROUP_CONCAT(imunisasis.tinggi_badan) AS tinggi_badan'),
        //         DB::raw('(SELECT catatan FROM imunisasis WHERE imunisasis.id_balita = balitas.id ORDER BY tanggal_imunisasi DESC LIMIT 1) AS catatan_terakhir')
        //     )
        //         ->join('orang_tuas', 'balitas.id_ortu', '=', 'orang_tuas.id')
        //         ->leftJoin('imunisasis', 'balitas.id', '=', 'imunisasis.id_balita')
        //         ->whereRaw("TIMESTAMPDIFF(MONTH, balitas.tanggal_lahir_balita, CURDATE()) BETWEEN ? AND ?", [$usiaMin, $usiaMaxKelompok])
        //         ->groupBy('balitas.id')
        //         ->get();

        //     $data[] = [
        //         'usiaMin' => $usiaMin,
        //         'usiaMax' => $usiaMaxKelompok,
        //         'rekapitulasi' => $rekapitulasi
        //     ];
        // }

        $data['rekapitulasi'] = Balita::select(
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
            ->groupBy('balitas.id')
            ->get();

        return view('admin.laporan.index', compact('data'));
    }

    public function download()
    {
        return $this->download_excel();
    }

    public function download_excel()
    {
        return Excel::download(new LaporanExport(), 'Rekapitulasi.xlsx');
    }

    public function word()
    {
        return $this->coba();
    }

    public function laporan()
    {
        $export = (new ExportRepository())->data();
        $data = $export;

        $templatePath = public_path('docx/template.docx');

        // Create a new PHPWord object
        $phpWord = new PhpWord();

        // Load the template processor
        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $item) {
            $row = [
                'key' => $item->key,
                'nama_balita' => $item->nama_balita,
                'tanggal_lahir_balita' => $item->tanggal_lahir_balita,
                'usia' => $item->getUsia(),
                'nama_ayah' => $item->nama_ayah,
                'nama_ibu' => $item->nama_ibu,
                'berat_badan' => [],
                'tinggi_badan' => [],
                'catatan_terakhir' => $item->catatan_terakhir
            ];

            $tanggal_imunisasi = explode(',', $item->tanggal_imunisasi);
            $tinggi_badan = explode(',', $item->tinggi_badan);
            $berat_badan = explode(',', $item->berat_badan);

            for ($i = 1; $i <= 12; $i++) {
                $valueForMonthBerat = '';
                $valueForMonthTinggi = '';

                foreach ($tanggal_imunisasi as $key => $tanggal) {
                    if (date('n', strtotime($tanggal)) == $i) {
                        $valueForMonthBerat .= $berat_badan[$key] . ', ';
                        $valueForMonthTinggi .= $tinggi_badan[$key] . ', ';
                        $found = true;
                    }
                }

                $valueForMonthBerat = rtrim($valueForMonthBerat, ', ');
                $valueForMonthTinggi = rtrim($valueForMonthTinggi, ', ');

                $row['berat_badan'][$i] = $valueForMonthBerat;
                $row['tinggi_badan'][$i] = $valueForMonthTinggi;
            }

            // Ganti placeholder dengan nilai yang sesuai dari array
            $templateProcessor->setValue('key', $row['key']); // Tidak perlu ++ di sini
            $templateProcessor->setValue('nama_balita', $row['nama_balita']);
            $templateProcessor->setValue('tanggal_lahir_balita', $row['tanggal_lahir_balita']);
            $templateProcessor->setValue('getUsia', $row['usia']);
            $templateProcessor->setValue('nama_ayah', $row['nama_ayah']);
            $templateProcessor->setValue('nama_ibu', $row['nama_ibu']);
            $templateProcessor->setValue('catatan_terakhir', $row['catatan_terakhir']);
            // Lanjutkan dengan mengganti placeholder lainnya...
        }

        $filename = 'output_document.docx';
        $templateProcessor->saveAs($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function coba()
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection(['orientation' => 'landscape']);

        $section->addText("REKAPITULASI PERTUMBUHAN BALITA", array('bold' => true, "size" => 14), array('align' => 'center'));

        $section->addTextBreak(1);

        $table = $section->addTable(['borderSize' => '3']);
        $headerFontSize = 6;

        $table->addRow();
        $table->addCell(5000)->addText('NO', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('NAMA ANAK', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('TGL LAHIR', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('USIA (bln)', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('NAMA AYAH', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('NAMA IBU', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('JANUARI', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('FEBRUARI', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('MARET', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('APRIL', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('MEI', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('JUNI', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('JULI', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('AGUSTUS', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(25000)->addText('SEPTEMBER', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('OKTOBER', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('NOVEMBER', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(20000)->addText('DESEMBER', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));
        $table->addCell(25000)->addText('KETERANGAN', array('bold' => true, "size" => $headerFontSize), array('align' => 'center'));

        $export = (new ExportRepository())->data();
        $data = $export;
        $no = 1;
        foreach ($data as $key => $value) {
            $table->addRow();
            $table->addCell(50000)->addText($no, ['size' => $headerFontSize, 'alignment' => 'center']);
            $table->addCell(50000)->addText($value->nama_balita, ['size' => $headerFontSize, 'alignment' => 'center']);
            $table->addCell(50000)->addText($value->tanggal_lahir_balita, ['size' => $headerFontSize, 'alignment' => 'center']);
            $table->addCell(50000)->addText($value->getUsia(), ['size' => $headerFontSize, 'alignment' => 'center']);
            $table->addCell(50000)->addText($value->nama_ayah, ['size' => $headerFontSize, 'alignment' => 'center']);
            $table->addCell(50000)->addText($value->nama_ibu, ['size' => $headerFontSize, 'alignment' => 'center']);

            // Separate dates, weights, and heights
            $tanggal_imunisasi = explode(',', $value->tanggal_imunisasi);
            $berat_badan = explode(',', $value->berat_badan);
            $tinggi_badan = explode(',', $value->tinggi_badan);

            // Initialize array for both weights and heights
            $monthly_data = array_fill(0, 12, '');

            // Fill in the array with respective weights and heights
            foreach ($tanggal_imunisasi as $key => $tanggal) {
                $month_index = date('n', strtotime($tanggal)) - 1;
                $monthly_data[$month_index] .= "{$berat_badan[$key]} (Kg) - {$tinggi_badan[$key]} (Cm) \n";
            }

            // Add weights and heights to the table
            for ($i = 0; $i < 12; $i++) {
                $table->addCell(50000)->addText($monthly_data[$i], ['size' => $headerFontSize, 'alignment' => 'center']);
            }

            $table->addCell(50000)->addText($value->catatan_terakhir, ['size' => $headerFontSize, 'alignment' => 'center']);
            $no++;
        }

        $section->addTextBreak(2);
        $section->addText("Sidoarjo,... ...... 20...", array("size" => $headerFontSize), array('align' => 'right'));
        $section->addTextBreak(1);
        $section->addText("(                            )", array("size" => $headerFontSize), array('align' => 'right'));


        $writer = new Word2007($phpWord);
        $fileName = 'Rekapitulasi.docx';
        header('Content-Type: application/msword');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
