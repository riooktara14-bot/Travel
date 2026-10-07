@extends('layouts.app')

@section('title', 'Hotel')

@section('content')

<style>
    /* =========================================
       TRAVEL GO - HOTEL PAGE
       NAVY + GOLD THEME
       ========================================= */

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


    /* =========================================
       BACKGROUND UTAMA
       ========================================= */

    html,
    body {
        background: var(--travel-bg) !important;
    }

    .page-body-wrapper {
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


    /* =========================================
       AREA SIDEBAR
       ========================================= */

    #sidebar,
    .sidebar,
    .sidebar-offcanvas {
        background: var(--travel-navy) !important;
    }


    /* =========================================
       HOTEL WRAPPER
       ========================================= */

    .hotel-wrapper {
        padding: 25px;
        font-family: 'Inter', sans-serif;
        background: var(--travel-bg);
        min-height: calc(100vh - 70px);
    }


    /* =========================================
       HEADER
       ========================================= */

    .hotel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .hotel-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--travel-text);
        margin: 0;
    }

    .hotel-subtitle {
        color: var(--travel-muted);
        margin-top: 5px;
        font-size: 14px;
    }


    /* =========================================
       STATISTIK
       ========================================= */

    .hotel-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .hotel-stat-card {
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

    .hotel-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(30, 41, 59, .08);
    }

    .hotel-stat-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--stat-color);
    }

    .hotel-stat-icon {
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

    .hotel-stat-label {
        font-size: 12px;
        color: var(--travel-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 3px;
    }

    .hotel-stat-number {
        font-size: 25px;
        font-weight: 800;
        color: var(--travel-text);
        line-height: 1.1;
    }


    /* =========================================
       BUTTON
       ========================================= */

    .hotel-btn {
        border: none;
        border-radius: 8px;
        padding: 10px 17px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .hotel-btn:hover {
        transform: translateY(-1px);
    }

    .hotel-btn-add {
        background: var(--travel-gold);
        color: var(--travel-navy);
        box-shadow: 0 3px 8px rgba(244, 201, 93, .2);
    }

    .hotel-btn-add:hover {
        background: var(--travel-gold-hover);
        color: var(--travel-navy);
    }

    .hotel-btn-edit {
        background: var(--travel-green);
        color: white;
    }

    .hotel-btn-edit:hover {
        background: #328C80;
        color: white;
    }

    .hotel-btn-delete {
        background: var(--travel-red);
        color: white;
    }

    .hotel-btn-delete:hover {
        background: #E65338;
        color: white;
    }


    /* =========================================
       TABLE CARD
       ========================================= */

    .hotel-card {
        background: var(--travel-white);
        border: 1px solid var(--travel-border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(30, 41, 59, .05);
    }

    .hotel-table {
        width: 100%;
        border-collapse: collapse;
    }

    .hotel-table th {
        background: var(--travel-navy);
        color: var(--travel-gold);
        padding: 14px;
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        border-bottom: 2px solid var(--travel-gold);
    }

    .hotel-table td {
        padding: 14px;
        border-bottom: 1px solid var(--travel-border);
        font-size: 14px;
        vertical-align: middle;
        color: var(--travel-text);
    }

    .hotel-table tbody tr {
        transition: .15s ease;
    }

    .hotel-table tbody tr:hover {
        background: #FFFCF2;
    }

    .hotel-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================
       GAMBAR HOTEL
       ========================================= */

    .hotel-image {
        width: 75px;
        height: 55px;
        object-fit: cover;
        border-radius: 7px;
        background: #F1F5F9;
        border: 1px solid var(--travel-border);
    }


    /* =========================================
       STATUS
       ========================================= */

    .hotel-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }

    .hotel-status-active {
        background: #E2F5F2;
        color: #267D72;
    }

    .hotel-status-off {
        background: #FFF0ED;
        color: #D94C31;
    }


    /* =========================================
       RATING
       ========================================= */

    .hotel-rating {
        color: var(--travel-gold-hover);
        font-weight: 700;
    }

    .hotel-rating i {
        color: var(--travel-gold);
    }


    /* =========================================
       ACTION
       ========================================= */

    .hotel-actions {
        display: flex;
        gap: 6px;
    }

    .hotel-actions form {
        margin: 0;
    }

    .hotel-actions .hotel-btn {
        width: 38px;
        height: 36px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* =========================================
       MODAL
       ========================================= */

    .hotel-modal .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(30, 41, 59, .2);
    }

    .hotel-modal .modal-header {
        background: var(--travel-navy);
        color: var(--travel-gold);
        border-bottom: 2px solid var(--travel-gold);
    }

    .hotel-modal .modal-title {
        font-weight: 700;
    }

    .hotel-modal .modal-body {
        background: #FFFFFF;
    }

    .hotel-modal .modal-footer {
        background: #F8FAFC;
        border-top: 1px solid var(--travel-border);
    }

    .hotel-form-label {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--travel-text);
    }

    .hotel-form-control {
        border-radius: 7px;
        border: 1px solid #CBD5E1;
        padding: 10px 12px;
        color: var(--travel-text);
        background: #FFFFFF;
    }

    .hotel-form-control:focus {
        border-color: var(--travel-gold);
        box-shadow: 0 0 0 3px rgba(244, 201, 93, .18);
    }


    /* =========================================
       EMPTY STATE
       ========================================= */

    .hotel-empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--travel-muted);
    }

    .hotel-empty > i {
        color: var(--travel-gold);
    }

    .hotel-empty h5 {
        color: var(--travel-text);
        font-weight: 700;
    }


    /* =========================================
       ALERT
       ========================================= */

    .hotel-wrapper .alert {
        border-radius: 9px;
        border: none;
        margin-bottom: 20px;
    }


    /* =========================================
       RESPONSIVE
       ========================================= */

    @media(max-width: 992px) {

        .hotel-stats {
            grid-template-columns: 1fr 1fr;
        }

    }


    @media(max-width: 768px) {

        .hotel-wrapper {
            padding: 15px;
        }

        .hotel-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .hotel-header .hotel-btn {
            width: 100%;
        }

        .hotel-stats {
            grid-template-columns: 1fr;
        }

        .hotel-card {
            overflow-x: auto;
        }

        .hotel-table {
            min-width: 1050px;
        }

    }
</style>


<div class="hotel-wrapper">

    {{-- =========================================
         HEADER
         ========================================= --}}

    <div class="hotel-header">

        <div>

            <h2 class="hotel-title">
                <i class="mdi mdi-hotel"
                   style="color:#F4C95D;"></i>
                Hotel
            </h2>

            <div class="hotel-subtitle">
                Kelola data hotel TravelGo
            </div>

        </div>


        <button
            class="hotel-btn hotel-btn-add"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahHotel">

            <i class="mdi mdi-plus"></i>
            Tambah Hotel

        </button>

    </div>


    {{-- =========================================
         SUCCESS
         ========================================= --}}

    @if(session('success'))

        <div class="alert alert-success">
            <i class="mdi mdi-check-circle-outline"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- =========================================
         VALIDATION ERROR
         ========================================= --}}

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


    {{-- =========================================
         STATISTIK
         ========================================= --}}

    <div class="hotel-stats">


        {{-- TOTAL HOTEL --}}

        <div
            class="hotel-stat-card"
            style="
                --stat-color:#F4C95D;
                --stat-bg:#FFF8DD;
            ">

            <div class="hotel-stat-icon">

                <i class="mdi mdi-office-building"></i>

            </div>

            <div>

                <div class="hotel-stat-label">
                    Total Hotel
                </div>

                <div class="hotel-stat-number">
                    {{ $totalHotel }}
                </div>

            </div>

        </div>


        {{-- HOTEL AKTIF --}}

        <div
            class="hotel-stat-card"
            style="
                --stat-color:#3FA79A;
                --stat-bg:#E2F5F2;
            ">

            <div class="hotel-stat-icon">

                <i class="mdi mdi-check-circle-outline"></i>

            </div>

            <div>

                <div class="hotel-stat-label">
                    Hotel Aktif
                </div>

                <div class="hotel-stat-number">
                    {{ $totalAktif }}
                </div>

            </div>

        </div>


        {{-- HOTEL NONAKTIF --}}

        <div
            class="hotel-stat-card"
            style="
                --stat-color:#FF6B4A;
                --stat-bg:#FFF0ED;
            ">

            <div class="hotel-stat-icon">

                <i class="mdi mdi-close-circle-outline"></i>

            </div>

            <div>

                <div class="hotel-stat-label">
                    Hotel Nonaktif
                </div>

                <div class="hotel-stat-number">
                    {{ $totalNonaktif }}
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================
         TABLE
         ========================================= --}}

    <div class="hotel-card">

        @if($hotel->count() > 0)

            <table class="hotel-table">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Hotel</th>
                        <th>Lokasi</th>
                        <th>Harga / Malam</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($hotel as $item)

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
                                        class="hotel-image"
                                        alt="{{ $item->nama_hotel }}">

                                @else

                                    <div
                                        class="hotel-image d-flex align-items-center justify-content-center">

                                        <i
                                            class="mdi mdi-image-outline"
                                            style="font-size:24px;color:#94A3B8;">
                                        </i>

                                    </div>

                                @endif

                            </td>


                            {{-- NAMA HOTEL --}}

                            <td>

                                <strong>
                                    {{ $item->nama_hotel }}
                                </strong>

                                @if($item->deskripsi)

                                    <div
                                        style="
                                            font-size:12px;
                                            color:#64748B;
                                            margin-top:4px;
                                        ">

                                        {{ Str::limit($item->deskripsi, 55) }}

                                    </div>

                                @endif

                            </td>


                            {{-- LOKASI --}}

                            <td>

                                <i
                                    class="mdi mdi-map-marker"
                                    style="color:#F4C95D;">
                                </i>

                                {{ $item->lokasi }}

                            </td>


                            {{-- HARGA --}}

                            <td>

                                <strong style="color:#1E293B;">

                                    Rp{{ number_format($item->harga_per_malam, 0, ',', '.') }}

                                </strong>

                                <div
                                    style="
                                        font-size:11px;
                                        color:#64748B;
                                    ">

                                    per malam

                                </div>

                            </td>


                            {{-- RATING --}}

                            <td>

                                <span class="hotel-rating">

                                    <i class="mdi mdi-star"></i>

                                    {{ number_format($item->rating, 1) }}

                                </span>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if($item->status == 'aktif')

                                    <span class="hotel-status hotel-status-active">
                                        Aktif
                                    </span>

                                @else

                                    <span class="hotel-status hotel-status-off">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}

                            <td>

                                <div class="hotel-actions">

                                    {{-- EDIT --}}

                                    <button
                                        class="hotel-btn hotel-btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditHotel{{ $item->id }}">

                                        <i class="mdi mdi-pencil"></i>

                                    </button>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('hotel.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus hotel ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="hotel-btn hotel-btn-delete">

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

            <div class="hotel-empty">

                <i
                    class="mdi mdi-office-building-outline"
                    style="font-size:50px;">
                </i>

                <h5 class="mt-3">
                    Belum Ada Hotel
                </h5>

                <p>
                    Silakan tambahkan hotel pertama.
                </p>

                <button
                    class="hotel-btn hotel-btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahHotel">

                    <i class="mdi mdi-plus"></i>
                    Tambah Hotel

                </button>

            </div>

        @endif

    </div>

</div>



{{-- =========================================================
     MODAL TAMBAH HOTEL
     ========================================================= --}}

<div
    class="modal fade hotel-modal"
    id="modalTambahHotel"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="mdi mdi-plus-circle"></i>
                    Tambah Hotel

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <form
                action="{{ route('hotel.store') }}"
                method="POST">

                @csrf


                <div class="modal-body">

                    <div class="row g-3">


                        {{-- NAMA HOTEL --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Nama Hotel
                            </label>

                            <input
                                type="text"
                                name="nama_hotel"
                                class="form-control hotel-form-control"
                                placeholder="Contoh: Hotel Santika Bali"
                                required>

                        </div>


                        {{-- LOKASI --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Lokasi
                            </label>

                            <input
                                type="text"
                                name="lokasi"
                                class="form-control hotel-form-control"
                                placeholder="Contoh: Kuta, Bali"
                                required>

                        </div>


                        {{-- HARGA --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Harga Per Malam
                            </label>

                            <input
                                type="number"
                                name="harga_per_malam"
                                class="form-control hotel-form-control"
                                placeholder="750000"
                                min="0"
                                required>

                        </div>


                        {{-- RATING --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Rating
                            </label>

                            <input
                                type="number"
                                name="rating"
                                class="form-control hotel-form-control"
                                placeholder="4.5"
                                min="0"
                                max="5"
                                step="0.1"
                                required>

                        </div>


                        {{-- GAMBAR --}}

                        <div class="col-md-12">

                            <label class="hotel-form-label">
                                URL Gambar
                            </label>

                            <input
                                type="text"
                                name="gambar"
                                class="form-control hotel-form-control"
                                placeholder="https://contoh.com/hotel.jpg">

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="col-md-12">

                            <label class="hotel-form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control hotel-form-control"
                                rows="4"
                                placeholder="Deskripsi hotel..."></textarea>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select hotel-form-control">

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


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="hotel-btn hotel-btn-add">

                        <i class="mdi mdi-content-save"></i>

                        Simpan Hotel

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =========================================================
     MODAL EDIT HOTEL
     ========================================================= --}}

@foreach($hotel as $item)

<div
    class="modal fade hotel-modal"
    id="modalEditHotel{{ $item->id }}"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="mdi mdi-pencil"></i>
                    Edit Hotel

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <form
                action="{{ route('hotel.update', $item->id) }}"
                method="POST">

                @csrf
                @method('PUT')


                <div class="modal-body">

                    <div class="row g-3">


                        {{-- NAMA HOTEL --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Nama Hotel
                            </label>

                            <input
                                type="text"
                                name="nama_hotel"
                                class="form-control hotel-form-control"
                                value="{{ $item->nama_hotel }}"
                                required>

                        </div>


                        {{-- LOKASI --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Lokasi
                            </label>

                            <input
                                type="text"
                                name="lokasi"
                                class="form-control hotel-form-control"
                                value="{{ $item->lokasi }}"
                                required>

                        </div>


                        {{-- HARGA --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Harga Per Malam
                            </label>

                            <input
                                type="number"
                                name="harga_per_malam"
                                class="form-control hotel-form-control"
                                value="{{ $item->harga_per_malam }}"
                                min="0"
                                required>

                        </div>


                        {{-- RATING --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Rating
                            </label>

                            <input
                                type="number"
                                name="rating"
                                class="form-control hotel-form-control"
                                value="{{ $item->rating }}"
                                min="0"
                                max="5"
                                step="0.1"
                                required>

                        </div>


                        {{-- GAMBAR --}}

                        <div class="col-md-12">

                            <label class="hotel-form-label">
                                URL Gambar
                            </label>

                            <input
                                type="text"
                                name="gambar"
                                class="form-control hotel-form-control"
                                value="{{ $item->gambar }}">

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="col-md-12">

                            <label class="hotel-form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control hotel-form-control"
                                rows="4">{{ $item->deskripsi }}</textarea>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6">

                            <label class="hotel-form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select hotel-form-control">

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


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="hotel-btn hotel-btn-edit">

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
