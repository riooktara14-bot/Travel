@extends('layouts.app')

@section('title', 'Tour Guide')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Tour Guide</h2>
            <small class="text-muted">Kelola data tour guide TravelGo</small>
        </div>
        <button class="btn btn-warning text-dark fw-semibold" type="button">Tambah Tour Guide</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Tour Guide</div>
                    <div class="fs-3 fw-bold">{{ $totalTourguide ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Tersedia</div>
                    <div class="fs-3 fw-bold">{{ $totalTersedia ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Bertugas</div>
                    <div class="fs-3 fw-bold">{{ $totalBertugas ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Cuti</div>
                    <div class="fs-3 fw-bold">{{ $totalCuti ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($tourguide->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th>Bahasa</th>
                                <th>Spesialisasi</th>
                                <th>Harga/Hari</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tourguide as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->no_telepon ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->bahasa ?? '-' }}</td>
                                    <td>{{ $item->spesialisasi ?? '-' }}</td>
                                    <td>Rp{{ number_format($item->harga_per_hari, 0, ',', '.') }}</td>
                                    <td>{{ $item->rating }}</td>
                                    <td>
                                        @if($item->status === 'tersedia')
                                            <span class="badge bg-success">Tersedia</span>
                                        @elseif($item->status === 'bertugas')
                                            <span class="badge bg-primary">Bertugas</span>
                                        @else
                                            <span class="badge bg-secondary">Cuti</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-primary" type="button">Edit</button>
                                            <form action="{{ route('tourguide.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5 text-center text-muted">
                    <h5 class="mb-2">Belum Ada Tour Guide</h5>
                    <p class="mb-0">Silakan tambahkan data tour guide pertama.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
