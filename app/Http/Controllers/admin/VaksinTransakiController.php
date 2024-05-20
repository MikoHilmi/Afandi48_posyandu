<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vaksin;
use App\Models\VaksinMasuk;
use App\Models\VaksinKeluar;

class VaksinTransakiController extends Controller
{
    public function index()
    {
        $vaksins = Vaksin::all();

        $vaksinMasuk = VaksinMasuk::latest()->get();

        $vaksinKeluar = VaksinKeluar::latest()->get();

        return view('admin.vaksin-transaksi.list', compact('vaksins', 'vaksinMasuk', 'vaksinKeluar'));
    }

    public function createMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
        ]);

        if ($validator->passes()) {

            $vaksinMasuk = new VaksinMasuk();
            $vaksinMasuk->tanggal_masuk = $request->tanggal_masuk;
            $vaksinMasuk->jumlah_masuk = $request->jumlah_masuk;
            $vaksinMasuk->id_vaksin = $request->vaksinId;
            $vaksinMasuk->save();

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
            $vaksin = Vaksin::find($request->vaksin_id);

            if (!$vaksin) {
                return response([
                    'status' => false,
                    'message' => 'Vaksin tidak ditemukan'
                ]);
            }

            $totalMasuk = $vaksin->masuk->sum('jumlah_masuk');
            $totalKeluar = $vaksin->keluar->sum('jumlah_keluar');

            $stok = $totalMasuk - $totalKeluar;

            // Periksa apakah stok mencukupi
            if ($stok >= $request->jumlah_keluar) {
                $vaksinKeluar = new VaksinKeluar();
                $vaksinKeluar->tanggal_keluar = $request->tanggal_keluar;
                $vaksinKeluar->jumlah_keluar = $request->jumlah_keluar;
                $vaksinKeluar->id_vaksin = $vaksin->id;
                $vaksinKeluar->save();

                $request->session()->flash('success', 'Stok berhasil dikurangi');

                return response([
                    'status' => true,
                    'message' => 'Stok berhasil dikurangi'
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
        $vaksin = Vaksin::find($request->id);

        if (!$vaksin) {
            return response()->json(['exists' => false, 'message' => 'Vaksin tidak ditemukan']);
        }

        $totalMasuk = $vaksin->masuk->sum('jumlah_masuk');
        $totalKeluar = $vaksin->keluar->sum('jumlah_keluar');

        $stok = $totalMasuk - $totalKeluar;

        if ($stok >= $request->jumlah_keluar) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false, 'message' => 'Stok tidak mencukupi']);
        }
    }


    public function destroyMasuk($id, Request $request)
    {
        $vaksinMasuk = VaksinMasuk::find($id);
        if (empty($vaksinMasuk)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => false, // Ubah status menjadi false
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $vaksinMasuk->delete();

        $request->session()->flash('success', 'Data Stok Masuk berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Stok Masuk berhasil dihapus'
        ]);
    }

    public function destroyKeluar($id, Request $request)
    {
        $vaksinKeluar = VaksinKeluar::find($id);
        if (empty($vaksinKeluar)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => false, // Ubah status menjadi false
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $vaksinKeluar->delete();

        $request->session()->flash('success', 'Data Stok Keluar berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Stok keluar berhasil dihapus'
        ]);
    }
}
