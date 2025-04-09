@extends('_layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Presensi Tanggal {{ \Carbon\Carbon::parse($presensi->tanggal)->format('d M Y') }}</h4>

    <form action="{{ route('user.absensi.handle', $presensi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="bukti" class="form-label">Upload Bukti Kehadiran</label>
            <input type="file" name="bukti" class="form-control" accept="image/*,application/pdf" required>
        </div>

        <button type="submit" class="btn btn-success">Kirim Absen</button>
        <a href="{{ route('user.absensi.view') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection