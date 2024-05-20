<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\BalitaAntrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AntrianController extends Controller
{

    public function index()
    {
        $antrian = DB::table('antrians')
            ->join('balita_antrians', 'balita_antrians.antrian_id', '=', 'antrians.id')
            ->select('antrians.*', 'balita_antrians.nama_balita')
            ->get();

        return view('admin.antrian.list', compact('antrian'));
    }

    public function countAntrian(Request $request)
    {
        $request->validate([
            'nama_ibu' => 'required',
            'nama_balita.*' => 'required' // Validate each child's name
        ]);

        $lastAntrian = Antrian::orderBy('id', 'desc')->first();

        $nomorUrut = $lastAntrian ? $lastAntrian->nomor_urut + 1 : 1;

        $antrian = Antrian::create([
            'nomor_urut' => $nomorUrut,
            'status' => 0,
            'nama_ibu' => $request->nama_ibu,
        ]);

        $balita = $request->nama_balita;

        foreach ($balita as $nama_balita) {
            BalitaAntrian::create([
                'antrian_id' => $antrian->id,
                'nama_balita' => $nama_balita,
            ]);
        }

        $request->session()->flash('success', 'Data antrian berhasil diambil!');

        // dd($balita);

        return redirect()->back()->with('success', 'Data antrian berhasil diambil!');
    }


    public function clear(Request $request)
    {
        Antrian::query()->delete();
        BalitaAntrian::query()->delete();

        $request->session()->flash('success', 'Data antrian berhasil dibersihkan!');

        return response()->json([
            'status' => true,
            'message' => 'Data antrian berhasil dibersihkan!'
        ]);
    }


    public function changeStatus($id)
    {
        $antrian = Antrian::find($id);

        $antrian->status = ($antrian->status == 1) ? 0 : 1;
        $antrian->save();

        return redirect()->back();
    }
}
