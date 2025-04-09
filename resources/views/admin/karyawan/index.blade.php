@extends('_layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Karyawan</h4>
        <a href="{{ route('admin.karyawan.create.view') }}" class="btn btn-success">+ Tambah Karyawan</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Role</th>
                <th width="140">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
                <tr>
                    <td>{{ $karyawan->user->name }}</td>
                    <td>{{ $karyawan->user->email }}</td>
                    <td>{{ $karyawan->jabatan }}</td>
                    <td>{{ $karyawan->user->role }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.karyawan.detail.view', $karyawan->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        <form action="{{ route('admin.karyawan.delete.handle', $karyawan->user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if ($karyawans->isEmpty())
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data karyawan.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection