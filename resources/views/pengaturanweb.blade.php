@extends('layouts.app')
@section('title','Pengaturan Website')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <h3 class="fw-bold">⚙️ Pengaturan Website</h3>
        <p class="text-muted">
            Kelola informasi dan konfigurasi website jasa traveling.
        </p>
    </div>

    <div class="card border-0 shadow">

        <div class="card-body">

            <form class="owner-settings-form">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Nama Website</label>

                        <input type="text"
                               class="form-control"
                               value="TravelGo">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Slogan</label>

                        <input type="text"
                               class="form-control"
                               value="Liburan Mudah dan Menyenangkan">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Email</label>

                        <input type="email"
                               class="form-control"
                               value="admin@travelgo.com">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>No. Telepon</label>

                        <input type="text"
                               class="form-control"
                               value="081234567890">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Logo Website</label>

                        <input type="file"
                               class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Favicon</label>

                        <input type="file"
                               class="form-control">

                    </div>

                    <div class="col-12 mb-3">

                        <label>Alamat Kantor</label>

                        <textarea class="form-control" rows="3">Jl. Sudirman No.100, Jakarta</textarea>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Facebook</label>

                        <input type="text"
                               class="form-control"
                               placeholder="https://facebook.com/travelgo">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Instagram</label>

                        <input type="text"
                               class="form-control"
                               placeholder="https://instagram.com/travelgo">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>TikTok</label>

                        <input type="text"
                               class="form-control"
                               placeholder="https://tiktok.com/@travelgo">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>YouTube</label>

                        <input type="text"
                               class="form-control"
                               placeholder="https://youtube.com/@travelgo">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>WhatsApp</label>

                        <input type="text"
                               class="form-control"
                               value="6281234567890">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Bahasa Website</label>

                        <select class="form-select">
                            <option>Indonesia</option>
                            <option>English</option>
                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Mata Uang</label>

                        <select class="form-select">
                            <option>Rupiah (IDR)</option>
                            <option>Dollar (USD)</option>
                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Status Website</label>

                        <select class="form-select">
                            <option>Online</option>
                            <option>Maintenance</option>
                        </select>

                    </div>

                    <div class="col-12 mb-3">

                        <label>Tentang Website</label>

                        <textarea class="form-control" rows="5">
TravelGo adalah website jasa traveling yang menyediakan paket wisata terbaik ke berbagai destinasi di Indonesia.
                        </textarea>

                    </div>

                </div>

                <div class="text-end">

                    <button class="btn btn-secondary">
                        Reset
                    </button>

                    <button class="btn btn-success">
                        <i class="mdi mdi-content-save"></i>
                        Simpan Pengaturan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
