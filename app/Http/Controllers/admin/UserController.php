<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user.list', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam validasi data.',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            User::create($request->all());

            $request->session()->flash('success', 'Data Pengguna berhasil ditambahkan');

            return response()->json(['message' => 'Data Pengguna berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data Pengguna.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $user = User::find($id);
        if (empty($user)) {
            $request->session()->flash('error', 'Data tidak ditemukan');
            return response()->json([
                'status' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $user->delete();

        $request->session()->flash('success', 'Data User berhasil dihapus');

        return response()->json([
            'status' => true,
            'message' => 'Data User berhasil dihapus'
        ]);
    }
}
