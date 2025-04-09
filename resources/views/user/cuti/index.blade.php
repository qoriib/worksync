@extends('_layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Riwayat Pengajuan Cuti</h4>

    <a href="{{ route('user.cuti.form') }}" class="btn btn-primary mb-3">Ajukan Cuti</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Alasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cutis as $cuti)
                <tr>
                    <td>{{ $cuti->tanggal_mulai }} s/d {{ $cuti->tanggal_selesai }}</td>
                    <td>{{ $cuti->alasan }}</td>
                    <td>
                        <span class="badge bg-{{ $cuti->status === 'approved' ? 'success' : ($cuti->status === 'rejected' ? 'danger' : 'secondary') }}">
                            {{ ucfirst($cuti->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada pengajuan cuti.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection