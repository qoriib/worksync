<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPresensi;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PengajuanPresensiController extends Controller
{
    public function adminHandleApprove(PengajuanPresensi $pengajuan)
    {
        $pengajuan->update(['status' => 'approved']);
        return back()->with('success', 'Pengajuan disetujui.');
    }

    public function adminHandleReject(PengajuanPresensi $pengajuan)
    {
        $pengajuan->update(['status' => 'rejected']);
        return back()->with('success', 'Pengajuan ditolak.');
    }

    public function userShowList()
    {
        $user = auth()->user();

        $presensis = Presensi::orderByDesc('waktu')->get();

        $pengajuans = PengajuanPresensi::where('user_id', $user->id)
            ->get()
            ->keyBy('presensi_id');

        return view('user.presensi.index', compact('presensis', 'pengajuans'));
    }

    public function userShowForm($presensiId)
    {
        $presensi = Presensi::findOrFail($presensiId);

        return view('user.presensi.form', compact('presensi'));
    }

    public function userHandleForm(Request $request, $presensiId)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $presensi = Presensi::findOrFail($presensiId);

        $existing = PengajuanPresensi::where('presensi_id', $presensi->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return redirect()->route('user.presensi.pengajuan.index')->with('error', 'Anda sudah mengajukan sebelumnya.');
        }

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pengajuan', 'public');
        }

        PengajuanPresensi::create([
            'presensi_id' => $presensi->id,
            'user_id' => auth()->id(),
            'alasan' => $request->alasan,
            'bukti' => $buktiPath,
        ]);

        return redirect()->route('user.presensi.view')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
