@extends('_layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Ajukan Cuti</h4>

    <form action="{{ route('user.cuti.handle') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan</label>
            <textarea name="alasan" rows="3" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Ajukan</button>
        <a href="{{ route('user.cuti.view') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection