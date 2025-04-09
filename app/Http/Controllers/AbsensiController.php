<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function showList()
    {
        $presensis = Presensi::orderBy('tanggal', 'desc')->get();
        return view('user.absensi.index', compact('presensis'));
    }

    public function showForm($id)
    {
        $presensi = Presensi::findOrFail($id);
        return view('user.absensi.form', compact('presensi'));
    }

    public function handleSubmit(Request $request, $presensiId)
    {
        $request->validate([
            'bukti' => 'required|file|max:2048',
        ]);

        $presensi = Presensi::findOrFail($presensiId);

        // Upload bukti
        $path = $request->file('bukti')->store('bukti_absen', 'public');

        // Waktu sekarang dan batas (misal 09:00 WIB)
        $now = now();
        $batas = now()->setTime(9, 0, 0);

        $status = $now->lessThanOrEqualTo($batas) ? 'hadir' : 'terlambat';

        Absensi::create([
            'user_id' => auth()->id(),
            'presensi_id' => $presensi->id,
            'status' => $status,
            'bukti' => $path,
        ]);

        return redirect()->route('user.absensi.view')->with('success', 'Absensi berhasil dikirim.');
    }
}
