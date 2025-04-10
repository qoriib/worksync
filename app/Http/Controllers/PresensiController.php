<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
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

    public function userShowList()
    {
        $user = auth()->user();

        $presensis = Presensi::orderBy('waktu_mulai', 'desc')->get();
        $absensis = Absensi::where('user_id', $user->id)->get()->keyBy('presensi_id');

        return view('user.presensi.index', compact('presensis', 'absensis'));
    }

    public function userShowForm($id)
    {
        $presensi = Presensi::findOrFail($id);
        return view('user.presensi.form', compact('presensi'));
    }


    public function userHandleForm(Request $request, $presensiId)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $presensi = Presensi::findOrFail($presensiId);

        // Cek apakah user sudah absen untuk presensi ini
        $existing = Absensi::where('presensi_id', $presensi->id)
            ->where('user_id', auth()->id())
            ->first();
        if ($existing) {
            return redirect()->route('user.presensi.view')->with('error', 'Anda sudah melakukan presensi.');
        }

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_presensi', 'public');
        }

        Absensi::create([
            'presensi_id' => $presensi->id,
            'user_id' => auth()->id(),
            'status' => $request->status,
            'bukti' => $buktiPath,
        ]);

        return redirect()->route('user.presensi.view')->with('success', 'Presensi berhasil dikirim.');
    }
}
