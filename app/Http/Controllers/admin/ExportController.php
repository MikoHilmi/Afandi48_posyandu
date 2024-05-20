<?php

namespace App\Http\Controllers\admin;

use App\Exports\JadwalExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imunisasi;
use App\Models\Balita;
use App\Exports\VaksinExport;
use App\Exports\BalitaExport;
use App\Exports\ImunisasiExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export_balita()
    {
        return Excel::download(new BalitaExport, 'balita.xlsx');
    }

    public function export_imunisasi(Request $request)
    {
        $balitaId = $request->route('id_balita');

        $nama_balita = Balita::where('id', $balitaId)->value('nama_balita');

        $data = Imunisasi::select([
            'id_balita',
            'tanggal_imunisasi',
            'berat_badan',
            'tinggi_badan',
            'catatan',
        ])
            ->where('id_balita', $balitaId)
            ->get();

        $data->each(function ($imunisasi) use ($nama_balita) {
            $imunisasi->id_balita = $nama_balita;
        });

        return Excel::download(new ImunisasiExport($data), 'imunisasi_balita.xlsx');
    }

    public function export_vaksin()
    {
        return Excel::download(new VaksinExport, 'vaksin.xlsx');
    }

    public function export_jadwal()
    {
        return Excel::download(new JadwalExport, 'jadwal.xlsx');
    }
}
