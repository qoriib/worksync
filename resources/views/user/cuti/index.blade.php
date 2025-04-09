@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Pengajuan Cuti</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Ajukan Cuti Baru</div>
        <div class="card-body">
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
                    <textarea name="alasan" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
            </form>
        </div>
    </div>

    <h4 class="text-center mb-4">Riwayat Pengajuan</h4>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
            <tr>
                <th style="min-width: 7.5rem">Dari</th>
                <th style="min-width: 7.5rem">Hingga</th>
                <th style="min-width: 15rem">Alasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cutis as $index => $cuti)
                <tr>
                    <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}</td>
                    <td>{{ $cuti->alasan }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $cuti->status === 'approved' ? 'success' : ($cuti->status === 'rejected' ? 'danger' : 'secondary') }}">
                            {{ ucfirst($cuti->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada pengajuan cuti.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection