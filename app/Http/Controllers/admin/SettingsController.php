<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\TempImage;

class SettingsController extends Controller
{
    public function index()
    {
        $data = Aplikasi::first();

        return view('admin.settings.app.list', compact('data'));
    }

    public function update(Request $request)
    {
        $aplikasi = Aplikasi::first();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'foter' => 'required',
        ]);

        if ($validator->passes()) {
            $aplikasi->title = $request->title;
            $aplikasi->foter = $request->foter;
            $aplikasi->save();

            // Handle logo upload
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $aplikasi->id . '.' . $ext;
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/aplikasi' . $newImageName;
                File::copy($sPath, $dPath);

                $aplikasi->logo = $newImageName;
                $aplikasi->save();
            }

            $request->session()->flash('success', 'Berhasil diperbarui');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Error something failed');
            return redirect()->back();
        }
    }
}
