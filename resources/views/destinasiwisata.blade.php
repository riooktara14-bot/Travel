@extends('layouts.app')

@section('title', 'Destinasi Wisata')

@section('content')

<style>
    .dw-wrapper {
        padding: 25px;
        font-family: 'Inter', sans-serif;
    }

    .dw-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .dw-title {
        font-size: 26px;
        font-weight: 800;
        color: #12181A;
        margin: 0;
    }

    .dw-subtitle {
        color: #718083;
        margin-top: 5px;
        font-size: 14px;
    }

    /* ================= STATISTIK ================= */

    .dw-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .dw-stat-card {
        background: #fff;
        border: 1px solid rgba(18,24,26,.12);
        border-radius: 12px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
        overflow: hidden;
    }

    .dw-stat-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--stat-color);
    }

    .dw-stat-icon {
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

    .dw-stat-label {
        font-size: 12px;
        color: #718083;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 3px;
    }

    .dw-stat-number {
        font-size: 25px;
        font-weight: 800;
        color: #12181A;
        line-height: 1.1;
    }

    .dw-btn {
        border: none;
        border-radius: 8px;
        padding: 10px 17px;
        font-weight: 600;
        cursor: pointer;
    }

    .dw-btn-add {
        background: #FFB020;
        color: #12181A;
    }

    .dw-btn-edit {
        background: #3FA79A;
        color: white;
    }

    .dw-btn-delete {
        background: #FF6B4A;
        color: white;
    }

    .dw-card {
        background: white;
        border: 1px solid rgba(18,24,26,.12);
        border-radius: 12px;
        overflow: hidden;
    }

    .dw-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dw-table th {
        background: #12181A;
        color: white;
        padding: 14px;
        text-align: left;
        font-size: 13px;
    }

    .dw-table td {
        padding: 14px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        vertical-align: middle;
    }

    .dw-table tr:hover {
        background: #fafafa;
    }

    .dw-image {
        width: 70px;
        height: 50px;
        object-fit: cover;
        border-radius: 7px;
        background: #eee;
    }

    .dw-status {
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .dw-status-active {
        background: #dff6ed;
        color: #188052;
    }

    .dw-status-off {
        background: #ffe4df;
        color: #d94c31;
    }

    .dw-actions {
        display: flex;
        gap: 6px;
    }

    .dw-actions form {
        margin: 0;
    }

    .dw-modal .modal-content {
        border: none;
        border-radius: 14px;
    }

    .dw-modal .modal-header {
        background: #12181A;
        color: white;
    }

    .dw-modal .modal-title {
        font-weight: 700;
    }

    .dw-form-label {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .dw-form-control {
        border-radius: 7px;
        border: 1px solid #ddd;
        padding: 10px 12px;
    }

    .dw-empty {
        text-align: center;
        padding: 50px 20px;
        color: #777;
    }

    @media(max-width:768px) {

        .dw-wrapper {
            padding: 15px;
        }

        .dw-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .dw-stats {
            grid-template-columns: 1fr;
        }

        .dw-card {
            overflow-x: auto;
        }

        .dw-table {
            min-width: 850px;
        }
    }
</style>

<div class="dw-wrapper">

    {{-- HEADER --}}
    <div class="dw-header">
        <div>
            <h2 class="dw-title">Destinasi Wisata</h2>

            <div class="dw-subtitle">
                Kelola destinasi wisata TravelGo
            </div>
        </div>

        <button
            class="dw-btn dw-btn-add"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">

            <i class="mdi mdi-plus"></i>
            Tambah Destinasi

        </button>
    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ================= STATISTIK DESTINASI ================= --}}

    <div class="dw-stats">

        {{-- TOTAL AKTIF --}}
        <div
            class="dw-stat-card"
            style="
                --stat-color:#3FA79A;
                --stat-bg:#e2f5f2;
            ">

            <div class="dw-stat-icon">
                <i class="mdi mdi-map-marker-check-outline"></i>
            </div>

            <div>

                <div class="dw-stat-label">
                    Destinasi Aktif
                </div>

                <div class="dw-stat-number">
                    {{ $totalAktif }}
                </div>

            </div>

        </div>


        {{-- TOTAL NONAKTIF --}}
        <div
            class="dw-stat-card"
            style="
                --stat-color:#FF6B4A;
                --stat-bg:#fff0ed;
            ">

            <div class="dw-stat-icon">
                <i class="mdi mdi-map-marker-off-outline"></i>
            </div>

            <div>

                <div class="dw-stat-label">
                    Destinasi Nonaktif
                </div>

                <div class="dw-stat-number">
                  {{ $totalNonaktif }}
                </div>

            </div>

        </div>

    </div>


    {{-- ================= TABLE ================= --}}

    <div class="dw-card">

        @if($destinasi->count() > 0)

            <table class="dw-table">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Destinasi</th>
                        <th>Lokasi</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($destinasi as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- GAMBAR --}}
                            <td>

                                @if($item->gambar)

                                    <img
                                        src="{{ $item->gambar }}"
                                        class="dw-image"
                                        alt="{{ $item->nama_destinasi }}">

                                @else

                                    <div
                                        class="dw-image d-flex align-items-center justify-content-center">

                                        <i class="mdi mdi-image-outline"></i>

                                    </div>

                                @endif

                            </td>


                            {{-- DESTINASI --}}
                            <td>

                                <strong>
                                    {{ $item->nama_destinasi }}
                                </strong>

                                @if($item->deskripsi)

                                    <div
                                        style="
                                            font-size:12px;
                                            color:#777;
                                            margin-top:4px;
                                        ">

                                        {{ Str::limit($item->deskripsi, 50) }}

                                    </div>

                                @endif

                            </td>


                            {{-- LOKASI --}}
                            <td>

                                <i class="mdi mdi-map-marker"></i>

                                {{ $item->lokasi }}

                            </td>


                            {{-- HARGA --}}
                            <td>

                                <strong>
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                                </strong>

                            </td>


                            {{-- DURASI --}}
                            <td>
                                {{ $item->durasi }} Hari
                            </td>


                            {{-- STATUS --}}
                            <td>

                               @if(strtolower(trim($item->status)) == 'aktif')
    <span class="dw-status dw-status-active">Aktif</span>
