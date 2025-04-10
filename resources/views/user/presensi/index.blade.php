@extends('_layouts.app')

@section('content')
<div class="container">
    <h4 class="text-center mb-4">Riwayat Pengajuan Presensi</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $grouped = $presensis->groupBy('jenis');
    @endphp

    <div class="vstack gap-3">
        @forelse($grouped as $jenis => $items)
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th class="table-secondary text-capitalize" colspan="6">{{ $jenis }}</th>
                        </tr>
                        <tr>
                            <th style="min-width: 10rem">Waktu</th>
                            <th style="min-width: 15rem">Alasan</th>
                            <th>Status</th>
                            <th style="min-width: 10rem">Durasi (menit)</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $presensi)
                            @php
                                $pengajuan = $pengajuans[$presensi->id] ?? null;
                                $durasi = $pengajuan 
                                    ? \Carbon\Carbon::parse($presensi->waktu)->diffInMinutes($pengajuan->created_at)
                                    : null;
                            @endphp
                            <tr>
                                <td class="text-center">{{ \Carbon\Carbon::parse($presensi->waktu)->format('d M Y H:i') }}</td>
                                <td>{{ $pengajuan?->alasan ?? '-' }}</td>
                                <td class="text-center">
                                    @if($pengajuan)
                                        <span class="badge bg-{{ match($pengajuan->status) {
                                            'approved' => 'success',
                                            'rejected' => 'danger',
                                            default => 'warning'
                                        } }}">
                                            {{ ucfirst($pengajuan->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Belum Mengajukan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($durasi !== null)
                                        {{ round($durasi) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center text-nowrap">
                                    @if($pengajuan)
                                        @if($pengajuan->bukti)
                                            <a href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    @else
                                        <a href="{{ route('user.presensi.form.view', $presensi->id) }}" class="btn btn-sm btn-primary">Ajukan</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div class="alert alert-warning text-center">Tidak ada data pengajuan presensi.</div>
        @endforelse
    </div>
</div>
@endsection