@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Detail Presensi</h4>

    <table class="table">
        <tr>
            <th>Waktu Mulai:</th>
            <td>{{ \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <th>Waktu Selesai:</th>
            <td>{{ \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <th>Keterangan:</th>
            <td>{{ $presensi->keterangan ?? '-' }}</td>
        </tr>
    </table>

    @if($absensis->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th style="min-width: 10rem">Nama</th>
                        <th>Status</th>
                        <th style="min-width: 10rem">Waktu</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensis as $absen)
                    <tr>
                        <td>{{ $absen->user->name }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $absen->status === 'hadir' ? 'success' : 'warning' }}">
                                {{ ucfirst($absen->status) }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($absen->created_at)->format('d M Y H:i') }}</td>
                        <td class="text-center text-nowrap">
                            @if($absen->bukti)
                                <a class="btn btn-outline-secondary btn-sm" href="{{ asset('storage/' . $absen->bukti) }}" target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-muted">Belum ada yang melakukan absensi.</p>
    @endif
@endsection