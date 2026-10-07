@extends('layouts.app')
@section('title','Data Pembayaran')

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
        width:54px;height:54px;
        display:flex;align-items:center;justify-content:center;
        border-radius:16px;
        font-size:1.4rem;
    }

    .tg-card{
        border-radius:18px;
        border:1px solid rgba(0,0,0,.04);
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

    .tg-code-muted{
        font-family:'Courier New', monospace;
        font-size:.8rem;
        color:#6c757d;
    }

    .tg-badge{
        border-radius:20px;
        padding:.4em .85em;
        font-weight:600;
        font-size:.72rem;
        white-space:nowrap;
    }

    .tg-avatar{
        width:38px;height:38px;
        border-radius:50%;
        display:flex;align-items:center;justify-content:center;
        font-weight:700;
        color:#fff;
        font-size:.85rem;
        flex-shrink:0;
    }

    .tg-action-btn{
        width:34px;height:34px;
        border-radius:10px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:0;
    }

    .tg-method{
        display:inline-flex;
        align-items:center;
        gap:.4em;
        font-size:.85rem;
        font-weight:600;
        color:#495057;
    }
    .tg-method i{
        font-size:1.1rem;
    }

    .tg-hero-mini{
        background:linear-gradient(135deg,#ff9a3c 0%,#ff6b6b 100%);
        border-radius:20px;
        color:#fff;
        position:relative;
        overflow:hidden;
    }
    .tg-hero-mini::before{
        content:"";
        position:absolute;
        inset:0;
        background-image:radial-gradient(circle at 90% 10%, rgba(255,255,255,.18) 0, transparent 40%);
    }

    .tg-fade-in{
        animation:tgFadeIn .5s ease both;
    }
    @keyframes tgFadeIn{
        from{opacity:0; transform:translateY(10px);}
        to{opacity:1; transform:translateY(0);}
    }
</style>

<div class="container-fluid">

    {{-- Header --}}
    <div class="card border-0 shadow-lg mb-4 tg-hero-mini tg-fade-in">
        <div class="card-body p-4 p-md-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="badge bg-white bg-opacity-25 px-3 py-2 rounded-pill mb-2 d-inline-block">
                    <i class="mdi mdi-credit-card-outline"></i> Manajemen Pembayaran
                </span>
                <h2 class="fw-bold mb-1">💳 Data Pembayaran</h2>
                <p class="mb-0 opacity-90">
                    Kelola seluruh transaksi pembayaran pelanggan.
                </p>
            </div>

            <a href="#" class="btn btn-light fw-semibold px-4">
                <i class="mdi mdi-cash-plus"></i> Tambah Pembayaran
            </a>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm tg-stat h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Total Transaksi</small>
                            <h2 class="fw-bold text-primary mb-0">486</h2>
                        </div>
                        <div class="tg-icon" style="background:rgba(13,110,253,.12); color:#0d6efd;">
                            <i class="mdi mdi-swap-horizontal"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm tg-stat h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Lunas</small>
                            <h2 class="fw-bold text-success mb-0">420</h2>
                        </div>
                        <div class="tg-icon" style="background:rgba(25,135,84,.12); color:#198754;">
                            <i class="mdi mdi-check-decagram"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm tg-stat h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Menunggu</small>
                            <h2 class="fw-bold text-warning mb-0">41</h2>
                        </div>
                        <div class="tg-icon" style="background:rgba(255,193,7,.15); color:#e0a800;">
                            <i class="mdi mdi-timer-sand"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm tg-stat h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Gagal</small>
                            <h2 class="fw-bold text-danger mb-0">25</h2>
                        </div>
                        <div class="tg-icon" style="background:rgba(220,53,69,.12); color:#dc3545;">
                            <i class="mdi mdi-close-circle-outline"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Data --}}
    <div class="card border-0 shadow-sm tg-card">

        <div class="card-header bg-white">

            <div class="row g-2 align-items-center">

                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="mdi mdi-magnify"></i>
                        </span>
                        <input type="text"
                               class="form-control border-start-0"
                               placeholder="Cari ID pembayaran atau pelanggan...">
                    </div>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option>Semua Status</option>
                        <option>Lunas</option>
                        <option>Menunggu</option>
                        <option>Gagal</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        <i class="mdi mdi-magnify"></i> Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100">
                        <i class="mdi mdi-tray-arrow-down"></i> Export
                    </button>
                </div>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle tg-table mb-0">

                <thead class="table-light">

                    <tr>
                        <th>No</th>
                        <th>ID Pembayaran</th>
                        <th>Pelanggan</th>
                        <th>Booking</th>
                        <th>Metode</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td><span class="tg-code">PAY001</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="tg-avatar" style="background:#0d6efd;">RO</div>
                                <span>Rio Oktara</span>
                            </div>
                        </td>
                        <td><span class="tg-code-muted">BK00125</span></td>
                        <td>
                            <span class="tg-method">
                                <i class="mdi mdi-bank-outline text-primary"></i> Transfer Bank
                            </span>
                        </td>
                        <td class="fw-semibold">Rp14.000.000</td>
                        <td>
                            <div class="small">
                                <i class="mdi mdi-calendar-outline text-muted"></i>
                                06 Agustus 2026
                            </div>
                        </td>
                        <td>
                            <span class="tg-badge bg-success-subtle text-success">
                                <i class="mdi mdi-check-circle"></i> Lunas
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="#" class="btn btn-outline-info tg-action-btn" title="Detail">
                                    <i class="mdi mdi-eye-outline"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning tg-action-btn" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger tg-action-btn" title="Hapus">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td><span class="tg-code">PAY002</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="tg-avatar" style="background:#fd7e14;">AS</div>
                                <span>Andi Saputra</span>
                            </div>
                        </td>
                        <td><span class="tg-code-muted">BK00126</span></td>
                        <td>
                            <span class="tg-method">
                                <i class="mdi mdi-qrcode text-success"></i> QRIS
                            </span>
                        </td>
                        <td class="fw-semibold">Rp6.500.000</td>
                        <td>
                            <div class="small">
                                <i class="mdi mdi-calendar-outline text-muted"></i>
                                05 Agustus 2026
                            </div>
                        </td>
                        <td>
                            <span class="tg-badge bg-warning-subtle text-warning-emphasis">
                                <i class="mdi mdi-clock-outline"></i> Menunggu
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="#" class="btn btn-outline-info tg-action-btn" title="Detail">
                                    <i class="mdi mdi-eye-outline"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning tg-action-btn" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger tg-action-btn" title="Hapus">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td><span class="tg-code">PAY003</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="tg-avatar" style="background:#7209b7;">SR</div>
                                <span>Siti Rahma</span>
                            </div>
                        </td>
                        <td><span class="tg-code-muted">BK00127</span></td>
                        <td>
                            <span class="tg-method">
                                <i class="mdi mdi-wallet-outline text-danger"></i> E-Wallet
                            </span>
                        </td>
                        <td class="fw-semibold">Rp26.700.000</td>
                        <td>
                            <div class="small">
                                <i class="mdi mdi-calendar-outline text-muted"></i>
                                04 Agustus 2026
                            </div>
                        </td>
                        <td>
                            <span class="tg-badge bg-danger-subtle text-danger">
                                <i class="mdi mdi-close-circle"></i> Gagal
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="#" class="btn btn-outline-info tg-action-btn" title="Detail">
                                    <i class="mdi mdi-eye-outline"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning tg-action-btn" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger tg-action-btn" title="Hapus">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
            <span class="small text-muted">Menampilkan 3 dari 486 transaksi</span>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                </ul>
            </nav>
        </div>

    </div>

</div>

@endsection
