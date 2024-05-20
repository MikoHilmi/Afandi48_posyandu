<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Charts\KurvaPertumbuhanChart;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\Imunisasi;
use App\Models\Kegiatan;

class FrontController extends Controller
{
    protected $chartWeight, $chartHeight;

    public function __construct(KurvaPertumbuhanChart $chartWeight, KurvaPertumbuhanChart $chartHeight)
    {
        $this->chartWeight = $chartWeight;
        $this->chartHeight = $chartHeight;
    }

    public function index()
    {
        $kegiatans = Kegiatan::orderBy('created_at', 'asc')->get();

        return view('frontend.welcome', compact('kegiatans'));
    }

    public function showBalita(Request $request)
    {
        $balita = Balita::latest();

        if (!empty($request->get('keyword'))) {
            $balita = $balita->where('nama_balita', 'like', '%' . $request->get('keyword') . '%');
        }
        $balita = $balita->paginate(10);

        return view('frontend.menu.balita', compact('balita'));
    }

    public function showImunisasi($id)
    {
        $balita = Balita::find($id);
        $imunisasi = Imunisasi::where('id_balita', $id)
            ->orderBy('tanggal_imunisasi', 'desc')
            ->get();

        $chartWeight = $this->chartWeight->buildBeratBadanChart($id);
        $chartHeight = $this->chartHeight->buildTinggiBadanChart($id);

        return view('frontend.menu.imunisasi', [
            'imunisasi' => $imunisasi,
            'balita' => $balita,
            'chartBeratBadan' => $chartWeight,
            'chartTinggiBadan' => $chartHeight,
        ]);
    }

    public function countAntrian(Request $request)
    {
        $request->validate([
            'nama_ibu' => 'required'
        ]);

        $lastAntrian = Antrian::orderBy('id', 'desc')->first();

        $nomorUrut = $lastAntrian ? $lastAntrian->nomor_urut + 1 : 1;

        $antrian = Antrian::create([
            'nomor_urut' => $nomorUrut,
            'status' => 0,
            'nama_ibu' => $request->nama_ibu,
        ]);

        $request->session()->flash('success', 'Antrian anda' . $antrian);

        return response()->json(['antrian' => $antrian]);
    }
}
