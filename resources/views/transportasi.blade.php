@extends('layouts.app')

@section('title', 'Transportasi')

@section('content')

<style>
    /* =====================================================
       TRAVEL GO - TRANSPORTASI
       NAVY + GOLD THEME
       ===================================================== */

    :root {
        --travel-navy: #1E293B;
        --travel-navy-dark: #172033;
        --travel-navy-hover: #334155;
        --travel-gold: #F4C95D;
        --travel-gold-hover: #E8B93F;
        --travel-bg: #F8FAFC;
        --travel-text: #1E293B;
        --travel-muted: #64748B;
        --travel-border: #E2E8F0;
        --travel-white: #FFFFFF;
        --travel-green: #3FA79A;
        --travel-red: #FF6B4A;
    }

    /* =====================================================
       BACKGROUND UTAMA
       ===================================================== */

    html,
    body {
        background: var(--travel-bg) !important;
    }

    .page-body-wrapper {
        background: var(--travel-navy) !important;
    }

    .sidebar,
    .sidebar-offcanvas,
    #sidebar {
        background: var(--travel-navy) !important;
    }

    .main-panel {
        background: var(--travel-bg) !important;
        min-height: 100vh;
    }

    .content-wrapper {
        background: var(--travel-bg) !important;
        min-height: 100vh;
    }

    .container-fluid {
        background: var(--travel-bg) !important;
    }

    /* =====================================================
       WRAPPER
       ===================================================== */

    .tr-wrapper {
        padding: 25px;
        font-family: 'Inter', sans-serif;
        background: var(--travel-bg);
        min-height: calc(100vh - 70px);
    }

    /* =====================================================
       HEADER
       ===================================================== */

    .tr-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .tr-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--travel-text);
        margin: 0;
    }

    .tr-title i {
        color: var(--travel-gold);
    }

    .tr-subtitle {
        color: var(--travel-muted);
        margin-top: 5px;
        font-size: 14px;
    }

    /* =====================================================
       STATISTIK
       ===================================================== */

    .tr-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .tr-stat-card {
        background: var(--travel-white);
        border: 1px solid var(--travel-border);
        border-radius: 12px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(30, 41, 59, .04);
        transition: .2s ease;
    }

    .tr-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(30, 41, 59, .08);
    }

    .tr-stat-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--stat-color);
    }

    .tr-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        background: var(--stat-bg);
        color: var(--stat-color);
        flex-shrink: 0;
    }

    .tr-stat-label {
        font-size: 12px;
        color: var(--travel-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 3px;
    }

    .tr-stat-number {
        font-size: 25px;
        font-weight: 800;
        color: var(--travel-text);
        line-height: 1.1;
    }

    /* =====================================================
       BUTTON
       ===================================================== */

    .tr-btn {
        border: none;
        border-radius: 8px;
        padding: 10px 17px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .tr-btn:hover {
        transform: translateY(-1px);
    }

    .tr-btn-add {
        background: var(--travel-gold);
        color: var(--travel-navy);
        box-shadow: 0 3px 8px rgba(244, 201, 93, .2);
    }

    .tr-btn-add:hover {
        background: var(--travel-gold-hover);
        color: var(--travel-navy);
    }

    .tr-btn-edit {
        background: var(--travel-green);
        color: white;
    }

    .tr-btn-edit:hover {
        background: #328C80;
        color: white;
    }

    .tr-btn-delete {
        background: var(--travel-red);
        color: white;
    }

    .tr-btn-delete:hover {
        background: #E65338;
        color: white;
    }

    /* =====================================================
       TABLE
       ===================================================== */

    .tr-card {
        background: var(--travel-white);
        border: 1px solid var(--travel-border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(30, 41, 59, .05);
    }

    .tr-table {
        width: 100%;
        border-collapse: collapse;
    }

    .tr-table th {
        background: var(--travel-navy);
        color: var(--travel-gold);
        padding: 14px;
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 2px solid var(--travel-gold);
    }

    .tr-table td {
        padding: 14px;
        border-bottom: 1px solid var(--travel-border);
        font-size: 14px;
        vertical-align: middle;
        color: var(--travel-text);
    }

    .tr-table tbody tr {
        transition: .15s ease;
    }

    .tr-table tbody tr:hover {
        background: #FFFCF2;
    }

    .tr-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* =====================================================
       GAMBAR
       ===================================================== */

    .tr-image {
        width: 75px;
        height: 55px;
        object-fit: cover;
        border-radius: 7px;
        background: #F1F5F9;
        border: 1px solid var(--travel-border);
    }

    /* =====================================================
       STATUS
       ===================================================== */

    .tr-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }

    .tr-status-active {
        background: #E2F5F2;
        color: #267D72;
    }

    .tr-status-off {
        background: #FFF0ED;
        color: #D94C31;
    }

    /* =====================================================
       AKSI
       ===================================================== */

    .tr-actions {
        display: flex;
        gap: 6px;
    }

    .tr-actions form {
        margin: 0;
    }

    .tr-actions .tr-btn {
        width: 38px;
        height: 36px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* =====================================================
       MODAL
       ===================================================== */

    .tr-modal .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(30, 41, 59, .2);
    }

    .tr-modal .modal-header {
        background: var(--travel-navy);
        color: var(--travel-gold);
        border-bottom: 2px solid var(--travel-gold);
    }

    .tr-modal .modal-title {
        font-weight: 700;
    }

    .tr-modal .modal-body {
        background: #FFFFFF;
    }

    .tr-modal .modal-footer {
        background: var(--travel-bg);
        border-top: 1px solid var(--travel-border);
    }

    .tr-form-label {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--travel-text);
    }

    .tr-form-control {
        border-radius: 7px;
        border: 1px solid #CBD5E1;
        padding: 10px 12px;
        color: var(--travel-text);
        background: #FFFFFF;
    }

    .tr-form-control:focus {
        border-color: var(--travel-gold);
        box-shadow: 0 0 0 3px rgba(244, 201, 93, .18);
    }

    /* =====================================================
       EMPTY
       ===================================================== */

    .tr-empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--travel-muted);
    }

    .tr-empty > i {
        color: var(--travel-gold);
    }

    .tr-empty h5 {
        color: var(--travel-text);
        font-weight: 700;
    }

    /* =====================================================
       ALERT
       ===================================================== */

    .tr-wrapper .alert {
        border-radius: 9px;
        border: none;
        margin-bottom: 20px;
    }

    /* =====================================================
       RESPONSIVE
       ===================================================== */

    @media(max-width: 992px) {

        .tr-stats {
            grid-template-columns: 1fr;
        }

    }

    @media(max-width: 768px) {

        .tr-wrapper {
            padding: 15px;
        }

        .tr-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .tr-header .tr-btn {
            width: 100%;
        }

        .tr-card {
            overflow-x: auto;
        }

        .tr-table {
            min-width: 1100px;
        }

    }
