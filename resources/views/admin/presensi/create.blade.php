@extends('_layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Buat Presensi Baru</h4>

    <form action="{{ route('admin.presensi.create.handle') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <input type="text" name="keterangan" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection