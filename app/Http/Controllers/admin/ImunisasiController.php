<?php

namespace App\Http\Controllers\admin;

use App\Charts\KurvaPertumbuhanChart;
use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\Imunisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImunisasiController extends Controller
{
    protected $chartWeight, $chartHeight;

    public function __construct(KurvaPertumbuhanChart $chartWeight, KurvaPertumbuhanChart $chartHeight)
    {
        $this->chartWeight = $chartWeight;
        $this->chartHeight = $chartHeight;
    }

    public function index($id)
    {
        $balita = Balita::find($id);
        $imunisasi = Imunisasi::where('id_balita', $id)
            ->orderBy('tanggal_imunisasi', 'desc')
            ->get();

        $chartWeight = $this->chartWeight->buildBeratBadanChart($id);
        $chartHeight = $this->chartHeight->buildTinggiBadanChart($id);

        return view('admin.imunisasi.list', [
            'id' => $id,
            'imunisasi' => $imunisasi,
            'balita' => $balita,
            'chartBeratBadan' => $chartWeight,
            'chartTinggiBadan' => $chartHeight,
        ]);
    }

    public function create($id)
    {
        $namaBalita = Balita::find($id)->nama_balita;
        $imunisasi = Imunisasi::where('id_balita', $id)->get();

        return view('admin.imunisasi.create', compact('imunisasi', 'namaBalita', 'id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_balita' => 'required|exists:balitas,id',
            'tanggal_imunisasi' => 'required|date',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'catatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('imunisasi.create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($validator->fails()) {
            return response()->json(['message' => 'Terjadi kesalahan dalam validasi data.', 'errors' => $validator->errors()], 400);
        }

        try {
            Imunisasi::create($request->all());

            $request->session()->flash('success', 'Data pertumbuhan berhasil ditambahkan');

            return response()->json(['message' => 'Data pertumbuhan berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data balita.', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $imunisasi = Imunisasi::find($id);

        $idBalita = $imunisasi->id_balita;

        $balita = Balita::find($idBalita);

        $namaBalita = $balita->nama_balita;

        return view('admin.imunisasi.edit', compact('imunisasi', 'namaBalita', 'id', 'balita'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_imunisasi' => 'required|date',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'catatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $imunisasi = Imunisasi::findOrFail($id);

            // Memperbarui hanya kolom yang diperbolehkan
            $imunisasi->update([
                'tanggal_imunisasi' => $request->tanggal_imunisasi,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'catatan' => $request->catatan,
            ]);

            $request->session()->flash('success', 'Data Imunisasi berhasil diperbarui');

            return response()->json(['message' => 'Data Imunisasi berhasil diperbarui']);
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Terjadi kesalahan saat memperbarui data Imunisasi. ' . $e->getMessage());

            return redirect()->back();
        }
    }
}
