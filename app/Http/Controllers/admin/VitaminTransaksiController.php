<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Vaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vitamin;
use App\Models\VitaminMasuk;
use App\Models\VitaminKeluar;

class VitaminTransaksiController extends Controller
{
    public function index()
    {
        $vitamins = Vitamin::all();

        $vitaminMasuk = VitaminMasuk::latest()->get();

        $vitaminKeluar = VitaminKeluar::latest()->get();

        return view('admin.vitamin-transaksi.list', compact('vitamins', 'vitaminMasuk', 'vitaminKeluar'));
    }

    public function createMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
        ]);

        if ($validator->passes()) {

            $vitaminMasuk = new VitaminMasuk();
            $vitaminMasuk->tanggal_masuk = $request->tanggal_masuk;
            $vitaminMasuk->jumlah_masuk = $request->jumlah_masuk;
            $vitaminMasuk->id_vitamin = $request->vitamin;
            $vitaminMasuk->save();

            $request->session()->flash('success', 'Stok berhasil ditambahkan');
            return redirect()->back()->with('success', 'Stok berhasil ditambahkan');
            // return response([
            //     'status' => true,
            //     'message' => 'Stok berhasil ditambahkan'
            // ]);
        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function createKeluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_keluar' => 'required',
            'jumlah_keluar' => 'required',
        ]);

        if ($validator->passes()) {

            $vitamin = Vitamin::find($request->vitamin_id);

            if (!$vitamin) {
                return response([
                    'status' => false,
                    'message' => 'vitamin tidak ditemukan'
                ]);
            }

            $totalMasuk = $vitamin->masuk->sum('jumlah_masuk');
            $totalKeluar = $vitamin->keluar->sum('jumlah_keluar');

            $stok = $totalMasuk - $totalKeluar;

            if ($stok >= $request->jumlah_keluar) {
                $vitaminKeluar = new VitaminKeluar();
                $vitaminKeluar->tanggal_keluar = $request->tanggal_keluar;
                $vitaminKeluar->jumlah_keluar = $request->jumlah_keluar;
                $vitaminKeluar->id_vitamin = $request->vitamin_id;
                $vitaminKeluar->save();

                $request->session()->flash('success', 'Stok berhasil dikurangi');

                return response([
                    'status' => true,
                    'message' => 'Stok berhasil dkurangi'
                ]);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Stok tidak mencukupi'
                ]);
            }
        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function checkStock(Request $request)
    {
        $vitamin = Vitamin::find($request->id);

        if (!$vitamin) {
            return response()->json(['exists' => false, 'message' => 'Vitamin tidak ditemukan']);
        }

        $totalMasuk = $vitamin->masuk->sum('jumlah_masuk');
        $totalKeluar = $vitamin->keluar->sum('jumlah_keluar');

        $stok = $totalMasuk - $totalKeluar;

        if ($stok >= $request->jumlah_keluar) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false, 'message' => 'Stok tidak mencukupi']);
        }
    }

    public function destroyMasuk($id, Request $request)
    {
        $vitaminMasuk = VitaminMasuk::find($id);
        if (empty($vitaminMasuk)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => false, // Ubah status menjadi false
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $vitaminMasuk->delete();

        $request->session()->flash('success', 'Data Stok Masuk berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Stok Masuk berhasil dihapus'
        ]);
    }

    public function destroyKeluar($id, Request $request)
    {
        $vitaminKeluar = VitaminKeluar::find($id);
        if (empty($vitaminKeluar)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => false, // Ubah status menjadi false
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $vitaminKeluar->delete();

        $request->session()->flash('success', 'Data Stok Keluar berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Stok keluar berhasil dihapus'
        ]);
    }
}