</style>


<div class="tr-wrapper">

    {{-- =====================================================
         HEADER
         ===================================================== --}}

    <div class="tr-header">

        <div>

            <h2 class="tr-title">

                <i class="mdi mdi-bus"></i>

                Transportasi

            </h2>

            <div class="tr-subtitle">
                Kelola transportasi TravelGo
            </div>

        </div>


        <button
            class="tr-btn tr-btn-add"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">

            <i class="mdi mdi-plus"></i>

            Tambah Transportasi

        </button>

    </div>


    {{-- =====================================================
         ALERT SUCCESS
         ===================================================== --}}

    @if(session('success'))

        <div class="alert alert-success">

            <i class="mdi mdi-check-circle-outline"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         ALERT ERROR
         ===================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>

                <i class="mdi mdi-alert-circle-outline"></i>

                Terjadi kesalahan:

            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         STATISTIK
         ===================================================== --}}

    <div class="tr-stats">


        {{-- TOTAL --}}

        <div
            class="tr-stat-card"
            style="
                --stat-color:#F4C95D;
                --stat-bg:#FFF8DD;
            ">

            <div class="tr-stat-icon">

                <i class="mdi mdi-bus"></i>

            </div>

            <div>

                <div class="tr-stat-label">
                    Total Transportasi
                </div>

                <div class="tr-stat-number">
                    {{ $transportasi->count() }}
                </div>

            </div>

        </div>


        {{-- AKTIF --}}

        <div
            class="tr-stat-card"
            style="
                --stat-color:#3FA79A;
                --stat-bg:#E2F5F2;
            ">

            <div class="tr-stat-icon">

                <i class="mdi mdi-check-circle-outline"></i>

            </div>

            <div>

                <div class="tr-stat-label">
                    Transportasi Aktif
                </div>

                <div class="tr-stat-number">

                    {{ $transportasi->where('status', 'aktif')->count() }}

                </div>

            </div>

        </div>


        {{-- NONAKTIF --}}

        <div
            class="tr-stat-card"
            style="
                --stat-color:#FF6B4A;
                --stat-bg:#FFF0ED;
            ">

            <div class="tr-stat-icon">

                <i class="mdi mdi-close-circle-outline"></i>

            </div>

            <div>

                <div class="tr-stat-label">
                    Transportasi Nonaktif
                </div>

                <div class="tr-stat-number">

                    {{ $transportasi->where('status', 'nonaktif')->count() }}

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         TABLE TRANSPORTASI
         ===================================================== --}}

    <div class="tr-card">

        @if($transportasi->count() > 0)

            <table class="tr-table">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Gambar</th>
                        <th>Transportasi</th>
                        <th>Jenis</th>
                        <th>Rute</th>
                        <th>Harga</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($transportasi as $item)

                        <tr>


                            {{-- NO --}}

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- GAMBAR --}}

                            <td>

                                @if($item->gambar)

                                    <img
                                        src="{{ $item->gambar }}"
                                        class="tr-image"
                                        alt="{{ $item->nama_transportasi }}">

                                @else

                                    <div
                                        class="tr-image d-flex align-items-center justify-content-center">

                                        <i
                                            class="mdi mdi-bus"
                                            style="
                                                font-size:24px;
                                                color:#94A3B8;
                                            ">
                                        </i>

                                    </div>

                                @endif

                            </td>


                            {{-- NAMA --}}

                            <td>

                                <strong>
                                    {{ $item->nama_transportasi }}
                                </strong>

                                @if($item->deskripsi)

                                    <div
                                        style="
                                            font-size:12px;
                                            color:#64748B;
                                            margin-top:4px;
                                        ">

                                        {{ Str::limit($item->deskripsi, 45) }}

                                    </div>

                                @endif

                            </td>


                            {{-- JENIS --}}

                            <td>

                                <span
                                    style="
                                        background:#F8FAFC;
                                        border:1px solid #E2E8F0;
                                        border-radius:6px;
                                        padding:5px 9px;
                                        font-size:12px;
                                        font-weight:600;
                                    ">

                                    {{ $item->jenis_transportasi ?? '-' }}

                                </span>

                            </td>


                            {{-- RUTE --}}

                            <td>

                                <i
                                    class="mdi mdi-map-marker"
                                    style="color:#F4C95D;">
                                </i>

                                {{ $item->rute ?? '-' }}

                            </td>


                            {{-- HARGA --}}

                            <td>

                                <strong>

                                    Rp{{ number_format($item->harga, 0, ',', '.') }}

                                </strong>

                            </td>


                            {{-- KAPASITAS --}}

                            <td>

                                <i
                                    class="mdi mdi-account-group"
                                    style="color:#F4C95D;">
                                </i>

                                {{ $item->kapasitas }} Orang

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if($item->status === 'aktif')

                                    <span class="tr-status tr-status-active">

                                        Aktif

                                    </span>

                                @else

                                    <span class="tr-status tr-status-off">

                                        Nonaktif

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}

                            <td>

                                <div class="tr-actions">


                                    {{-- EDIT --}}

                                    <button
                                        type="button"
                                        class="tr-btn tr-btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">

                                        <i class="mdi mdi-pencil"></i>

                                    </button>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('transportasi.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transportasi ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="tr-btn tr-btn-delete">

                                            <i class="mdi mdi-delete"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            {{-- EMPTY --}}

            <div class="tr-empty">

                <i
                    class="mdi mdi-bus-alert"
                    style="font-size:50px;">
                </i>

                <h5 class="mt-3">
                    Belum Ada Transportasi
                </h5>

                <p>
                    Silakan tambahkan transportasi pertama.
                </p>

                <button
                    class="tr-btn tr-btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">

                    <i class="mdi mdi-plus"></i>

                    Tambah Transportasi

                </button>

            </div>

        @endif

    </div>

</div>



{{-- =====================================================
     MODAL TAMBAH TRANSPORTASI
     ===================================================== --}}

<div
    class="modal fade tr-modal"
    id="modalTambah"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="mdi mdi-plus-circle"></i>

                    Tambah Transportasi

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            {{-- FORM --}}

            <form
                action="{{ route('transportasi.store') }}"
                method="POST">

                @csrf


                <div class="modal-body">

                    <div class="row g-3">


                        {{-- NAMA --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Nama Transportasi
                            </label>

                            <input
                                type="text"
                                name="nama_transportasi"
                                class="form-control tr-form-control"
                                placeholder="Contoh: Travel Bali Express"
                                required>

                        </div>


                        {{-- JENIS --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Jenis Transportasi
                            </label>

                            <select
                                name="jenis_transportasi"
                                class="form-select tr-form-control"
                                required>

                                <option value="">
                                    Pilih jenis transportasi
                                </option>

                                <option value="Bus">
                                    Bus
                                </option>

                                <option value="Travel">
                                    Travel
                                </option>

                                <option value="Kereta">
                                    Kereta
                                </option>

                                <option value="Pesawat">
                                    Pesawat
                                </option>

                                <option value="Kapal">
                                    Kapal
                                </option>

                                <option value="Mobil">
                                    Mobil
                                </option>

                            </select>

                        </div>


                        {{-- RUTE --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Rute
                            </label>

                            <input
                                type="text"
                                name="rute"
                                class="form-control tr-form-control"
                                placeholder="Contoh: Jakarta - Bali">

                        </div>


                        {{-- HARGA --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Harga
                            </label>

                            <input
                                type="number"
                                name="harga"
                                class="form-control tr-form-control"
                                placeholder="500000"
                                min="0"
                                required>

                        </div>


                        {{-- KAPASITAS --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Kapasitas
                            </label>

                            <input
                                type="number"
                                name="kapasitas"
                                class="form-control tr-form-control"
                                placeholder="40"
                                min="1"
                                required>

                        </div>


                        {{-- GAMBAR --}}

                        <div class="col-md-12">

                            <label class="tr-form-label">
                                URL Gambar
                            </label>

                            <input
                                type="text"
                                name="gambar"
                                class="form-control tr-form-control"
                                placeholder="https://contoh.com/transportasi.jpg">

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="col-md-12">

                            <label class="tr-form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control tr-form-control"
                                rows="4"
                                placeholder="Deskripsi transportasi..."></textarea>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select tr-form-control"
                                required>

                                <option value="aktif">
                                    Aktif
                                </option>

                                <option value="nonaktif">
                                    Nonaktif
                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="tr-btn tr-btn-add">

                        <i class="mdi mdi-content-save"></i>

                        Simpan Transportasi

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =====================================================
     MODAL EDIT TRANSPORTASI
     ===================================================== --}}

@foreach($transportasi as $item)

<div
    class="modal fade tr-modal"
    id="modalEdit{{ $item->id }}"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="mdi mdi-pencil"></i>

                    Edit Transportasi

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            {{-- FORM --}}

            <form
                action="{{ route('transportasi.update', $item->id) }}"
                method="POST">

                @csrf

                @method('PUT')


                <div class="modal-body">

                    <div class="row g-3">


                        {{-- NAMA --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Nama Transportasi
                            </label>

                            <input
                                type="text"
                                name="nama_transportasi"
                                class="form-control tr-form-control"
                                value="{{ $item->nama_transportasi }}"
                                required>

                        </div>


                        {{-- JENIS --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Jenis Transportasi
                            </label>

                            <select
                                name="jenis_transportasi"
                                class="form-select tr-form-control"
                                required>

                                <option
                                    value="Bus"
                                    {{ $item->jenis_transportasi == 'Bus' ? 'selected' : '' }}>
                                    Bus
                                </option>

                                <option
                                    value="Travel"
                                    {{ $item->jenis_transportasi == 'Travel' ? 'selected' : '' }}>
                                    Travel
                                </option>

                                <option
                                    value="Kereta"
                                    {{ $item->jenis_transportasi == 'Kereta' ? 'selected' : '' }}>
                                    Kereta
                                </option>

                                <option
                                    value="Pesawat"
                                    {{ $item->jenis_transportasi == 'Pesawat' ? 'selected' : '' }}>
                                    Pesawat
                                </option>

                                <option
                                    value="Kapal"
                                    {{ $item->jenis_transportasi == 'Kapal' ? 'selected' : '' }}>
                                    Kapal
                                </option>

                                <option
                                    value="Mobil"
                                    {{ $item->jenis_transportasi == 'Mobil' ? 'selected' : '' }}>
                                    Mobil
                                </option>

                            </select>

                        </div>


                        {{-- RUTE --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Rute
                            </label>

                            <input
                                type="text"
                                name="rute"
                                class="form-control tr-form-control"
                                value="{{ $item->rute }}">

                        </div>


                        {{-- HARGA --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Harga
                            </label>

                            <input
                                type="number"
                                name="harga"
                                class="form-control tr-form-control"
                                value="{{ $item->harga }}"
                                min="0"
                                required>

                        </div>


                        {{-- KAPASITAS --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Kapasitas
                            </label>

                            <input
                                type="number"
                                name="kapasitas"
                                class="form-control tr-form-control"
                                value="{{ $item->kapasitas }}"
                                min="1"
                                required>

                        </div>


                        {{-- GAMBAR --}}

                        <div class="col-md-12">

                            <label class="tr-form-label">
                                URL Gambar
                            </label>

                            <input
                                type="text"
                                name="gambar"
                                class="form-control tr-form-control"
                                value="{{ $item->gambar }}">

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="col-md-12">

                            <label class="tr-form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control tr-form-control"
                                rows="4">{{ $item->deskripsi }}</textarea>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6">

                            <label class="tr-form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select tr-form-control"
                                required>

                                <option
                                    value="aktif"
                                    {{ $item->status == 'aktif' ? 'selected' : '' }}>

                                    Aktif

                                </option>

                                <option
                                    value="nonaktif"
                                    {{ $item->status == 'nonaktif' ? 'selected' : '' }}>

                                    Nonaktif

                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="tr-btn tr-btn-edit">

                        <i class="mdi mdi-content-save"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach

@endsection
