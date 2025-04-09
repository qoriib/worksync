<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function adminShowList()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function adminShowDetail($id)
    {
        $karyawan = Karyawan::with('user')->findOrFail($id);
        return view('admin.karyawan.detail', compact('karyawan'));
    }

    public function adminShowCreate()
    {
        return view('admin.karyawan.create');
    }

    public function adminHandleCreate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'jabatan' => 'required|string',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        $user->karyawan()->create([
            'jabatan' => $data['jabatan'],
        ]);

        return redirect()->route('admin.karyawan.view')->with('success', 'Karyawan berhasil dibuat.');
    }

    public function adminHandleDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.karyawan.view')->with('success', 'Karyawan berhasil dihapus.');
    }

    public function userShowProfile()
    {
        $karyawan = Auth::user()->karyawan;
        return view('user.profile.show', compact('karyawan'));
    }

    public function userShowProfileEdit()
    {
        $karyawan = Auth::user()->karyawan;
        return view('user.profile.edit', compact('karyawan'));
    }

    public function userHandleProfileEdit(Request $request)
    {
        $data = $request->validate([
            'jabatan' => 'nullable|string|max:255',
            'nama_panggilan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'golongan_darah' => 'nullable|string|max:5',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
            'jumlah_anak' => 'nullable|integer|min:0',
            'anak_ke' => 'nullable|string|max:10',
            'tinggi_badan' => 'nullable|integer|min:0',
            'berat_badan' => 'nullable|integer|min:0',
            'no_ktp' => 'nullable|string|max:50',
            'ktp_berlaku_sampai' => 'nullable|date',
            'tinggal_dengan_keluarga' => 'nullable|boolean',
            'darurat_nama' => 'nullable|string|max:255',
            'darurat_hubungan' => 'nullable|string|max:255',
            'darurat_telepon' => 'nullable|string|max:20',
            'darurat_alamat' => 'nullable|string',
        ]);

        $karyawan = Auth::user()->karyawan;
        $karyawan->update($data);

        return redirect()->route('user.profile.view')->with('success', 'Data diri berhasil diperbarui.');
    }
}
