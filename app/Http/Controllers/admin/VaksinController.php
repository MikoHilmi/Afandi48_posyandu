<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vaksin;

class VaksinController extends Controller
{
    public function index()
    {
        $vaksins = Vaksin::get();

        foreach ($vaksins as $vaksin) {
            $totalMasuk = $vaksin->masuk->sum('jumlah_masuk');
            $totalKeluar = $vaksin->keluar->sum('jumlah_keluar');

            $stok = $totalMasuk - $totalKeluar;

            $vaksin->stok = $stok;
        }

        return view('admin.vaksin.list', compact('vaksins'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_vaksin' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam validasi data.',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            Vaksin::create($request->all());

            $request->session()->flash('success', 'Data Vaksin berhasil ditambahkan');

            return response()->json(['message' => 'Data Vaksin berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data Vaksin.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $vaksins = Vaksin::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Vaksin',
            'data'    => $vaksins
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_vaksin' => 'required',
            'deskripsi' => 'required',
        ]);

        $vaksin = Vaksin::find($id);
        $vaksin->nama_vaksin = $request->input('nama_vaksin');
        $vaksin->deskripsi = $request->input('deskripsi');
        $vaksin->save();

        $request->session()->flash('success', 'Data Vaksin berhasil diperbarui');
        return response()->json([
            'success' => true,
            'message' => 'Data Vaksin berhasil diperbarui.',
            'data' => $vaksin,
        ]);
    }

    public function destroy($id, Request $request)
    {
        $vaksin = Vaksin::find($id);
        if (empty($vaksin)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $vaksin->delete();

        $request->session()->flash('success', 'Data Vaksin berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Vaksin berhasil dihapus'
        ]);
    }
}
