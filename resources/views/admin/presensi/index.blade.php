@extends('_layouts.app')

@section('content')
    <div class="hstack justify-content-between gap-3 mb-4">
        <h4 class="mb-0">Daftar Presensi</h4>
        <a href="{{ route('admin.presensi.create.view') }}" class="btn btn-success">Tambah</a>
    </div>

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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($presensis as $index => $presensi)
                    <tr>
                        <td class="text-center">{{ \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') }}</td>
                        <td>{{ $presensi->keterangan ?? '-' }}</td>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.presensi.detail.view', $presensi->id) }}">Detail</a>
                            <form class="d-inline" action="{{ route('admin.presensi.delete.handle', $presensi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data presensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection