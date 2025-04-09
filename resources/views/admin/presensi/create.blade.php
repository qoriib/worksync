@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Tambah Presensi Baru</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form class="vstack gap-3" action="{{ route('admin.presensi.create.handle') }}" method="POST">
        @csrf
        <div>
            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
            <input type="datetime-local" name="waktu_mulai" class="form-control" required>
        </div>
        <div>
            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
            <input type="datetime-local" name="waktu_selesai" class="form-control" required>
        </div>
        <div>
            <label for="keterangan" class="form-label">Keterangan (opsional)</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <div class="hstack gap-2">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.presensi.view') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection