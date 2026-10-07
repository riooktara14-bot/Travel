@extends('layouts.app')
@section('title','Data Pelanggan')

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

    .tg-badge{
        border-radius:20px;
        padding:.4em .85em;
        font-weight:600;
        font-size:.72rem;
        white-space:nowrap;
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

    .tg-photo{
        width:44px;
        height:44px;
        border-radius:50%;
        object-fit:cover;
        border:2px solid #fff;
        box-shadow:0 0 0 1px rgba(0,0,0,.06);
    }

    .tg-contact{
        font-size:.82rem;
        color:#495057;
        display:flex;
        align-items:center;
        gap:.35em;
    }

    .tg-contact i{
        color:#adb5bd;
        font-size:.95rem;
    }

    .tg-booking-count{
        background:#eef1f9;
        color:#0d6efd;
        font-weight:700;
        border-radius:20px;
        padding:.3em .8em;
        font-size:.8rem;
        display:inline-flex;
        align-items:center;
        gap:.3em;
    }

    .tg-hero-mini{
        background:linear-gradient(135deg,#3a86ff 0%,#8338ec 100%);
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

    .modal-header-pelanggan{
        background:linear-gradient(135deg,#3a86ff 0%,#8338ec 100%);
        color:#fff;
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

                    <i class="mdi mdi-account-group-outline"></i>

                    Manajemen Pelanggan

                </span>

                <h2 class="fw-bold mb-1">
                    👥 Data Pelanggan
                </h2>

                <p class="mb-0 opacity-90">
                    Kelola seluruh data pelanggan jasa traveling.
                </p>

            </div>


            {{-- TOMBOL TAMBAH PELANGGAN --}}

            <div style="position:relative;z-index:2;">

                <button
                    type="button"
                    class="btn btn-light fw-semibold px-4 py-2"
                    data-bs-toggle="modal"
                    data-bs-target="#tambahPelangganModal"
                >

                    <i class="mdi mdi-account-plus"></i>

                    Tambah Pelanggan

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
    {{-- MODAL TAMBAH PELANGGAN --}}
    {{-- ===================================================== --}}

    <div
        class="modal fade"
        id="tambahPelangganModal"
        tabindex="-1"
        aria-labelledby="tambahPelangganModalLabel"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg">


                {{-- HEADER MODAL --}}

                <div class="modal-header modal-header-pelanggan">

                    <div>

                        <h5
                            class="modal-title fw-bold mb-1"
                            id="tambahPelangganModalLabel"
                        >

                            <i class="mdi mdi-account-plus"></i>

                            Tambah Pelanggan

                        </h5>

                        <small class="opacity-75">

                            Masukkan data pelanggan baru

                        </small>

                    </div>


                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                {{-- BODY MODAL --}}

                <div class="modal-body p-4">

                    <form
                        method="POST"
                        action="{{ route('datapelanggan.store') }}"
                        id="formTambahPelanggan"
                    >

                        @csrf


                        <div class="row g-3">


                            {{-- NAMA --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Nama Pelanggan

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="mdi mdi-account-outline"></i>

                                    </span>

                                    <input
                                        type="text"
                                        name="nama_pelanggan"
                                        class="form-control"
                                        placeholder="Masukkan nama pelanggan"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- EMAIL --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Email

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="mdi mdi-email-outline"></i>

                                    </span>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="contoh@email.com"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- NO HP --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    No. HP

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="mdi mdi-phone-outline"></i>

                                    </span>

                                    <input
                                        type="text"
                                        name="no_hp"
                                        class="form-control"
                                        placeholder="08xxxxxxxxxx"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <div class="col-md-6">

                                <label class="form-label">

                                    Status

                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                    required
                                >

                                    <option value="Member">
                                        👑 Member
                                    </option>

                                    <option value="Non Member">
                                        👤 Non Member
                                    </option>

                                </select>

                            </div>


                            {{-- ALAMAT --}}

                            <div class="col-md-12">

                                <label class="form-label">

                                    Alamat

                                </label>

                                <textarea
                                    name="alamat"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Masukkan alamat lengkap pelanggan"
                                    required
                                ></textarea>

                            </div>


                            {{-- TOTAL BOOKING --}}

                            <input
                                type="hidden"
                                name="total_booking"
                                value="0"
                            >

                        </div>

                    </form>

                </div>


                {{-- FOOTER MODAL --}}

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
                        form="formTambahPelanggan"
                        class="btn btn-primary px-4"
                    >

                        <i class="mdi mdi-content-save"></i>

                        Simpan Pelanggan

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- STATISTIK --}}
    {{-- ===================================================== --}}

    <div class="row">


        {{-- TOTAL PELANGGAN --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Total Pelanggan
                            </small>

                            <h2 class="fw-bold text-primary mb-0">
                                {{ $pelanggans->count() }}
                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(13,110,253,.12);color:#0d6efd;"
                        >

                            <i class="mdi mdi-account-group"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PELANGGAN BARU --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Pelanggan Baru
                            </small>

                            <h2 class="fw-bold text-success mb-0">

                                {{
                                    $pelanggans
                                        ->where('created_at', '>=', now()->startOfMonth())
                                        ->count()
                                }}

                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(25,135,84,.12);color:#198754;"
                        >

                            <i class="mdi mdi-account-plus-outline"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- MEMBER --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Member
                            </small>

                            <h2 class="fw-bold text-warning mb-0">

                                {{
                                    $pelanggans
                                        ->where('status', 'Member')
                                        ->count()
                                }}

                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(255,193,7,.15);color:#e0a800;"
                        >

                            <i class="mdi mdi-crown-outline"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PELANGGAN AKTIF --}}

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card border-0 shadow-sm tg-stat h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <small class="text-muted">
                                Pelanggan Aktif
                            </small>

                            <h2 class="fw-bold text-danger mb-0">

                                {{
                                    $pelanggans
                                        ->where('status', 'Member')
                                        ->count()
                                }}

                            </h2>

                        </div>


                        <div
                            class="tg-icon"
                            style="background:rgba(220,53,69,.12);color:#dc3545;"
                        >

                            <i class="mdi mdi-account-check-outline"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- DATA PELANGGAN --}}
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
                            id="searchPelanggan"
                            class="form-control border-start-0"
                            placeholder="Cari nama, email, atau no. HP..."
                        >

                    </div>

                </div>


                {{-- FILTER --}}

                <div class="col-md-3">

                    <select
                        id="filterStatus"
                        class="form-select"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option value="Member">
                            Member
                        </option>

                        <option value="Non Member">
                            Non Member
                        </option>

                    </select>

                </div>


                {{-- CARI --}}

                <div class="col-md-2">

                    <button
                        type="button"
                        id="btnCariPelanggan"
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

                        <th>Pelanggan</th>

                        <th>Kontak</th>

                        <th>Alamat</th>

                        <th>Status</th>

                        <th>Total Booking</th>

                        <th class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="pelangganTable">

                    @forelse ($pelanggans as $pelanggan)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                <div class="fw-semibold">

                                    {{ $pelanggan->nama_pelanggan }}

                                </div>

                                <div class="small text-muted">

                                    {{ $pelanggan->email }}

                                </div>

                            </td>


                            <td>

                                <div class="tg-contact">

                                    <i class="mdi mdi-phone"></i>

                                    {{ $pelanggan->no_hp }}

                                </div>

                            </td>


                            <td>

                                {{ $pelanggan->alamat }}

                            </td>


                            <td>

                                @if($pelanggan->status == 'Member')

                                    <span class="tg-badge bg-warning-subtle text-warning-emphasis">

                                        <i class="mdi mdi-crown-outline"></i>

                                        Member

                                    </span>

                                @else

                                    <span class="tg-badge bg-secondary-subtle text-secondary">

                                        Non Member

                                    </span>

                                @endif

                            </td>


                            <td>

                                <span class="tg-booking-count">

                                    <i class="mdi mdi-book-check-outline"></i>

                                    {{ $pelanggan->bookings_count ?? 0 }}

                                    Kali

                                </span>

                            </td>


                            <td class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-outline-warning tg-action-btn"
                                    title="Edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPelangganModal{{ $pelanggan->id }}"
                                >
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <form
                                    method="POST"
                                    action="{{ route('datapelanggan.destroy', $pelanggan->id) }}"
                                    onsubmit="return confirm('Hapus pelanggan ini?')"
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
                                colspan="7"
                                class="text-center text-muted py-5"
                            >

                                <i class="mdi mdi-account-off-outline fs-1 d-block mb-2"></i>

                                Belum ada data pelanggan.

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
                {{ $pelanggans->count() }}
                pelanggan

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


{{-- ===================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ===================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('searchPelanggan');

    const filterStatus =
        document.getElementById('filterStatus');

    const btnCari =
        document.getElementById('btnCariPelanggan');


    function filterPelanggan() {

        const keyword =
            searchInput.value.toLowerCase().trim();

        const status =
            filterStatus.value.toLowerCase();


        const rows =
            document.querySelectorAll(
                '#pelangganTable tr'
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
        filterPelanggan
    );


    searchInput?.addEventListener(
        'keyup',
        function(event) {

            if (event.key === 'Enter') {

                filterPelanggan();

            }

        }
    );


    filterStatus?.addEventListener(
        'change',
        filterPelanggan
    );

});

</script>

@foreach ($pelanggans as $pelanggan)
    <div class="modal fade" id="editPelangganModal{{ $pelanggan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg"><div class="modal-content">
            <form method="POST" action="{{ route('datapelanggan.update', $pelanggan->id) }}">
                @csrf @method('PUT')
                <div class="modal-header"><h5 class="modal-title">Edit Pelanggan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label class="form-label">Nama Pelanggan</label><input name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" value="{{ $pelanggan->email }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">No. HP</label><input name="no_hp" value="{{ $pelanggan->no_hp }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Alamat</label><input name="alamat" value="{{ $pelanggan->alamat }}" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Status</label><select name="status" class="form-select"><option @selected($pelanggan->status === 'Member')>Member</option><option @selected($pelanggan->status === 'Non Member')>Non Member</option></select></div>
                    <div class="col-md-6"><label class="form-label">Total Booking</label><input type="number" name="total_booking" min="0" value="{{ $pelanggan->bookings_count ?? $pelanggan->total_booking }}" class="form-control" required></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary">Simpan Perubahan</button></div>
            </form>
        </div></div>
    </div>
@endforeach
@endsection
