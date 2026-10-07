@extends('layouts.app')
@section('title', 'Laporan Pendapatan')

@section('content')
<div class="container-fluid py-4">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="mb-1">💰 Laporan Pendapatan</h3>
                <small class="text-muted">Data transaksi dari database</small>
            </div>

            
        </div>
    </div>


    {{-- STATISTIK --}}
    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Pendapatan Hari Ini</small>
                    <h4 class="fw-bold text-success mb-0">
                        Rp{{ number_format(
                            $transaksiPendapatan->where(
                                'tanggal_transaksi',
                                today()->toDateString()
                            )->sum('total'),
                            0,
                            ',',
                            '.'
                        ) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Pendapatan Bulan Ini</small>
                    <h4 class="fw-bold text-primary mb-0">
                        Rp{{ number_format(
                            $transaksiPendapatan->whereBetween(
                                'tanggal_transaksi',
                                [
                                    now()->startOfMonth(),
                                    now()->endOfMonth()
                                ]
                            )->sum('total'),
                            0,
                            ',',
                            '.'
                        ) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Pendapatan Tahun Ini</small>
                    <h4 class="fw-bold text-warning mb-0">
                        Rp{{ number_format(
                            $transaksiPendapatan->whereBetween(
                                'tanggal_transaksi',
                                [
                                    now()->startOfYear(),
                                    now()->endOfYear()
                                ]
                            )->sum('total'),
                            0,
                            ',',
                            '.'
                        ) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Transaksi</small>
                    <h4 class="fw-bold text-danger mb-0">
                        {{ $transaksi->count() }}
                    </h4>
                </div>
            </div>
        </div>

    </div>


    {{-- GRAFIK --}}
    @php
        $grafikPendapatan = $transaksiPendapatan
            ->filter(function ($item) {
                return !empty($item->tanggal_transaksi);
            })
            ->groupBy(function ($item) {
                return $item->tanggal_transaksi->format('Y-m-d');
            })
            ->map(function ($items) {
                return $items->sum('total');
            })
            ->sortKeys();

        $grafikLabels = $grafikPendapatan->keys()->map(function ($tanggal) {
            return \Carbon\Carbon::parse($tanggal)->translatedFormat('d M Y');
        })->values();

        $grafikData = $grafikPendapatan->values();
    @endphp

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">📊 Grafik Pendapatan</h5>
                <small class="text-muted">
                    Grafik berdasarkan data transaksi dari database
                </small>
            </div>
        </div>

        <div class="card-body">
            <div style="height: 350px;">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>
    </div>


    {{-- RINCIAN TRANSAKSI --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">🧾 Rincian Transaksi</h5>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Paket Wisata</th>
                        <th>Metode</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($transaksi as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $item->kode_transaksi }}
                                </span>
                            </td>

                            <td>{{ $item->nama_pelanggan }}</td>

                            <td>{{ $item->paket_wisata }}</td>

                            <td>{{ $item->metode_pembayaran }}</td>

                            <td>
                                {{ $item->tanggal_transaksi
                                    ? $item->tanggal_transaksi->translatedFormat('d M Y')
                                    : '-'
                                }}
                            </td>

                            <td>
                                <span class="badge
                                    {{
                                        $item->status == 'Lunas'
                                            ? 'bg-success'
                                            : (
                                                $item->status == 'Pending'
                                                    ? 'bg-warning text-dark'
                                                    : 'bg-danger'
                                            )
                                    }}">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td class="text-end fw-bold text-success">
                                Rp{{ number_format($item->total, 0, ',', '.') }}
                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTransaksiModal{{ $item->id }}"
                                    >
                                        <i class="mdi mdi-pencil"></i>
                                    </button>

                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('pendapatan.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                Belum ada data transaksi.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

                <tfoot class="table-light">

                    <tr>
                        <th colspan="7" class="text-end">
                            Total Pendapatan
                        </th>

                        <th class="text-end text-success">
                            Rp{{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                        </th>

                        <th></th>
                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</div>




{{-- ========================================================= --}}
{{-- MODAL EDIT TRANSAKSI --}}
{{-- ========================================================= --}}

@foreach ($transaksi as $item)

<div
    class="modal fade"
    id="editTransaksiModal{{ $item->id }}"
    tabindex="-1"
>

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="{{ route('pendapatan.update', $item->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Edit Transaksi
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <div class="modal-body row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Kode Transaksi
                        </label>

                        <input
                            type="text"
                            name="kode_transaksi"
                            class="form-control"
                            value="{{ $item->kode_transaksi }}"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Nama Pelanggan
                        </label>

                        <input
                            type="text"
                            name="nama_pelanggan"
                            class="form-control"
                            value="{{ $item->nama_pelanggan }}"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Paket Wisata
                        </label>

                        <input
                            type="text"
                            name="paket_wisata"
                            class="form-control"
                            value="{{ $item->paket_wisata }}"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Metode Pembayaran
                        </label>

                        <select
                            name="metode_pembayaran"
                            class="form-select"
                            required
                        >

                            <option
                                value="Transfer Bank"
                                {{ $item->metode_pembayaran == 'Transfer Bank' ? 'selected' : '' }}
                            >
                                Transfer Bank
                            </option>

                            <option
                                value="QRIS"
                                {{ $item->metode_pembayaran == 'QRIS' ? 'selected' : '' }}
                            >
                                QRIS
                            </option>

                            <option
                                value="E-Wallet"
                                {{ $item->metode_pembayaran == 'E-Wallet' ? 'selected' : '' }}
                            >
                                E-Wallet
                            </option>

                            <option
                                value="Kartu Kredit"
                                {{ $item->metode_pembayaran == 'Kartu Kredit' ? 'selected' : '' }}
                            >
                                Kartu Kredit
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Total
                        </label>

                        <input
                            type="number"
                            min="0"
                            name="total"
                            class="form-control"
                            value="{{ $item->total }}"
                            required
                        >

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal_transaksi"
                            class="form-control"
                            value="{{
                                $item->tanggal_transaksi
                                    ? $item->tanggal_transaksi->format('Y-m-d')
                                    : ''
                            }}"
                            required
                        >

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="Lunas"
                                {{ $item->status == 'Lunas' ? 'selected' : '' }}
                            >
                                Lunas
                            </option>

                            <option
                                value="Pending"
                                {{ $item->status == 'Pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="Dibatalkan"
                                {{ $item->status == 'Dibatalkan' ? 'selected' : '' }}
                            >
                                Dibatalkan
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Perbarui
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach


{{-- ========================================================= --}}
{{-- CHART.JS --}}
{{-- ========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('pendapatanChart');

    if (!canvas) {
        return;
    }

    const labels = @json($grafikLabels);
    const data = @json($grafikData);

    new Chart(canvas, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [{

                label: 'Pendapatan',

                data: data,

                borderWidth: 3,

                tension: 0.4,

                fill: true,

                pointRadius: 5,

                pointHoverRadius: 7

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {

                legend: {
                    display: true
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            let value = context.raw || 0;

                            return ' Pendapatan: Rp' +
                                new Intl.NumberFormat('id-ID').format(value);

                        }

                    }

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function(value) {

                            return 'Rp' +
                                new Intl.NumberFormat('id-ID', {
                                    notation: 'compact'
                                }).format(value);

                        }

                    }

                },

                x: {

                    grid: {
                        display: false
                    }

                }

            }

        }

    });

});

</script>

@endsection
