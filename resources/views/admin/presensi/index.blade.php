@extends('_layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Daftar Presensi</h4>

    <a href="{{ route('admin.presensi.create.view') }}" class="btn btn-primary mb-3">+ Tambah Presensi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensis as $presensi)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y') }}</td>
                    <td>{{ $presensi->keterangan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.presensi.detail.view', $presensi->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection