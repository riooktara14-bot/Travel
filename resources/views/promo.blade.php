@extends('layouts.app')

@section('title', 'Promo')

@section('content')

<style>
    .promo-wrapper {
        padding: 25px;
        font-family: 'Inter', sans-serif;
    }

    .promo-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .promo-title {
        font-size: 26px;
        font-weight: 800;
        color: #12181A;
        margin: 0;
    }

    .promo-subtitle {
        color: #718083;
        margin-top: 5px;
        font-size: 14px;
    }

    .promo-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .promo-stat-card {
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

    .promo-stat-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--stat-color);
    }

    .promo-stat-icon {
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

    .promo-stat-label {
        font-size: 12px;
        color: #718083;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 3px;
    }

    .promo-stat-number {
        font-size: 25px;
        font-weight: 800;
        color: #12181A;
        line-height: 1.1;
    }

    .promo-btn {
        border: none;
        border-radius: 8px;
        padding: 10px 17px;
        font-weight: 600;
        cursor: pointer;
    }

    .promo-btn-add {
        background: #FFB020;
        color: #12181A;
    }

    .promo-btn-edit {
        background: #3FA79A;
        color: white;
    }

    .promo-btn-delete {
        background: #FF6B4A;
        color: white;
    }

    .promo-card {
        background: white;
        border: 1px solid rgba(18,24,26,.12);
        border-radius: 12px;
        overflow: hidden;
    }

    .promo-table {
        width: 100%;
        border-collapse: collapse;
    }

    .promo-table th {
        background: #12181A;
        color: white;
        padding: 14px;
        text-align: left;
        font-size: 13px;
    }

    .promo-table td {
        padding: 14px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        vertical-align: middle;
    }

    .promo-table tr:hover {
        background: #fafafa;
    }

    .promo-image {
        width: 75px;
        height: 50px;
        object-fit: cover;
        border-radius: 7px;
        background: #eee;
    }

    .promo-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }

    .promo-status-active {
        background: #dff6ed;
        color: #188052;
    }

    .promo-status-ended {
        background: #ffe4df;
        color: #d94c31;
    }

    .promo-status-off {
        background: #eeeeee;
        color: #666;
    }

    .promo-actions {
        display: flex;
        gap: 6px;
    }

    .promo-actions form {
        margin: 0;
    }

    .promo-modal .modal-content {
        border: none;
        border-radius: 14px;
    }

    .promo-modal .modal-header {
        background: #12181A;
        color: white;
    }

    .promo-modal .modal-title {
        font-weight: 700;
    }

    .promo-form-label {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .promo-form-control {
        border-radius: 7px;
        border: 1px solid #ddd;
        padding: 10px 12px;
    }

    .promo-empty {
        text-align: center;
        padding: 50px 20px;
        color: #777;
    }

    @media(max-width:768px) {

        .promo-wrapper {
            padding: 15px;
        }

        .promo-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .promo-stats {
            grid-template-columns: 1fr;
        }

        .promo-card {
            overflow-x: auto;
        }

        .promo-table {
            min-width: 1100px;
        }
    }
</style>


<div class="promo-wrapper">

    {{-- HEADER --}}
    <div class="promo-header">

        <div>
            <h2 class="promo-title">
                Promo TravelGo
            </h2>

            <div class="promo-subtitle">
                Kelola promo dan diskon perjalanan TravelGo
            </div>
        </div>

        <button
            class="promo-btn promo-btn-add"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">

            <i class="mdi mdi-plus"></i>
            Tambah Promo

        </button>

    </div>


    {{-- ALERT --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


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


    {{-- STATISTIK --}}
    <div class="promo-stats">

        {{-- TOTAL --}}
        <div
            class="promo-stat-card"
            style="--stat-color:#3F7CAC; --stat-bg:#e8f3fa;">

            <div class="promo-stat-icon">
                <i class="mdi mdi-ticket-percent-outline"></i>
            </div>

            <div>

                <div class="promo-stat-label">
                    Total Promo
                </div>

                <div class="promo-stat-number">
                    {{ $promo->count() }}
                </div>

            </div>

        </div>


        {{-- AKTIF --}}
        <div
            class="promo-stat-card"
            style="--stat-color:#3FA79A; --stat-bg:#e2f5f2;">

            <div class="promo-stat-icon">
                <i class="mdi mdi-sale"></i>
            </div>

            <div>

                <div class="promo-stat-label">
                    Promo Aktif
                </div>

                <div class="promo-stat-number">

                    {{ $promo->filter(function($p) {
                        return strtolower(trim($p->status)) == 'aktif'
                            && $p->tanggal_selesai->toDateString() >= now()->toDateString();
                    })->count() }}

                </div>

            </div>

        </div>


        {{-- BERAKHIR --}}
        <div
            class="promo-stat-card"
            style="--stat-color:#FF6B4A; --stat-bg:#fff0ed;">

            <div class="promo-stat-icon">
                <i class="mdi mdi-calendar-remove-outline"></i>
            </div>

            <div>

                <div class="promo-stat-label">
                    Promo Berakhir
                </div>

                <div class="promo-stat-number">

                    {{ $promo->filter(function($p) {
                        return $p->tanggal_selesai->toDateString() < now()->toDateString();
                    })->count() }}

                </div>

            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="promo-card">

        @if($promo->count() > 0)

            <table class="promo-table">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Promo</th>
                        <th>Kode</th>
                        <th>Diskon</th>
                        <th>Minimal Transaksi</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($promo as $item)

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
                                        class="promo-image"
                                        alt="{{ $item->nama_promo }}">

                                @else

                                    <div
                                        class="promo-image d-flex align-items-center justify-content-center">

                                        <i class="mdi mdi-image-outline"></i>

                                    </div>

                                @endif

                            </td>


                            {{-- NAMA PROMO --}}
                            <td>

                                <strong>
                                    {{ $item->nama_promo }}
                                </strong>

                                @if($item->deskripsi)

                                    <div
                                        style="
                                            font-size:12px;
                                            color:#777;
                                            margin-top:4px;
                                        ">

                                        {{ Str::limit($item->deskripsi, 45) }}

                                    </div>

                                @endif

                            </td>


                            {{-- KODE --}}
                            <td>

                                <span
                                    style="
                                        background:#f2f2f2;
                                        padding:6px 9px;
                                        border-radius:6px;
                                        font-weight:700;
                                        font-size:12px;
                                    ">

                                    {{ $item->kode_promo }}

                                </span>

                            </td>


                            {{-- DISKON --}}
                            <td>

                                <strong>

                                    @if($item->tipe_diskon == 'persen')

                                        {{ $item->nilai_diskon }}%

                                    @else

                                        Rp{{ number_format($item->nilai_diskon, 0, ',', '.') }}

                                    @endif

                                </strong>

                            </td>


                            {{-- MINIMAL TRANSAKSI --}}
                            <td>

                                Rp{{ number_format($item->minimal_transaksi, 0, ',', '.') }}

                            </td>


                            {{-- PERIODE --}}
                            <td>

                                <div>
                                    {{ $item->tanggal_mulai->format('d M Y') }}
                                </div>

                                <small style="color:#777;">
                                    s/d {{ $item->tanggal_selesai->format('d M Y') }}
                                </small>

                            </td>

{{-- STATUS --}}
<td>
    @if($item->tanggal_selesai->toDateString() < now()->toDateString())
        <span class="promo-status promo-status-ended">Berakhir</span>
    @elseif(strtolower(trim($item->status)) == 'aktif')
        <span class="promo-status promo-status-active">Aktif</span>
    @else
        <span class="promo-status promo-status-off">Nonaktif</span>
    @endif
</td>


                            {{-- AKSI --}}
                            <td>

                                <div class="promo-actions">

                                    <button
                                        class="promo-btn promo-btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">

                                        <i class="mdi mdi-pencil"></i>

                                    </button>


                                    <form
                                        action="{{ route('promo.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus promo ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="promo-btn promo-btn-delete">

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

            <div class="promo-empty">

                <i
                    class="mdi mdi-ticket-percent-outline"
                    style="font-size:50px;">
                </i>

                <h5 class="mt-3">
                    Belum Ada Promo
                </h5>

                <p>
                    Silakan tambahkan promo pertama TravelGo.
                </p>

                <button
                    class="promo-btn promo-btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">

                    <i class="mdi mdi-plus"></i>
                    Tambah Promo

                </button>

            </div>

        @endif

    </div>

</div>


{{-- ================================================= --}}
{{-- MODAL TAMBAH --}}
{{-- ================================================= --}}

<div
    class="modal fade promo-modal"
    id="modalTambah"
    tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="mdi mdi-ticket-percent"></i>
                    Tambah Promo

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <form
                action="{{ route('promo.store') }}"
                method="POST">

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Nama Promo
                            </label>

                            <input
                                type="text"
                                name="nama_promo"
                                class="form-control promo-form-control"
                                placeholder="Contoh: Promo Liburan Bali"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Kode Promo
                            </label>

                            <input
                                type="text"
                                name="kode_promo"
                                class="form-control promo-form-control"
                                placeholder="Contoh: BALI20"
                                required>

                        </div>


                        <div class="col-md-12">

                            <label class="promo-form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control promo-form-control"
                                rows="3"
                                placeholder="Deskripsi promo..."></textarea>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Tipe Diskon
                            </label>

                            <select
                                name="tipe_diskon"
                                class="form-select promo-form-control"
                                required>

                                <option value="persen">
                                    Persentase (%)
                                </option>

                                <option value="nominal">
                                    Nominal (Rp)
                                </option>

                            </select>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Nilai Diskon
                            </label>

                            <input
                                type="number"
                                name="nilai_diskon"
                                class="form-control promo-form-control"
                                placeholder="20"
                                min="0"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Minimal Transaksi
                            </label>

                            <input
                                type="number"
                                name="minimal_transaksi"
                                class="form-control promo-form-control"
                                placeholder="500000"
                                min="0"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                URL Gambar
                            </label>

                            <input
                                type="text"
                                name="gambar"
                                class="form-control promo-form-control"
                                placeholder="https://contoh.com/promo.jpg">

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="form-control promo-form-control"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control promo-form-control"
                                required>

                        </div>


                        {{-- STATUS TAMBAH --}}
                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select promo-form-control"
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


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="promo-btn promo-btn-add">

                        <i class="mdi mdi-content-save"></i>
                        Simpan Promo

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ================================================= --}}
{{-- MODAL EDIT --}}
{{-- ================================================= --}}

@foreach($promo as $item)

<div
    class="modal fade promo-modal"
    id="modalEdit{{ $item->id }}"
    tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="mdi mdi-pencil"></i>
                    Edit Promo

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <form
                action="{{ route('promo.update', $item->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Nama Promo
                            </label>

                            <input
                                type="text"
                                name="nama_promo"
                                class="form-control promo-form-control"
                                value="{{ $item->nama_promo }}"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Kode Promo
                            </label>

                            <input
                                type="text"
                                name="kode_promo"
                                class="form-control promo-form-control"
                                value="{{ $item->kode_promo }}"
                                required>

                        </div>


                        <div class="col-md-12">

                            <label class="promo-form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control promo-form-control"
                                rows="3">{{ $item->deskripsi }}</textarea>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Tipe Diskon
                            </label>

                            <select
                                name="tipe_diskon"
                                class="form-select promo-form-control"
                                required>

                                <option
                                    value="persen"
                                    {{ $item->tipe_diskon == 'persen' ? 'selected' : '' }}>
                                    Persentase (%)
                                </option>

                                <option
                                    value="nominal"
                                    {{ $item->tipe_diskon == 'nominal' ? 'selected' : '' }}>
                                    Nominal (Rp)
                                </option>

                            </select>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Nilai Diskon
                            </label>

                            <input
                                type="number"
                                name="nilai_diskon"
                                class="form-control promo-form-control"
                                value="{{ $item->nilai_diskon }}"
                                min="0"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Minimal Transaksi
                            </label>

                            <input
                                type="number"
                                name="minimal_transaksi"
                                class="form-control promo-form-control"
                                value="{{ $item->minimal_transaksi }}"
                                min="0"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                URL Gambar
                            </label>

                            <input
                                type="text"
                                name="gambar"
                                class="form-control promo-form-control"
                                value="{{ $item->gambar }}">

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="form-control promo-form-control"
                                value="{{ $item->tanggal_mulai->format('Y-m-d') }}"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control promo-form-control"
                                value="{{ $item->tanggal_selesai->format('Y-m-d') }}"
                                required>

                        </div>


                        {{-- STATUS EDIT --}}
                        <div class="col-md-6">

                            <label class="promo-form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select promo-form-control"
                                required>

                                <option
                                    value="aktif"
                                    {{ strtolower(trim($item->status)) == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option
                                    value="nonaktif"
                                    {{ strtolower(trim($item->status)) == 'nonaktif' ? 'selected' : '' }}>
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
                        class="promo-btn promo-btn-edit">

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
