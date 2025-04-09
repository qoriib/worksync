@extends('_layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Detail Karyawan</h3>

    <div class="card">
        <div class="card-body">
            <h5>{{ $karyawan->user->name }}</h5>
            <p><strong>Email:</strong> {{ $karyawan->user->email }}</p>
            <p><strong>Jabatan:</strong> {{ $karyawan->jabatan }}</p>
            <p><strong>No Telp:</strong> {{ $karyawan->no_telp }}</p>
            <p><strong>Alamat:</strong> {{ $karyawan->alamat }}</p>
        </div>
    </div>

    <a href="{{ route('admin.karyawan.view') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection