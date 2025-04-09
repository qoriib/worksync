<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function userShowList()
    {
        $cutis = Cuti::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('user.cuti.index', compact('cutis'));
    }

    public function userHandleSubmit(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        Cuti::create([
            'user_id' => auth()->id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('user.cuti.view')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }

    public function adminShowList()
    {
        $cutis = Cuti::with('user')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.cuti.index', compact('cutis'));
    }

    public function adminHandleApproval($id, $status)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = $status;
        $cuti->save();

        return back()->with('success', 'Status cuti diperbarui.');
    }
}