@else
    <span class="dw-status dw-status-off">Nonaktif</span>
@endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="dw-actions">

                                    {{-- EDIT --}}
                                    <button
                                        class="dw-btn dw-btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">

                                        <i class="mdi mdi-pencil"></i>

                                    </button>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('destinasiwisata.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus destinasi ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="dw-btn dw-btn-delete">

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

            <div class="dw-empty">

                <i
                    class="mdi mdi-map-marker-off"
                    style="font-size:50px;">
                </i>

                <h5 class="mt-3">
                    Belum Ada Destinasi
                </h5>

                <p>
                    Silakan tambahkan destinasi wisata pertama.
                </p>

                <button
                    class="dw-btn dw-btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">

                    <i class="mdi mdi-plus"></i>
                    Tambah Destinasi

                </button>

            </div>

        @endif

    </div>

</div>

{{-- ================================================= --}}
{{-- MODAL TAMBAH --}}
{{-- ================================================= --}}

<div
    class="modal fade dw-modal"
    id="modalTambah"
    tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="mdi mdi-plus-circle"></i>

                    Tambah Destinasi Wisata

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <form
                action="{{ route('destinasiwisata.store') }}"
                method="POST">

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="dw-form-label">
                                Nama Destinasi
                            </label>

                            <input
                                type="text"
                                name="nama_destinasi"
                                class="form-control dw-form-control"
                                placeholder="Contoh: Bali 3 Hari"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="dw-form-label">
                                Lokasi
                            </label>

                            <input
                                type="text"
                                name="lokasi"
                                class="form-control dw-form-control"
                                placeholder="Contoh: Bali, Indonesia"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="dw-form-label">
                                Harga
                            </label>

                            <input
                                type="number"
                                name="harga"
                                class="form-control dw-form-control"
                                placeholder="2500000"
                                min="0"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="dw-form-label">
                                Durasi
                            </label>

                            <input
                                type="number"
                                name="durasi"
                                class="form-control dw-form-control"
                                placeholder="3"
                                min="1"
                                required>

                        </div>


                        <div class="col-md-12">

                            <label class="dw-form-label">
                                URL Gambar
                            </label>

                            <input
                                type="text"
                                name="gambar"
                                class="form-control dw-form-control"
                                placeholder="https://contoh.com/bali.jpg">

                        </div>


                        <div class="col-md-12">

                            <label class="dw-form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control dw-form-control"
                                rows="4"
                                placeholder="Deskripsi destinasi wisata..."></textarea>

                        </div>


                        <div class="col-md-6">

                            <label class="dw-form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select dw-form-control">

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
                        class="dw-btn dw-btn-add">

                        <i class="mdi mdi-content-save"></i>

                        Simpan Destinasi

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- ================================================= --}}
{{-- MODAL EDIT --}}
{{-- ================================================= --}}

@foreach($destinasi as $item)

    <div
        class="modal fade dw-modal"
        id="modalEdit{{ $item->id }}"
        tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="mdi mdi-pencil"></i>

                        Edit Destinasi Wisata

                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <form
                    action="{{ route('destinasiwisata.update', $item->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="dw-form-label">
                                    Nama Destinasi
                                </label>

                                <input
                                    type="text"
                                    name="nama_destinasi"
                                    class="form-control dw-form-control"
                                    value="{{ $item->nama_destinasi }}"
                                    required>

                            </div>


                            <div class="col-md-6">

                                <label class="dw-form-label">
                                    Lokasi
                                </label>

                                <input
                                    type="text"
                                    name="lokasi"
                                    class="form-control dw-form-control"
                                    value="{{ $item->lokasi }}"
                                    required>

                            </div>


                            <div class="col-md-6">

                                <label class="dw-form-label">
                                    Harga
                                </label>

                                <input
                                    type="number"
                                    name="harga"
                                    class="form-control dw-form-control"
                                    value="{{ $item->harga }}"
                                    min="0"
                                    required>

                            </div>


                            <div class="col-md-6">

                                <label class="dw-form-label">
                                    Durasi
                                </label>

                                <input
                                    type="number"
                                    name="durasi"
                                    class="form-control dw-form-control"
                                    value="{{ $item->durasi }}"
                                    min="1"
                                    required>

                            </div>


                            <div class="col-md-12">

                                <label class="dw-form-label">
                                    URL Gambar
                                </label>

                                <input
                                    type="text"
                                    name="gambar"
                                    class="form-control dw-form-control"
                                    value="{{ $item->gambar }}">

                            </div>


                            <div class="col-md-12">

                                <label class="dw-form-label">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    class="form-control dw-form-control"
                                    rows="4">{{ $item->deskripsi }}</textarea>

                            </div>


                            <div class="col-md-6">

                                <label class="dw-form-label">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select dw-form-control">

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
                            class="dw-btn dw-btn-edit">

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
