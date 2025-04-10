@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Detail Presensi</h4>

    <table class="table">
        <tr>
            <th>Jenis Presensi:</th>
            <td class="text-capitalize">{{ $presensi->jenis }}</td>
        </tr>
        <tr>
            <th>Waktu:</th>
            <td>{{ \Carbon\Carbon::parse($presensi->waktu)->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <th>Keterangan:</th>
            <td>{{ $presensi->keterangan ?? '-' }}</td>
        </tr>
    </table>

    @if($presensi->pengajuans->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th style="min-width: 10rem">Nama</th>
                        <th style="min-width: 10rem">Durasi (menit)</th>
                        <th style="min-width: 15rem">Alasan</th>
                        <th>Status</th>
                        <th style="min-width: 10rem">Diajukan Pada</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($presensi->pengajuans as $pengajuan)
                        <tr>
                            <td>{{ $pengajuan->user->name }}</td>
                            <td class="text-center">
                                {{ round(\Carbon\Carbon::parse($presensi->waktu)->diffInMinutes($pengajuan->created_at)) }}
                            </td>
                            <td>{{ $pengajuan->alasan }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ match($pengajuan->status) {
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    default => 'warning'
                                } }}">
                                    {{ ucfirst($pengajuan->status) }}
                                </span>
                            </td>
                            <td class="text-center">{{ $pengajuan->created_at->format('d M Y H:i') }}</td>
                            <td class="text-center text-nowrap">
                                @if($pengajuan->bukti)
                                    <a class="btn btn-outline-secondary btn-sm" href="{{ asset('storage/' . $pengajuan->bukti) }}" target="_blank">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center text-nowrap">
                                @if($pengajuan->status === 'pending')
                                    <form action="{{ route('admin.pengajuan_presensi.approve.handle', $pengajuan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.pengajuan_presensi.reject.handle', $pengajuan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
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
        <div class="alert alert-danger text-center">Belum ada pengajuan untuk presensi ini.</div>
    @endif
@endsection