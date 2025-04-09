@extends('_layouts.app')

@section('content')
<div class="container">
    <h4 class="text-center mb-4">Riwayat Presensi</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th style="min-width: 10rem">Waktu Mulai</th>
                    <th style="min-width: 10rem">Waktu Selesai</th>
                    <th style="min-width: 15rem">Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($presensis as $index => $presensi)
                    @php
                        $absen = $absensis[$presensi->id] ?? null;
                        $status = $absen ? $absen->status : 'belum';
                        $isActive = now()->between($presensi->waktu_mulai, $presensi->waktu_selesai);
                        $now = now();
                        $mulai = \Carbon\Carbon::parse($presensi->waktu_mulai);
                        $selesai = \Carbon\Carbon::parse($presensi->waktu_selesai);
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') }}</td>
                        <td>{{ $presensi->keterangan ?? '-' }}</td>
                        <td class="text-center">
                            @if($absen)
                                @if($absen->status === 'hadir')
                                    @if($absen->waktu_mulai > $mulai)
                                        <span class="badge bg-info">Terlambat</span>
                                    @else
                                        <span class="badge bg-success">Hadir</span>
                                    @endif
                                @elseif($absen->status === 'izin')
                                    <span class="badge bg-warning">Izin</span>
                                @endif
                            @else
                                @if($now->lt($mulai))
                                    <span class="badge bg-secondary">Belum Dibuka</span>
                                @elseif($now->between($mulai, $selesai))
                                    <span class="badge bg-primary">Sedang Dibuka</span>
                                @else
                                    <span class="badge bg-danger">Tidak Presensi</span>
                                @endif
                            @endif
                        </td>
                        <td class="text-center text-nowrap">
                            @if(!$absen && $isActive)
                                <a class="btn btn-primary btn-sm" href="{{ route('user.presensi.form.view', $presensi->id)}}">Presensi</a>
                            @elseif($absen && $absen->bukti)
                                <a href="{{ asset('storage/' . $absen->bukti) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat Bukti</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                @if($presensis->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data presensi</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection