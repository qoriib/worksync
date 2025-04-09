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
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensis as $absen)
                <tr>
                    <td>{{ $absen->user->name }}</td>
                    <td>
                        <span class="badge bg-{{ $absen->status === 'hadir' ? 'success' : 'warning' }}">
                            {{ ucfirst($absen->status) }}
                        </span>
                    </td>
                    <td>
                        @if($absen->bukti)
                            <a href="{{ asset('storage/' . $absen->bukti) }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center text-muted">Belum ada yang melakukan absensi.</p>
    @endif
@endsection