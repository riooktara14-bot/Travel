@extends('layouts.app')
@section('title', 'Laporan Keuangan')

@section('content')

<div class="container-fluid py-4">

{{-- HEADER --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h3 class="mb-1 fw-bold">📊 Laporan Keuangan</h3>
            <small class="text-muted">
                Ringkasan pendapatan dan pengeluaran operasional TravelGo
            </small>
        </div>

        <div class="d-flex gap-2">

            <button class="btn btn-outline-secondary">
                <i class="mdi mdi-calendar-outline"></i>
                {{ now()->translatedFormat('F Y') }}
            </button>

            <button onclick="window.print()" class="btn btn-primary">
                <i class="mdi mdi-printer"></i>
                Cetak Laporan
            </button>

        </div>

    </div>
</div>

@if (session('success'))
    <div class="alert alert-success" role="status">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif


{{-- STATISTIK --}}
<div class="row mb-4">

    {{-- PENDAPATAN --}}
    <div class="col-md-3 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <small class="text-muted">
                    Total Pendapatan
                </small>

                <h4 class="fw-bold text-success mb-1 mt-2">
                    Rp{{ number_format($totalIncome, 0, ',', '.') }}
                </h4>

                <small class="text-muted">
                    Dari transaksi Lunas/Selesai
                </small>

            </div>

        </div>

    </div>


    {{-- PENGELUARAN --}}
    <div class="col-md-3 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <small class="text-muted">
                    Pengeluaran Operasional
                </small>

                <h4 class="fw-bold text-danger mb-1 mt-2">
                    Rp{{ number_format($totalExpenses, 0, ',', '.') }}
                </h4>

                <small class="text-muted">
                    Total pengeluaran tercatat
                </small>

            </div>

        </div>

    </div>


    {{-- LABA BERSIH --}}
    <div class="col-md-3 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <small class="text-muted">
                    Laba Bersih
                </small>

                <h4 class="fw-bold text-primary mb-1 mt-2">
                    Rp{{ number_format($totalIncome - $totalExpenses, 0, ',', '.') }}
                </h4>

                <small class="text-primary">
                    Pendapatan - Pengeluaran
                </small>

            </div>

        </div>

    </div>


    {{-- TRANSAKSI --}}
    <div class="col-md-3 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <small class="text-muted">
                    Total Transaksi
                </small>

                <h4 class="fw-bold text-dark mb-1 mt-2">
                    {{ $totalTransactions }}
                </h4>

                <small class="text-success">
                    {{ $successfulTransactions }} transaksi berhasil
                </small>

            </div>

        </div>

    </div>

</div>


{{-- GRAFIK --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>
            <h5 class="mb-1">
                📈 Grafik Keuangan
            </h5>

            <small class="text-muted">
                Perbandingan pendapatan dan pengeluaran operasional
            </small>
        </div>

        <select class="form-select form-select-sm"
                style="width: 140px;">

            <option>6 Bulan</option>
            <option>1 Tahun</option>
            <option>3 Bulan</option>

        </select>

    </div>

    <div class="card-body">

        <div style="height: 350px;">
            <canvas id="keuanganChart"></canvas>
        </div>

    </div>

</div>


{{-- DETAIL KEUANGAN --}}
<div class="row mb-4">

    {{-- RINCIAN PENDAPATAN --}}
    <div class="col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    💰 Rincian Pendapatan
                </h5>

                <small class="text-muted">
                    Pendapatan berdasarkan destinasi wisata
                </small>

            </div>

            <div class="card-body">

                @forelse ($incomeBreakdown as $destination => $amount)
                    <div class="d-flex justify-content-between mb-3">
                        <span>{{ $destination }}</span>
                        <strong class="text-success">Rp{{ number_format((float) $amount, 0, ',', '.') }}</strong>
                    </div>
                @empty
                    <p class="text-muted">Belum ada pendapatan dari destinasi wisata.</p>
                @endforelse


                <hr>

                <div class="d-flex justify-content-between">

                    <strong>
                        Total Pendapatan
                    </strong>

                    <strong class="text-success">
                        Rp{{ number_format($totalIncome, 0, ',', '.') }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- RINCIAN PENGELUARAN --}}
    <div class="col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    💸 Rincian Pengeluaran
                </h5>

                <small class="text-muted">
                    Biaya operasional TravelGo
                </small>

            </div>

            <div class="card-body">

                @forelse ($expenseBreakdown as $category => $amount)
                    <div class="d-flex justify-content-between mb-3">
                        <span>{{ $category }}</span>
                        <strong class="text-danger">Rp{{ number_format((float) $amount, 0, ',', '.') }}</strong>
                    </div>
                @empty
                    <p class="text-muted">Belum ada rincian pengeluaran.</p>
                @endforelse


                <hr>

                <div class="d-flex justify-content-between">

                    <strong>
                        Total Pengeluaran
                    </strong>

                    <strong class="text-danger">
                        Rp{{ number_format($totalExpenses, 0, ',', '.') }}
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- RINGKASAN LABA --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-1">
            📋 Ringkasan Laba
        </h5>

        <small class="text-muted">
            Pengeluaran mengikuti catatan pengeluaran operasional.
        </small>

    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-4 mb-3">

                <small class="text-muted d-block">
                    Pendapatan
                </small>

                <h4 class="fw-bold text-success">
                    Rp{{ number_format($totalIncome, 0, ',', '.') }}
                </h4>

            </div>


            <div class="col-md-4 mb-3">

                <small class="text-muted d-block">
                    Pengeluaran
                </small>

                <h4 class="fw-bold text-danger">
                    Rp{{ number_format($totalExpenses, 0, ',', '.') }}
                </h4>

            </div>


            <div class="col-md-4 mb-3">

                <small class="text-muted d-block">
                    Laba Bersih
                </small>

                <h4 class="fw-bold text-primary">
                    Rp{{ number_format($totalIncome - $totalExpenses, 0, ',', '.') }}
                </h4>

            </div>

        </div>

    </div>

</div>


{{-- RIWAYAT PENGELUARAN --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h5 class="mb-1">
                🧾 Riwayat Pengeluaran
            </h5>

            <small class="text-muted">
                Daftar biaya operasional terbaru
            </small>

        </div>

        @if (auth()->user()->isFinance())
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createExpenseModal">
            <i class="mdi mdi-plus"></i>
            Tambah Pengeluaran
        </button>
        @endif

    </div>


    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th>No</th>
                    <th>ID Pengeluaran</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-end">
                        Nominal
                    </th>
                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse ($expenses as $expense)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-light text-dark">EXP-{{ str_pad((string) $expense->id, 5, '0', STR_PAD_LEFT) }}</span></td>
                        <td>{{ $expense->category }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->expense_date->translatedFormat('d M Y') }}</td>
                        <td>
                            <span class="badge {{ $expense->status === 'Dibayar' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $expense->status }}
                            </span>
                        </td>
                        <td class="text-end fw-bold text-danger">Rp{{ number_format((float) $expense->amount, 0, ',', '.') }}</td>
                        <td>
                            @if (auth()->user()->isFinance())
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editExpenseModal{{ $expense->id }}">Edit</button>
                                    <form method="POST" action="{{ route('finance.laporan-keuangan.pengeluaran.destroy', $expense) }}" onsubmit="return confirm('Hapus data pengeluaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data pengeluaran.</td>
                    </tr>
                @endforelse

            </tbody>

            <tfoot class="table-light">

                <tr>

                    <th colspan="6" class="text-end">
                        Total Pengeluaran
                    </th>

                    <th class="text-end text-danger">
                        Rp{{ number_format($totalExpenses, 0, ',', '.') }}
                    </th>
                    <th></th>

                </tr>

            </tfoot>

        </table>

    </div>

</div>
</div>

@if (auth()->user()->isFinance())
    <div class="modal fade" id="createExpenseModal" tabindex="-1" aria-labelledby="createExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('finance.laporan-keuangan.pengeluaran.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createExpenseModalLabel">Tambah Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="create-category">Kategori</label>
                    <input id="create-category" class="form-control mb-3" type="text" name="category" maxlength="100" value="{{ old('category') }}" required>
                    <label class="form-label" for="create-description">Keterangan</label>
                    <textarea id="create-description" class="form-control mb-3" name="description" maxlength="2000" required>{{ old('description') }}</textarea>
                    <label class="form-label" for="create-expense-date">Tanggal</label>
                    <input id="create-expense-date" class="form-control mb-3" type="date" name="expense_date" value="{{ old('expense_date', today()->toDateString()) }}" required>
                    <label class="form-label" for="create-status">Status</label>
                    <select id="create-status" class="form-select mb-3" name="status" required>
                        <option value="Pending" @selected(old('status') === 'Pending')>Pending</option>
                        <option value="Dibayar" @selected(old('status', 'Dibayar') === 'Dibayar')>Dibayar</option>
                    </select>
                    <label class="form-label" for="create-amount">Nominal (Rp)</label>
                    <input id="create-amount" class="form-control" type="number" name="amount" min="0.01" step="0.01" value="{{ old('amount') }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($expenses as $expense)
        <div class="modal fade" id="editExpenseModal{{ $expense->id }}" tabindex="-1" aria-labelledby="editExpenseModalLabel{{ $expense->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('finance.laporan-keuangan.pengeluaran.update', $expense) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editExpenseModalLabel{{ $expense->id }}">Edit Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label" for="edit-category-{{ $expense->id }}">Kategori</label>
                        <input id="edit-category-{{ $expense->id }}" class="form-control mb-3" type="text" name="category" maxlength="100" value="{{ $expense->category }}" required>
                        <label class="form-label" for="edit-description-{{ $expense->id }}">Keterangan</label>
                        <textarea id="edit-description-{{ $expense->id }}" class="form-control mb-3" name="description" maxlength="2000" required>{{ $expense->description }}</textarea>
                        <label class="form-label" for="edit-expense-date-{{ $expense->id }}">Tanggal</label>
                        <input id="edit-expense-date-{{ $expense->id }}" class="form-control mb-3" type="date" name="expense_date" value="{{ $expense->expense_date->toDateString() }}" required>
                        <label class="form-label" for="edit-status-{{ $expense->id }}">Status</label>
                        <select id="edit-status-{{ $expense->id }}" class="form-select mb-3" name="status" required>
                            <option value="Pending" @selected($expense->status === 'Pending')>Pending</option>
                            <option value="Dibayar" @selected($expense->status === 'Dibayar')>Dibayar</option>
                        </select>
                        <label class="form-label" for="edit-amount-{{ $expense->id }}">Nominal (Rp)</label>
                        <input id="edit-amount-{{ $expense->id }}" class="form-control" type="number" name="amount" min="0.01" step="0.01" value="{{ number_format((float) $expense->amount, 2, '.', '') }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endif

{{-- CHART.JS --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('keuanganChart');

    if (!canvas) return;

    new Chart(canvas, {

        type: 'line',

        data: {

            labels: @json($chartMonthLabels),

            datasets: [

                {
                    label: 'Pendapatan',

                    data: @json($incomeChartData),

                    borderWidth: 3,

                    tension: 0.4,

                    fill: true,

                    pointRadius: 5

                },

                {
                    label: 'Pengeluaran',

                    data: @json($expenseChartData),

                    borderWidth: 3,

                    tension: 0.4,

                    fill: true,

                    pointRadius: 5

                }

            ]

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

                            return context.dataset.label + ': Rp' +
                                new Intl.NumberFormat('id-ID')
                                .format(context.raw);

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
