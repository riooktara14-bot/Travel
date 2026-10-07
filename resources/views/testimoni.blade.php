@extends('layouts.app')
@section('title','Data Testimoni')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold">⭐ Data Testimoni</h3>
            <p class="text-muted mb-0">
                Kelola ulasan dan penilaian dari pelanggan.
            </p>
        </div>

        <a href="#" class="btn btn-primary">
            <i class="mdi mdi-plus-circle"></i>
            Tambah Testimoni
        </a>

    </div>

    <!-- Statistik -->
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Testimoni</small>
                    <h2 class="fw-bold text-primary">486</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Rating 5 ⭐</small>
                    <h2 class="fw-bold text-success">358</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Menunggu Review</small>
                    <h2 class="fw-bold text-warning">18</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Rating Rata-rata</small>
                    <h2 class="fw-bold text-danger">4.9 ⭐</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Card -->
    <div class="card border-0 shadow">

        <div class="card-header bg-white">

            <div class="row">

                <div class="col-md-4 mb-2">
                    <input type="text"
                           class="form-control"
                           placeholder="Cari pelanggan...">
                </div>

                <div class="col-md-3 mb-2">
                    <select class="form-select">
                        <option>Semua Rating</option>
                        <option>⭐⭐⭐⭐⭐</option>
                        <option>⭐⭐⭐⭐</option>
                        <option>⭐⭐⭐</option>
                        <option>⭐⭐</option>
                        <option>⭐</option>
                    </select>
                </div>

                <div class="col-md-2 mb-2">
                    <button class="btn btn-primary w-100">
                        Cari
                    </button>
                </div>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Paket Wisata</th>
                    <th>Rating</th>
                    <th>Testimoni</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                </thead>

                <tbody>

                <tr>
                    <td>1</td>
                    <td>Rio Oktara</td>
                    <td>Bali Premium 4H3M</td>
                    <td class="text-warning">⭐⭐⭐⭐⭐</td>
                    <td>Pelayanannya sangat memuaskan dan hotelnya nyaman.</td>
                    <td>06 Agustus 2026</td>
                    <td>
                        <span class="badge bg-success">
                            Ditampilkan
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">Detail</a>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Andi Saputra</td>
                    <td>Labuan Bajo Explore</td>
                    <td class="text-warning">⭐⭐⭐⭐</td>
                    <td>Pemandangan bagus dan tour guide sangat ramah.</td>
                    <td>05 Agustus 2026</td>
                    <td>
                        <span class="badge bg-success">
                            Ditampilkan
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">Detail</a>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Siti Rahma</td>
                    <td>Raja Ampat Adventure</td>
                    <td class="text-warning">⭐⭐⭐⭐⭐</td>
                    <td>Pengalaman liburan yang luar biasa. Sangat direkomendasikan.</td>
                    <td>04 Agustus 2026</td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            Menunggu
                        </span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">Detail</a>
                        <a href="#" class="btn btn-success btn-sm">Setujui</a>
                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
