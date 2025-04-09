@extends('_layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Daftar Presensi</h4>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Status Anda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensis as $presensi)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y') }}</td>
                    <td>
                        @php
                            $absen = $presensi->absensis->where('user_id', auth()->id())->first();
                        @endphp
                        @if ($absen)
                            <span class="badge bg-{{ $absen->status === 'hadir' ? 'success' : ($absen->status === 'terlambat' ? 'warning' : 'danger') }}">
                                {{ ucfirst($absen->status) }}
                            </span>
                        @else
                            <span class="text-muted">Belum absen</span>
                        @endif
                    </td>
                    <td>
                        @if (!$absen)
                            <a href="{{ route('user.absensi.form.view', $presensi->id) }}" class="btn btn-sm btn-primary">Isi Absen</a>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Sudah Absen</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection