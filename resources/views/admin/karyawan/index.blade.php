@extends('_layouts.app')

@section('content')
    <h3 class="mb-4">Data Karyawan</h3>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawan as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->user->name }}</td>
                <td>{{ $k->user->email }}</td>
                <td>{{ $k->jabatan }}</td>
                <td>
                    <a href="{{ route('admin.karyawan.detail.view', $k->id) }}" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection