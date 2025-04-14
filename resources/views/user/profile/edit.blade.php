@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Sesuaikan Profil Saya</h4>

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

    <form action="{{ route('user.profile.edit.handle') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-3">
                <div class="card text-center mb-3">
                    <div class="card-body">
                        @if ($karyawan->foto_profil)
                            <img src="{{ asset('storage/' . $karyawan->foto_profil) }}" 
                                 alt="Foto Profil" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="max-width: 150px; height: auto;">
                        @else
                            <div class="text-muted mb-3">Belum ada foto profil</div>
                        @endif
                        <div>
                            <label for="foto_profil" class="form-label">Ganti Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Informasi Umum</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $karyawan->jabatan) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                            <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{ old('nama_panggilan', $karyawan->nama_panggilan) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="golongan_darah" class="form-label">Golongan Darah</label>
                            <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" value="{{ old('golongan_darah', $karyawan->golongan_darah) }}">
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama" name="agama" value="{{ old('agama', $karyawan->agama) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Identitas</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No KTP</label>
                            <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $karyawan->no_ktp) }}">
                        </div>
                        <div class="mb-3">
                            <label for="ktp_berlaku_sampai" class="form-label">KTP Berlaku Sampai</label>
                            <input type="date" class="form-control" id="ktp_berlaku_sampai" name="ktp_berlaku_sampai" value="{{ old('ktp_berlaku_sampai', $karyawan->ktp_berlaku_sampai) }}">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">Fisik</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" value="{{ old('tinggi_badan', $karyawan->tinggi_badan) }}">
                        </div>
                        <div class="mb-3">
                            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" value="{{ old('berat_badan', $karyawan->berat_badan) }}">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">Keluarga</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Perkawinan</label>
                            <select class="form-select" name="status" id="status">
                                <option value="">-- Pilih --</option>
                                <option value="Kawin" {{ old('status', $karyawan->status) === 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Belum Kawin" {{ old('status', $karyawan->status) === 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Duda/Janda" {{ old('status', $karyawan->status) === 'Duda/Janda' ? 'selected' : '' }}>Duda/Janda</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                            <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" value="{{ old('jumlah_anak', $karyawan->jumlah_anak) }}">
                        </div>
                        <div class="mb-3">
                            <label for="anak_ke" class="form-label">Anak Ke</label>
                            <input type="text" class="form-control" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $karyawan->anak_ke) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Kontak & Alamat</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $karyawan->alamat) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tinggal_dengan_keluarga" id="tinggal_dengan_keluarga" {{ old('tinggal_dengan_keluarga', $karyawan->tinggal_dengan_keluarga) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tinggal_dengan_keluarga">Tinggal dengan Keluarga</label>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">Kontak Darurat</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="darurat_nama" class="form-label">Nama Kontak Darurat</label>
                            <input type="text" class="form-control" id="darurat_nama" name="darurat_nama" value="{{ old('darurat_nama', $karyawan->darurat_nama) }}">
                        </div>
                        <div class="mb-3">
                            <label for="darurat_hubungan" class="form-label">Hubungan</label>
                            <input type="text" class="form-control" id="darurat_hubungan" name="darurat_hubungan" value="{{ old('darurat_hubungan', $karyawan->darurat_hubungan) }}">
                        </div>
                        <div class="mb-3">
                            <label for="darurat_telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="darurat_telepon" name="darurat_telepon" value="{{ old('darurat_telepon', $karyawan->darurat_telepon) }}">
                        </div>
                        <div class="mb-3">
                            <label for="darurat_alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="darurat_alamat" name="darurat_alamat">{{ old('darurat_alamat', $karyawan->darurat_alamat) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hstack gap-2">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('user.profile.view') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection