<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Vitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VitaminController extends Controller
{
    public function index()
    {
        $vitamins = Vitamin::get();

        foreach ($vitamins as $vitamin) {
            $totalMasuk = $vitamin->masuk->sum('jumlah_masuk');
            $totalKeluar = $vitamin->keluar->sum('jumlah_keluar');
            $stok = $totalMasuk - $totalKeluar;
            $vitamin->stok = $stok;
        }

        return view('admin.vitamin.list', compact('vitamins'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_vitamin' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam validasi data.',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            Vitamin::create($request->all());

            $request->session()->flash('success', 'Data Vitamin berhasil ditambahkan');

            return response()->json(['message' => 'Data Vitamin berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data Vitamin.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $vitamins = Vitamin::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Vitamin',
            'data'    => $vitamins
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_vitamin' => 'required',
            'deskripsi' => 'required',
        ]);

        $vitamin = Vitamin::find($id);
        $vitamin->nama_vitamin = $request->input('nama_vitamin');
        $vitamin->deskripsi = $request->input('deskripsi');
        $vitamin->save();

        $request->session()->flash('success', 'Data Vitamin berhasil diperbarui');
        return response()->json([
            'success' => true,
            'message' => 'Data Vitamin berhasil diperbarui.',
            'data' => $vitamin,
        ]);
    }

    public function destroy($id, Request $request)
    {
        $vitamin = Vitamin::find($id);
        if (empty($vitamin)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $vitamin->delete();

        $request->session()->flash('success', 'Data Vitamin berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Vitamin berhasil dihapus'
        ]);
    }
}
