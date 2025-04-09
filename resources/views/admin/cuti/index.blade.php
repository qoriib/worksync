@extends('_layouts.app')

@section('content')
    <h4 class="mb-4">Pengajuan Cuti Karyawan</h4>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Periode</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cutis as $index => $cuti)
                    <tr>
                        <td>{{ $cuti->user->name }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}
                        </td>
                        <td>{{ $cuti->alasan }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $cuti->status === 'approved' ? 'success' : ($cuti->status === 'rejected' ? 'danger' : 'secondary') }}">
                                {{ ucfirst($cuti->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($cuti->status === 'pending')
                                <form action="{{ route('admin.cuti.approval', [$cuti->id, 'approved']) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                </form>
                                <form action="{{ route('admin.cuti.approval', [$cuti->id, 'rejected']) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                </form>
                            @else
                                <span class="text-muted">Sudah Diproses</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada pengajuan cuti.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection