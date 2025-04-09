<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function adminShowList()
    {
        $presensis = Presensi::orderByDesc('waktu_mulai')->get();

        return view('admin.presensi.index', compact('presensis'));
    }

    public function adminShowCreate()
    {
        return view('admin.presensi.create');
    }

    public function adminHandleCreate(Request $request)
    {
        $request->validate([
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'keterangan' => 'nullable|string',
        ]);

        Presensi::create([
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.presensi.view')->with('success', 'Presensi berhasil dibuat.');
    }

    public function adminShowDetail(Presensi $presensi)
    {
        $absensis = $presensi->absensis()->with('user')->get();

        return view('admin.presensi.detail', compact('presensi', 'absensis'));
    }

    public function adminHandleDelete(Presensi $presensi)
    {
        $presensi->delete();
        return redirect()->route('admin.presensi.view')->with('success', 'Presensi berhasil dihapus.');
    }

    public function userShowList()
    {
        $user = auth()->user();

        // Ambil semua presensi, urut terbaru dulu
        $presensis = Presensi::orderBy('waktu_mulai', 'desc')->get();

        // Ambil data absensi user untuk presensi yang pernah dibuat
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
