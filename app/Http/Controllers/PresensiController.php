<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function showList()
    {
        $presensis = Presensi::orderBy('tanggal', 'desc')->get();
        return view('admin.presensi.index', compact('presensis'));
    }

    public function showCreate()
    {
        return view('admin.presensi.create');
    }

    public function handleCreate(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:presensis,tanggal',
            'keterangan' => 'nullable|string',
        ]);

        Presensi::create($request->only(['tanggal', 'keterangan']));

        return redirect()->route('admin.presensi.view')->with('success', 'Presensi berhasil dibuat.');
    }

    public function showDetail($id)
    {
        $presensi = Presensi::with('absensis.user')->findOrFail($id);
        return view('admin.presensi.detail', compact('presensi'));
    }
}
