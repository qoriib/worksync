@extends('_layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Presensi: {{ \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y') }}</h4>
    <p><strong>Keterangan:</strong> {{ $presensi->keterangan ?? '-' }}</p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Status</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($presensi->absensis as $absen)
                <tr>
                    <td>{{ $absen->user->name }}</td>
                    <td>
                        <span class="badge bg-{{ $absen->status === 'hadir' ? 'success' : ($absen->status === 'terlambat' ? 'warning' : 'danger') }}">
                            {{ ucfirst($absen->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($absen->bukti)
                            <a href="{{ asset('storage/'.$absen->bukti) }}" target="_blank" class="btn btn-sm btn-primary">Lihat Bukti</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada absensi untuk presensi ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection