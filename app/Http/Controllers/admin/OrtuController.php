<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrtuController extends Controller
{
    protected $balita;

    public function __construct(Balita $balita)
    {
    }

    public function index()
    {
        $data['ortu'] = OrangTua::get();

        return view('admin.ortu.list', compact('data'));
    }

    public function create()
    {
        return view('admin.ortu.create');
    }

    public function store(Request $request)
    {
        try {
            $pesan = [
                'required' => ':attribute wajib diisi !',
                'min' => ':attribute harus diisi minimal :min karakter !',
                'max' => ':attribute harus diisi maksimal :max karakter !',
                'numeric' => ':attribute harus diisi angka !',
                'nik_ayah.unique' => 'NIK sudah tersedia.',
                'nik_ibu.unique' => 'NIK sudah tersedia.',
                'nama_ayah.unique' => 'Nama Ayah sudah tersedia.',
                'nama_ibu.unique' => 'Nama Ibu sudah tersedia.',
            ];

            $validator = Validator::make($request->all(), [
                'nama_ayah' => 'required|string|unique:orang_tuas,nama_ayah',
                'nama_ibu' => 'required|string|unique:orang_tuas,nama_ibu',
                'tanggal_lahir_ayah' => 'required|date',
                'tanggal_lahir_ibu' => 'required|date',
                'nik_ayah' => 'required|string|min:16|max:16|unique:orang_tuas,nik_ayah',
                'nik_ibu' => 'required|string|min:16|max:16|unique:orang_tuas,nik_ayah',
                'phone' => 'required|string',
                'alamat' => 'required|string',
            ], $pesan);

            if ($validator->passes()) {
                $ortu = new OrangTua;
                $ortu->nama_ayah = $request->nama_ayah;
                $ortu->nama_ibu = $request->nama_ibu;
                $ortu->tanggal_lahir_ayah = $request->tanggal_lahir_ayah;
                $ortu->tanggal_lahir_ibu = $request->tanggal_lahir_ibu;
                $ortu->nik_ayah = $request->nik_ayah;
                $ortu->nik_ibu = $request->nik_ibu;
                $ortu->phone = $request->phone;
                $ortu->alamat = $request->alamat;
                $ortu->save();

                $request->session()->flash('success', 'Data orang tua berhasil ditambahkan');

                return response()->json([
                    'success' => true,
                    'message' => 'Data orang tua berhasil ditambahkan'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            }
        } catch (\Throwable $th) {
            $request->session()->flash('error', 'Terjadi kesalahan saat validasi data ' . $th->getMessage());

            return redirect()->back();
        }
    }

    public function checkExistingData(Request $request)
    {
        $type = $request->type;
        $value = $request->value;

        // Check if NIK or name already exists
        $exists = false;
        $message = '';

        if ($type === 'nik_ayah' || $type === 'nik_ibu') {
            $exists = OrangTua::where($type, $value)->exists();
            $message = 'NIK sudah tersedia.';
        } elseif ($type === 'nama_ayah' || $type === 'nama_ibu') {
            $exists = OrangTua::where($type, $value)->exists();
            $message = 'Nama sudah tersedia.';
        }

        return response()->json([
            'exists' => $exists,
            'message' => $message
        ]);
    }

    public function edit(Request $request, $id)
    {
        $ortu = OrangTua::findOrFail($id);

        if (empty($ortu)) {
            return redirect()->route('orang-tua.index');
        }

        return view('admin.ortu.edit', compact('ortu'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'tanggal_lahir_ayah' => 'required|date',
            'tanggal_lahir_ibu' => 'required|date',
            'nik_ayah' => 'required|integer|string',
            'nik_ibu' => 'required|integer|string',
            'phone' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $ortu = OrangTua::findOrFail($id);

            $ortu->update($request->all());

            $request->session()->flash('success', 'Data Orang Tua berhasil diperbarui');

            return response()->json(['message' => 'Data Orang Tua berhasil diperbarui']);
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Terjadi kesalahan saat memperbarui data Orang Tua. ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function getBalita($id)
    {
        $balitas = Balita::where('id_ortu', $id)->get();

        $formattedBalitas = $balitas->map(function ($balita) {
            return [
                'id' => $balita->id,
                'nama_balita' => $balita->nama_balita,
                'tanggal_lahir_balita' => $balita->getFormattedTanggalLahirAttribute(),
                'usia' => $balita->getUsiaAttribute(),
                'jenis_kelamin_balita' => $balita->jenis_kelamin_balita,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedBalitas
        ]);
    }

    public function destroy($id, Request $request)
    {
        $orang_tua = OrangTua::find($id);
        if (empty($orang_tua)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $orang_tua->delete();

        $request->session()->flash('success', 'Data Orang Tua berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Orang Tua berhasil dihapus'
        ]);
    }
}
