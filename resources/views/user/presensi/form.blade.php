@extends('_layouts.app')

@section('content')
    <h4 class="mb-4">Form Presensi</h4>

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
            <th>Waktu Mulai:</th>
            <td>{{ \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <th>Waktu Selesai:</th>
            <td>{{ \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') }}</td>
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
                    <label for="status" class="form-label">Status Kehadiran <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                    </select>
                </div>
                <div>
                    <label for="bukti" class="form-label">Upload Bukti (Opsional)</label>
                    <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*">
                    <div class="form-text">Hanya file gambar (JPG, PNG), maks 2MB</div>
                </div>
                <div class="hstack gap-2">
                    <button type="submit" class="btn btn-primary">
                        Kirim Presensi
                    </button>
                    <a href="{{ route('user.presensi.view') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection