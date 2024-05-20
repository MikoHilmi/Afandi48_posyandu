<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kegiatan;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Image;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::latest()->get();

        return view('admin.kegiatan.list', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_kegiatan' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->passes()) {

            $kegiatan = new Kegiatan();
            $kegiatan->judul_kegiatan = $request->judul_kegiatan;
            $kegiatan->tempat = $request->tempat;
            $kegiatan->waktu = $request->waktu;
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->save();

            // save images
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $kegiatan->id . '.' . $ext;
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/kegiatan' . $newImageName;
                File::copy($sPath, $dPath);

                // Generate image thumbnail
                // $dPath = public_path() . '/uploads/kegiatan/thumb/' . $newImageName;
                // $img = Image::make($sPath);
                // // $img->resize(450, 600);
                // $img->fit(800, 600, function ($constraint) {
                //     $constraint->upsize();
                // });
                // $img->save($dPath);

                $kegiatan->image = $newImageName;
                $kegiatan->save();
            }

            $request->session()->flash('success', 'kegiatan berhasil ditambahkan');

            return response()->json([
                'status' => true,
                'message' => 'kegiatan berhasil ditambahkan'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function edit($id, Request $request)
    {
        $kegiatan = Kegiatan::find($id);
        if (empty($kegiatan)) {
            return redirect()->route('kegiatan.index');
        }
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update($id, Request $request)
    {
        $kegiatan = Kegiatan::find($id);

        $validator = Validator::make($request->all(), [
            'judul_kegiatan' => 'required',
            'tempat' => 'required',
            'waktu' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->passes()) {

            $kegiatan->judul_kegiatan = $request->judul_kegiatan;
            $kegiatan->tempat = $request->tempat;
            $kegiatan->waktu = $request->waktu;
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->save();

            $oldImage = $kegiatan->image;

            // save imagesz
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $kegiatan->id . '-' . time() . '.' . $ext;
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/kegiatan' . $newImageName;
                File::copy($sPath, $dPath);

                // Generate image thumbnail
                // $dPath = public_path().'/uploads/kegiatan/thumb/'.$newImageName;
                // $img = Image::make($sPath);
                // // $img->resize(450, 600);
                // $img->fit(800, 600, function ($constraint) {
                //     $constraint->upsize();
                // });
                // $img->save($dPath);

                $kegiatan->image = $newImageName;
                $kegiatan->save();

                // Delete old image
                // File::delete(public_path().'/uploads/kegiatan/thumb/'.$oldImage);
                File::delete(public_path() . '/uploads/kegiatan' . $oldImage);
            }

            $request->session()->flash('success', 'Data kegiatan berhasil diperbarui');

            return response()->json([
                'status' => true,
                'message' => 'Data kegiatan berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request)
    {
        $kegiatan = Kegiatan::find($id);
        if (empty($kegiatan)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $kegiatan->delete();

        $request->session()->flash('success', 'Data Kegiatan berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data Kegiatan berhasil dihapus'
        ]);
    }
}
