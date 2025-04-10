<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function adminShowList()
    {
        $presensis = Presensi::orderByDesc('waktu')->get();

        return view('admin.presensi.index', compact('presensis'));
    }

    public function adminShowCreate()
    {
        return view('admin.presensi.create');
    }

    public function adminHandleCreate(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:absensi,terlambat,keluar',
            'waktu' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Presensi::create([
            'jenis' => $request->jenis,
            'waktu' => $request->waktu,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.presensi.view')->with('success', 'Presensi berhasil dibuat.');
    }

    public function adminShowDetail($id)
    {
        $presensi = Presensi::with('pengajuans.user')->findOrFail($id); // include user di eager load

        return view('admin.presensi.detail', compact('presensi'));
    }

    public function adminHandleDelete(Presensi $presensi)
    {
        $presensi->delete();
        return redirect()->route('admin.presensi.view')->with('success', 'Presensi berhasil dihapus.');
    }
}
