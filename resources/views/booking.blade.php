@extends('layouts.app')
@section('title','Data Booking')

@section('content')

<style>
    .tg-stat{
        border-radius:18px;
        border:1px solid rgba(0,0,0,.04);
        transition:transform .25s ease, box-shadow .25s ease;
    }

    .tg-stat:hover{
        transform:translateY(-6px);
        box-shadow:0 18px 30px rgba(0,0,0,.08) !important;
    }

    .tg-stat .tg-icon{
        width:54px;
        height:54px;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:16px;
        font-size:1.4rem;
    }

    .tg-card{
        border-radius:18px;
        border:1px solid rgba(0,0,0,.04);
        overflow:hidden;
    }

    .tg-card .card-header{
        border-bottom:1px solid rgba(0,0,0,.05);
        border-radius:18px 18px 0 0 !important;
    }

    .tg-table thead th{
        text-transform:uppercase;
        font-size:.72rem;
        letter-spacing:.04em;
        color:#6c757d;
        border-bottom-width:1px;
        white-space:nowrap;
    }

    .tg-code{
        font-family:'Courier New', monospace;
        letter-spacing:.03em;
        background:#f1f3f9;
        border:1px dashed #c7cfe0;
        border-radius:8px;
        padding:.3em .7em;
        font-weight:700;
        color:#0d6efd;
        display:inline-block;
        font-size:.82rem;
    }

    .tg-badge{
        border-radius:20px;
        padding:.4em .85em;
        font-weight:600;
        font-size:.72rem;
        white-space:nowrap;
    }

    .tg-avatar{
        width:38px;
        height:38px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:700;
        color:#fff;
        font-size:.85rem;
        flex-shrink:0;
    }

    .tg-action-btn{
        width:34px;
        height:34px;
        border-radius:10px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:0;
    }

    .tg-peserta{
        background:#f1f3f9;
        border-radius:20px;
        padding:.25em .75em;
        font-size:.78rem;
        font-weight:600;
        color:#495057;
        display:inline-flex;
        align-items:center;
        gap:.3em;
        white-space:nowrap;
    }

    .tg-hero-mini{
        background:linear-gradient(135deg,#0f9b8e 0%,#0d6efd 100%);
        border-radius:20px;
        color:#fff;
        position:relative;
        overflow:hidden;
    }

    .tg-hero-mini::before{
        content:"";
        position:absolute;
        inset:0;
        background-image:radial-gradient(
            circle at 90% 10%,
            rgba(255,255,255,.18) 0,
            transparent 40%
        );
    }

    .tg-fade-in{
        animation:tgFadeIn .5s ease both;
    }

    .booking-choice-label{
        font-weight:800;
        color:#123b5d;
    }

    .booking-choice{
        font-weight:800;
        font-size:16px;
        line-height:1.4;
        border:2px solid #168ac0;
        background:#f5fbff;
        color:#082b49;
        min-height:48px;
    }

    .booking-choice:focus{
        border-color:#ff6b3d;
        box-shadow:0 0 0 3px rgba(255,107,61,.18);
    }

    .booking-choice option{
        font-weight:800;
        font-size:16px;
        color:#082b49;
    }

    @keyframes tgFadeIn{
        from{
            opacity:0;
            transform:translateY(10px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }
    }

    .modal-content{
        border-radius:20px !important;
        overflow:hidden;
    }

    .modal-header-booking{
        background:linear-gradient(135deg,#0f9b8e 0%,#0d6efd 100%);
        color:#fff;
    }

    .form-label{
        font-weight:600;
    }
</style>


<div class="container-fluid">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-lg mb-4 tg-hero-mini tg-fade-in">

        <div class="card-body p-4 p-md-5 d-flex flex-wrap justify-content-between align-items-center gap-3">

            <div style="position:relative;z-index:2;">

                <span class="badge bg-white bg-opacity-25 px-3 py-2 rounded-pill mb-2 d-inline-block">

                    <i class="mdi mdi-book-open-variant"></i>

                    Manajemen Booking

                </span>

                <h2 class="fw-bold mb-1">
                    📖 Data Booking
                </h2>

                <p class="mb-0 opacity-90">
                    Kelola seluruh pemesanan paket wisata pelanggan.
                </p>

            </div>


            {{-- TOMBOL TAMBAH BOOKING --}}

            <div style="position:relative;z-index:2;">

                <button
                    type="button"
                    class="btn btn-light fw-semibold px-4 py-2"
                    data-bs-toggle="modal"
                    data-bs-target="#tambahBookingModal"
                >

                    <i class="mdi mdi-plus-circle"></i>

                    Tambah Booking

                </button>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- ERROR --}}
    {{-- ===================================================== --}}

    @if ($errors->any())

        <div class="alert alert-danger shadow-sm">

            <div class="fw-bold mb-2">
                <i class="mdi mdi-alert-circle"></i>
                Terjadi kesalahan:
            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- MODAL TAMBAH BOOKING --}}
    {{-- ===================================================== --}}

    <div
        class="modal fade"
        id="tambahBookingModal"
        tabindex="-1"
        aria-labelledby="tambahBookingModalLabel"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg">


                {{-- MODAL HEADER --}}

                <div class="modal-header modal-header-booking">

                    <div>

                        <h5
                            class="modal-title fw-bold mb-1"
                            id="tambahBookingModalLabel"
                        >

                            <i class="mdi mdi-book-plus"></i>

                            Tambah Booking

                        </h5>

                        <small class="opacity-75">

                            Masukkan data pemesanan pelanggan

                        </small>

                    </div>


                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                {{-- MODAL BODY --}}

                <div class="modal-body p-4">

                    <form
                        method="POST"
                        action="{{ route('booking.store') }}"
                        id="formTambahBooking"
                    >

                        @csrf


                        <div class="row g-3">


                            {{-- KODE BOOKING --}}

                            <div class="col-md-6">

                                <label class="form-label booking-choice-label">

                                    Kode Booking

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="mdi mdi-barcode"></i>

                                    </span>

                                    <input
                                        type="text"
                                        name="kode_booking"
                                        class="form-control"
                                        placeholder="Contoh: BK-001"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- PELANGGAN --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Pelanggan

                                </label>

                                <select
                                    name="pelanggan_id"
                                    class="form-select booking-choice"
                                    required
                                >

                                    <option value="">

                                        Pilih pelanggan

                                    </option>

                                    @foreach ($pelanggans as $pelanggan)

                                        <option
                                            value="{{ $pelanggan->id }}"
                                        >

                                            {{ $pelanggan->nama_pelanggan }}

                                            @if($pelanggan->email)
                                                ({{ $pelanggan->email }})
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- PAKET WISATA --}}

                            <div class="col-md-6">

                                <label class="form-label booking-choice-label">

                                    Paket Wisata

                                </label>

                                <select
                                    name="paket_wisata"
                                    id="paket-wisata"
                                    class="form-select booking-choice"
                                    required
                                >

                                    <option value="">

                                        Pilih destinasi

                                    </option>

                                    @foreach ($destinasi as $item)

                                        <option
                                            value="{{ $item->nama_destinasi }}"
                                            data-harga="{{ $item->harga }}"
                                        >

                                            {{ $item->nama_destinasi }}

                                            -

                                            {{ $item->lokasi }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- TRANSPORTASI --}}

                            <div class="col-md-6">
                                <label class="form-label booking-choice-label">Transportasi</label>
                                <select name="transportasi_id" class="form-select booking-choice">
                                    <option value="">Pilih transportasi (opsional)</option>
                                    @foreach ($transportasis as $transportasi)
                                        <option value="{{ $transportasi->id }}">
                                            {{ $transportasi->nama_transportasi }} - {{ $transportasi->jenis_transportasi }} ({{ $transportasi->rute }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- TANGGAL BERANGKAT --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Tanggal Berangkat

                                </label>

                                <input
                                    type="date"
                                    name="tanggal_berangkat"
                                    class="form-control"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                >

                            </div>


                            {{-- JUMLAH PESERTA --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Jumlah Peserta

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="mdi mdi-account-group"></i>

                                    </span>

                                    <input
                                        type="number"
                                        name="jumlah_peserta"
                                        id="jumlah-peserta"
                                        min="1"
                                        value="1"
                                        class="form-control"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- TOTAL BIAYA --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Total Biaya

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        Rp

                                    </span>

                                    <input
                                        type="number"
                                        name="total_biaya"
                                        id="total-biaya"
                                        min="0"
                                        step="0.01"
                                        class="form-control"
                                        placeholder="0"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <div class="col-md-6">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select">
                                    <option value="">Belum dipilih</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="E-Wallet">E-Wallet</option>
                                    <option value="Kartu Kredit">Kartu Kredit</option>
                                </select>
                            </div>

                            <div class="col-md-12">

                                <label class="form-label">

                                    Status Booking

                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                    required
                                >

                                    <option value="Menunggu Pembayaran">

                                        🕐 Menunggu Pembayaran

                                    </option>

                                    <option value="Lunas">

                                        ✅ Lunas

                                    </option>

                                    <option value="Selesai">

                                        🎉 Selesai

                                    </option>

                                    <option value="Dibatalkan">

                                        ❌ Dibatalkan

                                    </option>

                                </select>

                            </div>


                        </div>

                    </form>

                </div>


                {{-- MODAL FOOTER --}}

                <div class="modal-footer bg-light">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >

                        <i class="mdi mdi-close"></i>

                        Batal

                    </button>


                    <button
                        type="submit"
                        form="formTambahBooking"
                        class="btn btn-primary px-4"
                    >

                        <i class="mdi mdi-content-save"></i>

                        Simpan Booking

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- STATISTIK --}}
    {{-- ===================================================== --}}

    <div class="row">


        {{-- TOTAL BOOKING --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Total Booking
                            </small>

                            <h2 class="fw-bold text-primary mb-0">

                                {{ $statistik['total'] }}

                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(13,110,253,.12);color:#0d6efd;"
                        >

                            <i class="mdi mdi-book-multiple"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- MENUNGGU PEMBAYARAN --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Menunggu Pembayaran
                            </small>

                            <h2 class="fw-bold text-warning mb-0">

                                {{ $statistik['menunggu'] }}

                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(255,193,7,.15);color:#e0a800;"
                        >

                            <i class="mdi mdi-timer-sand"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SELESAI --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Booking Selesai
                            </small>

                            <h2 class="fw-bold text-success mb-0">

                                {{ $statistik['selesai'] }}

                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(25,135,84,.12);color:#198754;"
                        >

                            <i class="mdi mdi-check-decagram"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DIBATALKAN --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Dibatalkan
                            </small>

                            <h2 class="fw-bold text-danger mb-0">

                                {{ $statistik['dibatalkan'] }}

                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(220,53,69,.12);color:#dc3545;"
                        >

                            <i class="mdi mdi-close-circle-outline"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- DATA BOOKING --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-sm tg-card">


        {{-- HEADER TABLE --}}

        <div class="card-header bg-white">

            <div class="row g-2 align-items-center">


                {{-- SEARCH --}}

                <div class="col-md-5">

                    <div class="input-group">

                        <span class="input-group-text bg-white border-end-0">

                            <i class="mdi mdi-magnify"></i>

                        </span>

                        <input
                            type="text"
                            id="searchBooking"
                            class="form-control border-start-0"
                            placeholder="Cari kode booking atau nama pelanggan..."
                        >

                    </div>

                </div>


                {{-- FILTER STATUS --}}

                <div class="col-md-3">

                    <select
                        id="filterStatus"
                        class="form-select"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option value="Menunggu Pembayaran">
                            Menunggu Pembayaran
                        </option>

                        <option value="Lunas">
                            Lunas
                        </option>

                        <option value="Selesai">
                            Selesai
                        </option>

                        <option value="Dibatalkan">
                            Dibatalkan
                        </option>

                    </select>

                </div>


                {{-- TOMBOL CARI --}}

                <div class="col-md-2">

                    <button
                        type="button"
                        id="btnCari"
                        class="btn btn-primary w-100"
                    >

                        <i class="mdi mdi-magnify"></i>

                        Cari

                    </button>

                </div>


                {{-- EXPORT --}}

                <div class="col-md-2">

                    <button
                        type="button"
                        class="btn btn-outline-secondary w-100"
                        onclick="window.print()"
                    >

                        <i class="mdi mdi-tray-arrow-down"></i>

                        Export

                    </button>

                </div>


            </div>

        </div>


        {{-- TABLE --}}

        <div class="table-responsive">

            <table class="table table-hover align-middle tg-table mb-0">

                <thead class="table-light">

                    <tr>

                        <th>No</th>

                        <th>Kode Booking</th>

                        <th>Pelanggan</th>

                        <th>Transportasi</th>

                        <th>Paket Wisata</th>

                        <th>Tanggal Berangkat</th>

                        <th>Peserta</th>

                        <th>Total Bayar</th>

                        <th>Status</th>

                        <th class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="bookingTable">

                    @forelse ($bookings as $booking)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                <span class="tg-code">

                                    {{ $booking->kode_booking }}

                                </span>

                            </td>


                            <td>

                                {{ $booking->pelanggan?->nama_pelanggan
                                    ?? $booking->nama_pelanggan }}

                            </td>

                            <td>
                                {{ $booking->transportasi?->nama_transportasi ?? '-' }}
                            </td>


                            <td>

                                {{ $booking->paket_wisata }}

                            </td>


                            <td>

                                {{ $booking->tanggal_berangkat->format('d M Y') }}

                            </td>


                            <td>

                                <span class="tg-peserta">

                                    <i class="mdi mdi-account-multiple-outline"></i>

                                    {{ $booking->jumlah_peserta }}

                                    Orang

                                </span>

                            </td>


                            <td class="fw-semibold">

                                Rp{{ number_format(
                                    $booking->total_biaya,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            <td>

                                @php

                                    $statusClass = match($booking->status) {

                                        'Lunas' =>
                                            'bg-success-subtle text-success',

                                        'Selesai' =>
                                            'bg-primary-subtle text-primary',

                                        'Dibatalkan' =>
                                            'bg-danger-subtle text-danger',

                                        default =>
                                            'bg-warning-subtle text-warning-emphasis'

                                    };

                                @endphp


                                <span class="tg-badge {{ $statusClass }}">

                                    {{ $booking->status }}

                                </span>

                            </td>


                            <td class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-outline-warning tg-action-btn"
                                    title="Edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editBookingModal{{ $booking->id }}"
                                >
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <form
                                    method="POST"
                                    action="{{ route('booking.destroy', $booking->id) }}"
                                    onsubmit="return confirm('Hapus booking ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger tg-action-btn"
                                        title="Hapus"
                                    >

                                        <i class="mdi mdi-trash-can-outline"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="10"
                                class="text-center text-muted py-4"
                            >

                                <i class="mdi mdi-database-off fs-2 d-block mb-2"></i>

                                Belum ada data booking.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- FOOTER --}}

        <div class="card-footer bg-white d-flex justify-content-between align-items-center">

            <span class="small text-muted">

                Menampilkan
                {{ $bookings->count() }}
                booking

            </span>


            <nav>

                <ul class="pagination pagination-sm mb-0">

                    <li class="page-item disabled">

                        <a class="page-link" href="#">
                            ‹
                        </a>

                    </li>

                    <li class="page-item active">

                        <a class="page-link" href="#">
                            1
                        </a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">
                            2
                        </a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">
                            3
                        </a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">
                            ›
                        </a>

                    </li>

                </ul>

            </nav>

        </div>

    </div>

</div>


@foreach ($bookings as $booking)
    <div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg"><div class="modal-content">
            <form method="POST" action="{{ route('booking.update', $booking->id) }}">
                @csrf @method('PUT')
                <div class="modal-header"><h5 class="modal-title">Edit Booking</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label class="form-label">Kode Booking</label><input name="kode_booking" value="{{ $booking->kode_booking }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label booking-choice-label">Pelanggan</label><select name="pelanggan_id" class="form-select booking-choice" required>@foreach ($pelanggans as $pelanggan)<option value="{{ $pelanggan->id }}" @selected($booking->pelanggan_id === $pelanggan->id)>{{ $pelanggan->nama_pelanggan }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label class="form-label booking-choice-label">Transportasi</label><select name="transportasi_id" class="form-select booking-choice"><option value="">Tanpa transportasi</option>@foreach ($transportasis as $transportasi)<option value="{{ $transportasi->id }}" @selected($booking->transportasi_id === $transportasi->id)>{{ $transportasi->nama_transportasi }} - {{ $transportasi->jenis_transportasi }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label class="form-label booking-choice-label">Paket Wisata</label><select name="paket_wisata" class="form-select booking-choice" required>@foreach ($destinasi as $item)<option value="{{ $item->nama_destinasi }}" @selected($booking->paket_wisata === $item->nama_destinasi)>{{ $item->nama_destinasi }}</option>@endforeach</select></div>
                    <div class="col-md-6"><label class="form-label">Tanggal Berangkat</label><input type="date" name="tanggal_berangkat" value="{{ $booking->tanggal_berangkat->format('Y-m-d') }}" class="form-control" required></div>
                    <div class="col-md-4"><label class="form-label">Jumlah Peserta</label><input type="number" name="jumlah_peserta" min="1" value="{{ $booking->jumlah_peserta }}" class="form-control" required></div>
                    <div class="col-md-4"><label class="form-label">Total Biaya</label><input type="number" name="total_biaya" min="0" step="0.01" value="{{ $booking->total_biaya }}" class="form-control" required></div>
                    <div class="col-md-4"><label class="form-label">Metode Pembayaran</label><select name="metode_pembayaran" class="form-select"><option value="">Belum dipilih</option><option value="Transfer Bank" @selected($booking->metode_pembayaran === 'Transfer Bank')>Transfer Bank</option><option value="QRIS" @selected($booking->metode_pembayaran === 'QRIS')>QRIS</option><option value="E-Wallet" @selected($booking->metode_pembayaran === 'E-Wallet')>E-Wallet</option><option value="Kartu Kredit" @selected($booking->metode_pembayaran === 'Kartu Kredit')>Kartu Kredit</option></select></div>
                    <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select" required><option @selected($booking->status === 'Menunggu Pembayaran')>Menunggu Pembayaran</option><option @selected($booking->status === 'Lunas')>Lunas</option><option @selected($booking->status === 'Selesai')>Selesai</option><option @selected($booking->status === 'Dibatalkan')>Dibatalkan</option></select></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary">Simpan Perubahan</button></div>
            </form>
        </div></div>
    </div>
@endforeach

{{-- ===================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ===================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================
       HITUNG OTOMATIS TOTAL BIAYA
    ========================================= */

    const paketWisata =
        document.getElementById('paket-wisata');

    const jumlahPeserta =
        document.getElementById('jumlah-peserta');

    const totalBiaya =
        document.getElementById('total-biaya');


    function hitungTotal() {

        if (!paketWisata || !jumlahPeserta || !totalBiaya) {
            return;
        }


        const selected =
            paketWisata.options[paketWisata.selectedIndex];


        const harga =
            parseFloat(selected?.dataset.harga || 0);


        const jumlah =
            parseInt(jumlahPeserta.value || 1);


        if (harga > 0) {

            totalBiaya.value =
                harga * jumlah;

        } else {

            totalBiaya.value = '';

        }

    }


    paketWisata?.addEventListener(
        'change',
        hitungTotal
    );


    jumlahPeserta?.addEventListener(
        'input',
        hitungTotal
    );


    /* =========================================
       SEARCH BOOKING
    ========================================= */

    const searchInput =
        document.getElementById('searchBooking');

    const filterStatus =
        document.getElementById('filterStatus');

    const btnCari =
        document.getElementById('btnCari');


    function filterBooking() {

        const keyword =
            searchInput.value.toLowerCase().trim();

        const status =
            filterStatus.value.toLowerCase();


        const rows =
            document.querySelectorAll(
                '#bookingTable tr'
            );


        rows.forEach(function(row) {

            const text =
                row.innerText.toLowerCase();


            const cocokKeyword =
                text.includes(keyword);


            const cocokStatus =
                status === '' ||
                text.includes(status);


            if (
                cocokKeyword &&
                cocokStatus
            ) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }

        });

    }


    btnCari?.addEventListener(
        'click',
        filterBooking
    );


    searchInput?.addEventListener(
        'keyup',
        function(event) {

            if (event.key === 'Enter') {

                filterBooking();

            }

        }
    );


    filterStatus?.addEventListener(
        'change',
        filterBooking
    );


});

</script>

@endsection
