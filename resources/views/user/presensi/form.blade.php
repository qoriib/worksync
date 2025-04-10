@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Form Pengajuan Koreksi Presensi</h4>

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

    <div class="card shadow-sm">
        <div class="card-body">
            <form class="vstack gap-3" action="{{ route('user.presensi.form.handle', $presensi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="alasan" class="form-label">Alasan Pengajuan <span class="text-danger">*</span></label>
                    <textarea name="alasan" id="alasan" class="form-control" rows="4" required>{{ old('alasan') }}</textarea>
                </div>
                <div>
                    <label for="bukti" class="form-label">Upload Bukti Pendukung <span class="text-danger">*</span></label>
                    <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*" required>
                    <div class="form-text">Format: JPG, PNG | Maks 2MB</div>
                </div>
                <div class="hstack gap-2">
                    <button type="submit" class="btn btn-primary">
                        Kirim Pengajuan
                    </button>
                    <a href="{{ route('user.presensi.view') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection