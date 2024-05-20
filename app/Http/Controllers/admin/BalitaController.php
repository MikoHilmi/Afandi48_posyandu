<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\OrangTua;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        $balitas = Balita::latest()->get();

        return view('admin.balita.list', compact('balitas'));
    }

    public function create()
    {
        $data['ortu'] = OrangTua::get();

        return view('admin.balita.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_ortu' => 'required|exists:orang_tuas,id',
            'nama_balita' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir_balita' => 'required|date',
            'jenis_kelamin_balita' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Terjadi kesalahan dalam validasi data.', 'errors' => $validator->errors()], 400);
        }

        try {
            Balita::create($request->all());

            $request->session()->flash('success', 'Data balita berhasil ditambahkan');

            return response()->json(['message' => 'Data balita berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data balita.', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id, Request $request)
    {
        $balita = Balita::find($id);
        if (empty($balita)) {
            return redirect()->route('balita.index');
        }

        $idOrtu = $balita->id_ortu;

        $orangTua = OrangTua::find($idOrtu);

        $namaOrtu = null;

        if ($orangTua) {
            $namaOrtu = $orangTua->nama_ayah . ' dan ' . $orangTua->nama_ibu;
        }

        return view('admin.balita.edit', compact('balita', 'namaOrtu'));
    }

    public function update($balitaId, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_balita' => 'required|string|max:255',
            'tanggal_lahir_balita' => 'required|date',
            'jenis_kelamin_balita' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $balita = Balita::findOrFail($balitaId);

            $balita->update($request->all());

            $request->session()->flash('success', 'Data balita berhasil diperbarui');

            return response()->json(['message' => 'Data balita berhasil diperbarui']);
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Terjadi kesalahan saat memperbarui data balita. ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function destroy($balitaId, Request $request)
    {
        $balita = Balita::find($balitaId);
        if (empty($balita)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $balita->delete();

        $request->session()->flash('success', 'Data balita berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data balita berhasil dihapus'
        ]);
    }
}
