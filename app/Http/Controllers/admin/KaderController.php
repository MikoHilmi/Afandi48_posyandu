<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kader;

class KaderController extends Controller
{
    public function index(Request $request)
    {
        $kaders = Kader::latest()->get();

        return view('admin.kader.list', compact('kaders'));
    }

    public function create()
    {
        return view('admin.kader.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kader' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Terjadi kesalahan dalam validasi data.', 'errors' => $validator->errors()], 400);
        }

        try {
            Kader::create($request->all());

            $request->session()->flash('success', 'Data Kader berhasil ditambahkan');

            return response()->json(['message' => 'Data Kader berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data Kader.', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id, Request $request)
    {
        $kader = Kader::find($id);
        if (empty($kader)) {
            return redirect()->route('kader.index');
        }
        return view('admin.kader.edit', compact('kader'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kader' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $kader = Kader::findOrFail($id);

            $kader->update($request->all());

            $request->session()->flash('success', 'Data Kader berhasil diperbarui');

            return response()->json(['message' => 'Data Kader berhasil diperbarui']);
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Terjadi kesalahan saat memperbarui data Kader. ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function destroy($id, Request $request)
    {
        $kader = kader::find($id);
        if (empty($kader)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $kader->delete();

        $request->session()->flash('success', 'Data Kader berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Kader berhasil dihapus'
        ]);
    }
}
