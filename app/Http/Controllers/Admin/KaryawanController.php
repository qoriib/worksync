<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function showList()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function showDetail($id)
    {
        $karyawan = Karyawan::with('user')->findOrFail($id);
        return view('admin.karyawan.detail', compact('karyawan'));
    }

    public function showCreate()
    {
        return view('admin.karyawan.create');
    }


    public function handleCreateKaryawan(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:admin,user',
            'jabatan' => 'required',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

        $user->karyawan()->create([
            'jabatan' => $data['jabatan'],
        ]);

        return redirect()->route('admin.karyawan.view');
    }

    public function handleDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.karyawan.view')->with('success', 'Karyawan berhasil dihapus.');
    }
}
