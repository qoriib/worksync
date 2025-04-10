@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Profil Saya</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header fw-bold">Informasi Umum</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $karyawan->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $karyawan->jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Panggilan</th>
                            <td>{{ $karyawan->nama_panggilan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>
                                {{ $karyawan->tempat_lahir ?? '-' }},
                                {{ optional($karyawan->tanggal_lahir)->format('d M Y') ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Golongan Darah</th>
                            <td>{{ $karyawan->golongan_darah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $karyawan->agama ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header fw-bold">Identitas</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>No KTP</th>
                            <td>{{ $karyawan->no_ktp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>KTP Berlaku Sampai</th>
                            <td>{{ optional($karyawan->ktp_berlaku_sampai)->format('d M Y') ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Fisik</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Tinggi Badan</th>
                            <td>{{ $karyawan->tinggi_badan ? $karyawan->tinggi_badan . ' cm' : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Berat Badan</th>
                            <td>{{ $karyawan->berat_badan ? $karyawan->berat_badan . ' kg' : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Keluarga</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Status</th>
                            <td>{{ $karyawan->status ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Anak</th>
                            <td>{{ $karyawan->jumlah_anak ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Anak Ke</th>
                            <td>{{ $karyawan->anak_ke ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header fw-bold">Kontak & Alamat</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $karyawan->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $karyawan->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tinggal dengan Keluarga</th>
                            <td>{{ $karyawan->tinggal_dengan_keluarga ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Kontak Darurat</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $karyawan->darurat_nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Hubungan</th>
                            <td>{{ $karyawan->darurat_hubungan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $karyawan->darurat_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $karyawan->darurat_alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="vstack align-items-center">
        <a href="{{ route('user.profile.edit.view') }}" class="btn btn-primary mt-3">Ubah Profil</a>
    </div>
@endsection