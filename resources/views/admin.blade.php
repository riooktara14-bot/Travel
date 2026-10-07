@extends('layouts.app')
@section('title','Dashboard')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&display=swap');

    :root{
        --bg:#F8FAFC;
        --panel:#1E293B;
        --panel-2:#334155;

        --amber:#F4C95D;
        --amber-dim:#B89A3E;

        --teal:#3FA79A;
        --coral:#FF6B4A;

        --ink:#1E293B;
        --ink-soft:#64748B;

        --line:#E2E8F0;
        --line-strong:#CBD5E1;
    }

    /* ================= GLOBAL ================= */

    #content,
    .container-fluid{
        background:var(--bg) !important;
    }

    .container-fluid{
        font-family:'Inter',sans-serif;
        color:var(--ink);
        padding-bottom:2rem;
    }

    .op-mono{
        font-family:'IBM Plex Mono',monospace;
    }

    .op-section-title{
        font-family:'IBM Plex Mono',monospace;
        font-weight:700;
        font-size:.82rem;
        letter-spacing:.1em;
        text-transform:uppercase;
        color:var(--ink-soft);
        margin:0 0 .75rem;
    }

    /* ================= STATUS BAR ================= */

    .op-statusbar{
        display:flex;
        align-items:center;
        justify-content:space-between;
        background:var(--panel);
        color:#fff;
        border-radius:10px;
        padding:.85rem 1.4rem;
        margin-bottom:1.5rem;
        font-family:'IBM Plex Mono',monospace;
        font-size:.78rem;
        flex-wrap:wrap;
        gap:.6rem;
    }

    .op-statusbar .op-brand{
        display:flex;
        align-items:center;
        gap:.6rem;
        letter-spacing:.08em;
        text-transform:uppercase;
        font-weight:600;
    }

    .op-brand .op-dot{
        width:8px;
        height:8px;
        border-radius:50%;
        background:var(--amber);
        box-shadow:0 0 0 3px rgba(244,201,93,.18);
        animation:opPulse 1.8s infinite;
    }

    @keyframes opPulse{
        0%,100%{opacity:1;}
        50%{opacity:.35;}
    }

    .op-statusbar .op-mid{
        color:rgba(255,255,255,.6);
        letter-spacing:.05em;
    }

    .op-statusbar .op-actions{
        display:flex;
        gap:.6rem;
        align-items:center;
    }

    .op-statusbar .btn-op{
        font-family:'Inter',sans-serif;
        font-weight:600;
        font-size:.78rem;
        border-radius:7px;
        padding:.45rem 1rem;
        border:1px solid transparent;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:.4rem;
    }

    .btn-op-fill{
        background:var(--amber);
        color:var(--panel);
    }

    .btn-op-fill:hover{
        background:#E8B93F;
        color:var(--panel);
    }

    .btn-op-line{
        border-color:rgba(255,255,255,.25);
        color:#fff;
    }

    .btn-op-line:hover{
        border-color:var(--amber);
        color:var(--amber);
        background:rgba(244,201,93,.06);
    }

    /* ================= DIRECTORY ================= */

    .op-directory{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:.9rem;
        margin-bottom:1.5rem;
    }

    @media (max-width:991px){
        .op-directory{
            grid-template-columns:repeat(2,1fr);
        }
    }

    @media (max-width:575px){
        .op-directory{
            grid-template-columns:1fr;
        }
    }

    .op-dir-item{
        background:#fff;
        border:1px solid var(--line);
        border-radius:8px;
        padding:.95rem 1.05rem;
        display:flex;
        align-items:center;
        gap:.75rem;
        text-decoration:none;
        color:var(--ink);
        transition:border-color .2s ease,
                   transform .2s ease,
                   box-shadow .2s ease;
    }

    .op-dir-item:hover{
        border-color:var(--amber);
        transform:translateY(-2px);
        color:var(--ink);
        box-shadow:0 5px 15px rgba(30,41,59,.08);
    }

    .op-dir-icon{
        width:40px;
        height:40px;
        border-radius:7px;
        flex-shrink:0;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:1.05rem;
        background:#F8FAFC;
        color:var(--dir-color,var(--ink));
    }

    .op-dir-item .op-dir-label{
        font-weight:700;
        font-size:.85rem;
        display:block;
    }

    .op-dir-item small{
        font-family:'IBM Plex Mono',monospace;
        font-size:.65rem;
        color:var(--ink-soft);
        text-transform:uppercase;
        letter-spacing:.05em;
    }

    /* ================= SCOREBOARD ================= */

    .op-scoreboard{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:1rem;
        margin-bottom:1.5rem;
    }

    @media (max-width:991px){
        .op-scoreboard{
            grid-template-columns:repeat(2,1fr);
        }
    }

    @media (max-width:575px){
        .op-scoreboard{
            grid-template-columns:1fr;
        }
    }

    .op-sign{
        background:#fff;
        border:1px solid var(--line);
        border-top:3px solid var(--sign-color,var(--ink));
        border-radius:8px;
        padding:1.1rem 1.2rem 1rem;
        position:relative;
    }

    .op-sign::before{
        content:"";
        position:absolute;
        top:0;
        left:16px;
        width:20px;
        height:6px;
        background:var(--sign-color,var(--ink));
        border-radius:0 0 3px 3px;
    }

    .op-sign-label{
        display:block;
        font-family:'IBM Plex Mono',monospace;
        font-size:.66rem;
        letter-spacing:.1em;
        text-transform:uppercase;
        color:var(--ink-soft);
        margin-bottom:.55rem;
    }

    .op-sign-value{
        font-family:'IBM Plex Mono',monospace;
        font-weight:700;
        font-size:1.9rem;
        line-height:1;
        margin-bottom:.5rem;
        font-variant-numeric:tabular-nums;
        color:var(--ink);
    }

    .op-sign-trend{
        font-family:'IBM Plex Mono',monospace;
        font-size:.72rem;
        font-weight:600;
    }

    .op-up{
        color:#1B8A5A;
    }

    .op-down{
        color:var(--coral);
    }

    /* ================= JADWAL + NOTIFIKASI ================= */

    .op-row2{
        display:grid;
        grid-template-columns:2fr 1fr;
        gap:1.5rem;
        margin-bottom:1.5rem;
        align-items:start;
    }

    @media (max-width:991px){
        .op-row2{
            grid-template-columns:1fr;
        }
    }

    .op-timeline{
        display:grid;
        grid-template-columns:repeat(5,minmax(0,1fr));
        gap:.9rem;
        width:100%;
    }

    @media (max-width:1200px){
        .op-timeline{
            grid-template-columns:repeat(3,minmax(0,1fr));
        }
    }

    @media (max-width:767px){
        .op-timeline{
            grid-template-columns:repeat(2,minmax(0,1fr));
        }
    }

    @media (max-width:575px){
        .op-timeline{
            grid-template-columns:1fr;
        }
    }

    .op-tl-item{
        min-width:0;
        width:100%;
        box-sizing:border-box;
        background:var(--panel);
        color:#fff;
        border-radius:8px;
        padding:1rem 1.05rem;
        border-top:3px solid var(--tl-color,var(--amber));
    }

    .op-tl-date{
        font-family:'IBM Plex Mono',monospace;
        font-size:.68rem;
        letter-spacing:.06em;
        text-transform:uppercase;
        color:var(--tl-color,var(--amber));
        margin-bottom:.4rem;
    }

    .op-tl-dest{
        font-weight:700;
        font-size:.92rem;
        margin-bottom:.55rem;
    }

    .op-tl-meta{
        display:flex;
        justify-content:space-between;
        gap:.5rem;
        font-family:'IBM Plex Mono',monospace;
        font-size:.7rem;
        color:rgba(255,255,255,.55);
    }

    /* ================= ALERT ================= */

    .op-alerts{
        background:#fff;
        border:1px solid var(--line);
        border-radius:10px;
        padding:.5rem 1.3rem;
    }

    .op-alert-item{
        display:flex;
        gap:.75rem;
        padding:.85rem 0;
        border-bottom:1px solid var(--line);
    }

    .op-alert-item:last-child{
        border-bottom:none;
    }

    .op-alert-icon{
        width:32px;
        height:32px;
        border-radius:7px;
        flex-shrink:0;
        font-size:.9rem;
        display:flex;
        align-items:center;
        justify-content:center;
        background:var(--al-color);
        color:#fff;
    }

    .op-alert-text{
        font-size:.83rem;
        line-height:1.4;
    }

    .op-alert-time{
        display:block;
        font-family:'IBM Plex Mono',monospace;
        font-size:.66rem;
        color:var(--ink-soft);
        margin-top:.25rem;
        text-transform:uppercase;
        letter-spacing:.04em;
    }

    /* ================= BOARD + GATES ================= */

    .op-split{
        display:grid;
        grid-template-columns:1.65fr 1fr;
        gap:1.5rem;
        margin-bottom:1.5rem;
        align-items:start;
    }

    @media (max-width:991px){
        .op-split{
            grid-template-columns:1fr;
        }
    }

    .op-panel-head{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:.75rem;
    }

    .op-panel-head h5{
        font-family:'IBM Plex Mono',monospace;
        font-weight:700;
        font-size:.82rem;
        letter-spacing:.1em;
        text-transform:uppercase;
        margin:0;
        color:var(--ink-soft);
    }

    .op-panel-head a{
        font-family:'IBM Plex Mono',monospace;
        font-size:.72rem;
        color:var(--ink);
        text-decoration:none;
        border-bottom:1px dashed var(--line-strong);
    }

    .op-board{
        background:var(--panel);
        border-radius:10px;
        overflow:hidden;
        perspective:800px;
    }

    .op-board-cols{
        display:grid;
        grid-template-columns:1fr 1.3fr 1.3fr 1.1fr 1fr .8fr;
        padding:.7rem 1.2rem;
        font-family:'IBM Plex Mono',monospace;
        font-size:.65rem;
        letter-spacing:.08em;
        text-transform:uppercase;
        color:rgba(255,255,255,.4);
        border-bottom:1px solid rgba(255,255,255,.08);
    }

    .op-row{
        display:grid;
        grid-template-columns:1fr 1.3fr 1.3fr 1.1fr 1fr .8fr;
        align-items:center;
        padding:.85rem 1.2rem;
        font-family:'IBM Plex Mono',monospace;
        font-size:.82rem;
        color:#fff;
        border-bottom:1px solid rgba(255,255,255,.06);
        transform-origin:top center;
        animation:opFlap .5s ease backwards;
    }

    .op-row:nth-child(2){
        animation-delay:.05s;
    }

    .op-row:nth-child(3){
        animation-delay:.15s;
    }

    .op-row:nth-child(4){
        animation-delay:.25s;
    }

    @keyframes opFlap{
        from{
            opacity:0;
            transform:rotateX(-90deg);
        }

        to{
            opacity:1;
            transform:rotateX(0);
        }
    }

    .op-row .op-code{
        color:var(--amber);
        font-weight:600;
    }

    .op-row .op-status{
        display:inline-flex;
        align-items:center;
        gap:.4rem;
        font-weight:600;
        font-size:.72rem;
        letter-spacing:.04em;
        text-transform:uppercase;
    }

    .op-row .op-status .op-led{
        width:6px;
        height:6px;
        border-radius:50%;
        display:inline-block;
    }

    .op-led-green{
        background:#3FD68C;
    }

    .op-led-amber{
        background:var(--amber);
        animation:opPulse 1.4s infinite;
    }

    .op-led-teal{
        background:var(--teal);
    }

    .op-row .op-gate{
        color:rgba(255,255,255,.5);
    }

    @media (max-width:575px){

        .op-board-cols{
            display:none;
        }

        .op-row{
            grid-template-columns:1fr 1fr;
            row-gap:.35rem;
            padding:.9rem 1.2rem;
        }

        .op-row span:nth-child(1){
            order:1;
        }

        .op-row span:nth-child(2){
            order:2;
            grid-column:span 2;
            font-size:.9rem;
        }

        .op-row span:nth-child(3){
            order:3;
        }

        .op-row span:nth-child(4){
            order:4;
        }

        .op-row span:nth-child(5){
            order:5;
        }

        .op-row span:nth-child(6){
            order:6;
        }
    }

    /* ================= GATES ================= */

    .op-gates{
        background:#fff;
        border:1px solid var(--line);
        border-radius:10px;
        padding:1.2rem 1.3rem;
    }

    .op-gate-item{
        margin-bottom:1.15rem;
    }

    .op-gate-item:last-child{
        margin-bottom:0;
    }

    .op-gate-top{
        display:flex;
        align-items:center;
        gap:.6rem;
        margin-bottom:.5rem;
    }

    .op-gate-num{
        font-family:'IBM Plex Mono',monospace;
        font-weight:700;
        font-size:.72rem;
        background:var(--ink);
        color:#fff;
        padding:.15rem .5rem;
        border-radius:4px;
    }

    .op-gate-top strong{
        font-size:.9rem;
        font-weight:600;
        flex:1;
    }

    .op-gate-top span{
        font-family:'IBM Plex Mono',monospace;
        font-size:.76rem;
        color:var(--ink-soft);
    }

    .op-gate-bar{
        height:8px;
        border-radius:2px;
        background:var(--bg);
        display:flex;
        gap:2px;
        overflow:hidden;
        border:1px solid var(--line);
    }

    .op-gate-bar i{
        flex:1;
        background:var(--line-strong);
    }

    .op-gate-bar i.on{
        background:var(--gate-color,var(--teal));
    }

    /* ================= ROSTER + PAYMENT ================= */

    .op-row3{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:1.5rem;
        margin-bottom:1.5rem;
        align-items:start;
    }

    @media (max-width:991px){
        .op-row3{
            grid-template-columns:1fr;
        }
    }

    .op-card{
        background:#fff;
        border:1px solid var(--line);
        border-radius:10px;
        padding:1.2rem 1.3rem;
    }

    .op-roster-item{
        display:flex;
        align-items:center;
        gap:.75rem;
        padding:.65rem 0;
        border-bottom:1px solid var(--line);
    }

    .op-roster-item:last-child{
        border-bottom:none;
    }

    .op-avatar{
        width:36px;
        height:36px;
        border-radius:8px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-family:'IBM Plex Mono',monospace;
        font-weight:700;
        color:#fff;
        font-size:.76rem;
        flex-shrink:0;
    }

    .op-roster-name{
        font-weight:600;
        font-size:.87rem;
        display:block;
    }

    .op-roster-dest{
        font-family:'IBM Plex Mono',monospace;
        font-size:.7rem;
        color:var(--ink-soft);
    }

    .op-roster-status{
        margin-left:auto;
        font-family:'IBM Plex Mono',monospace;
        font-size:.66rem;
        font-weight:600;
        text-transform:uppercase;
        letter-spacing:.05em;
        display:inline-flex;
        align-items:center;
        gap:.35rem;
    }

    .op-roster-status .op-led{
        width:6px;
        height:6px;
        border-radius:50%;
        display:inline-block;
    }

    .op-pay-legend{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:.6rem 0;
        border-bottom:1px solid var(--line);
    }

    .op-pay-legend:last-child{
        border-bottom:none;
    }

    .op-pay-legend .op-pay-label{
        display:flex;
        align-items:center;
        gap:.55rem;
        font-size:.85rem;
        font-weight:600;
    }

    .op-pay-legend .op-pay-dot{
        width:9px;
        height:9px;
        border-radius:2px;
    }

    .op-pay-legend .op-pay-num{
        font-family:'IBM Plex Mono',monospace;
        font-size:.82rem;
    }

    .op-pay-bar{
        height:10px;
        border-radius:3px;
        overflow:hidden;
        display:flex;
        margin-bottom:1rem;
    }

    /* ================= CHART ================= */

    .op-radar{
        background:var(--panel);
        border-radius:10px;
        padding:1.4rem 1.6rem;
    }

    .op-radar .op-panel-head h5{
        color:rgba(255,255,255,.65);
    }

    .op-radar .op-panel-head select{
        background:transparent;
        color:#fff;
        border:1px solid rgba(255,255,255,.2);
        font-family:'IBM Plex Mono',monospace;
        font-size:.75rem;
        border-radius:6px;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width:767px){

        .op-statusbar{
            align-items:flex-start;
            flex-direction:column;
        }

        .op-statusbar .op-actions{
            width:100%;
        }

        .op-statusbar .btn-op{
            width:100%;
            justify-content:center;
        }

        .op-panel-head{
            gap:.5rem;
            flex-wrap:wrap;
        }
    }
</style>


<div class="container-fluid">

    {{-- ================= STATUS BAR ================= --}}
    <div class="op-statusbar">

        <div class="op-brand">
            <span class="op-dot"></span>
            TravelGo · Ops Center
        </div>

        <div class="op-mid">
            {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y · H:i') }} WIB
        </div>

        <div class="op-actions">

            <a href="{{ route('destinasiwisata') }}"
               class="btn-op btn-op-line">
                <i class="mdi mdi-map-marker-radius"></i>
                Lihat Paket
            </a>

        </div>

    </div>


    {{-- ================= DIREKTORI ================= --}}
    <div class="op-directory">

        <a href="{{ route('destinasiwisata') }}" class="op-dir-item">

            <div class="op-dir-icon" style="--dir-color:var(--teal);">
                <i class="mdi mdi-map-marker-radius"></i>
            </div>

            <div>
                <span class="op-dir-label">Paket Wisata</span>
                <small>{{ $totalDestinasi }} aktif</small>
            </div>

        </a>


        <a href="{{ route('hotel') }}" class="op-dir-item">

            <div class="op-dir-icon" style="--dir-color:var(--teal);">
                <i class="mdi mdi-hotel"></i>
            </div>

            <div>
                <span class="op-dir-label">Hotel</span>
                <small>{{ $totalHotels }} aktif</small>
            </div>

        </a>


        <a href="{{ route('booking') }}" class="op-dir-item">

            <div class="op-dir-icon" style="--dir-color:var(--amber);">
                <i class="mdi mdi-ticket-confirmation-outline"></i>
            </div>

            <div>
                <span class="op-dir-label">Booking</span>
                <small>{{ $todayBookingCount }} hari ini</small>
            </div>

        </a>


        <a href="{{ route('datapelanggan') }}" class="op-dir-item">

            <div class="op-dir-icon" style="--dir-color:var(--coral);">
                <i class="mdi mdi-account-group-outline"></i>
            </div>

            <div>
                <span class="op-dir-label">Pelanggan</span>
                <small>{{ $totalPelanggan }} total</small>
            </div>

        </a>


        <a href="{{ route('transportasi') }}" class="op-dir-item">

            <div class="op-dir-icon" style="--dir-color:var(--amber);">
                <i class="mdi mdi-bus-side"></i>
            </div>

            <div>
                <span class="op-dir-label">Armada</span>
                <small>{{ $totalArmada }} unit aktif</small>
            </div>

        </a>


        <a href="{{ route('pendapatan') }}" class="op-dir-item">

            <div class="op-dir-icon" style="--dir-color:var(--coral);">
                <i class="mdi mdi-chart-line"></i>
            </div>

            <div>
                <span class="op-dir-label">Laporan</span>
                <small>Ringkasan bulanan</small>
            </div>

        </a>


        <a href="{{ route('pengaturanweb') }}" class="op-dir-item">

            <div class="op-dir-icon" style="--dir-color:var(--ink);">
                <i class="mdi mdi-cog-outline"></i>
            </div>

            <div>
                <span class="op-dir-label">Pengaturan</span>
                <small>Konfigurasi sistem</small>
            </div>

        </a>

    </div>


    {{-- ================= SCOREBOARD ================= --}}
    <div class="op-scoreboard">

        <div class="op-sign" style="--sign-color:var(--teal);">

            <span class="op-sign-label">
                Total Paket
            </span>

            <div class="op-sign-value">
                {{ $totalDestinasi }}
            </div>

            <span class="op-sign-trend op-up">
                Paket aktif
            </span>

        </div>


        <div class="op-sign" style="--sign-color:var(--amber);">

            <span class="op-sign-label">
                Total Pelanggan
            </span>

            <div class="op-sign-value">
                {{ $totalPelanggan }}
            </div>

            <span class="op-sign-trend op-up">
                Data terdaftar
            </span>

        </div>


        <div class="op-sign" style="--sign-color:var(--coral);">

            <span class="op-sign-label">
                Booking Hari Ini
            </span>

            <div class="op-sign-value">
                {{ $todayBookingCount }}
            </div>

            <span class="op-sign-trend op-up">
                Tanggal hari ini
            </span>

        </div>


        <div class="op-sign" style="--sign-color:var(--ink);">

            <span class="op-sign-label">
                Pendapatan
            </span>

            <div class="op-sign-value">
                Rp{{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>

            <span class="op-sign-trend op-up">
                Transaksi lunas &amp; selesai
            </span>

        </div>

    </div>


    {{-- ================= JADWAL + NOTIFIKASI ================= --}}
    <div class="op-row2">

        {{-- JADWAL --}}
        <div>

            <h5 class="op-section-title">
                Jadwal Keberangkatan Mendatang
            </h5>

            <div class="op-timeline">

                @forelse ($upcomingBookings as $booking)

                    <div class="op-tl-item"
                         style="--tl-color:var(--teal);">

                        <div class="op-tl-date">
                            {{ $booking->tanggal_berangkat->format('d F Y') }}
                        </div>

                        <div class="op-tl-dest">
                            {{ $booking->paket_wisata }}
                        </div>

                        <div class="op-tl-meta">
                            <span>
                                {{ $booking->jumlah_peserta }} pax
                            </span>

                            <span>
                                {{ $booking->status }}
                            </span>
                        </div>

                    </div>

                @empty

                    <div class="op-tl-item"
                         style="--tl-color:var(--amber);">

                        <div class="op-tl-dest">
                            Belum ada jadwal keberangkatan mendatang.
                        </div>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- NOTIFIKASI --}}
        <div>

            <h5 class="op-section-title">
                Notifikasi &amp; Peringatan
            </h5>

            <div class="op-alerts">

                <div class="op-alert-item">

                    <div class="op-alert-icon"
                         style="--al-color:var(--coral);">

                        <i class="mdi mdi-alert-outline"></i>

                    </div>

                    <div class="op-alert-text">

                        Pembayaran DP paket Labuan Bajo (Andi)
                        jatuh tempo besok.

                        <span class="op-alert-time">
                            2 jam lalu
                        </span>

                    </div>

                </div>


                <div class="op-alert-item">

                    <div class="op-alert-icon"
                         style="--al-color:var(--teal);">

                        <i class="mdi mdi-bell-outline"></i>

                    </div>

                    <div class="op-alert-text">

                        3 booking baru menunggu konfirmasi admin.

                        <span class="op-alert-time">
                            4 jam lalu
                        </span>

                    </div>

                </div>


                <div class="op-alert-item">

                    <div class="op-alert-icon"
                         style="--al-color:var(--amber);">

                        <i class="mdi mdi-seat-outline"></i>

                    </div>

                    <div class="op-alert-text">

                        Kuota paket Raja Ampat tersisa 2 slot.

                        <span class="op-alert-time">
                            Kemarin
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================= PAPAN KEBERANGKATAN ================= --}}
    <div class="op-split">

        <div>

            <div class="op-panel-head">

                <h5>
                    Papan Keberangkatan — Booking Hari Ini
                </h5>

                <a href="{{ route('booking') }}">
                    Lihat semua →
                </a>

            </div>


            <div class="op-board">

                <div class="op-board-cols">

                    <span>Kode</span>
                    <span>Penumpang</span>
                    <span>Tujuan</span>
                    <span>Tanggal</span>
                    <span>Status</span>
                    <span>Gate</span>

                </div>


                @forelse ($todayBookings as $booking)

                    <div class="op-row">

                        <span class="op-code">
                            {{ $booking->kode_booking }}
                        </span>

                        <span>
                            {{ $booking->pelanggan?->nama_pelanggan ?? $booking->nama_pelanggan }}
                        </span>

                        <span>
                            {{ $booking->paket_wisata }}
                        </span>

                        <span>
                            {{ $booking->tanggal_berangkat->format('d M') }}
                        </span>

                        <span class="op-status">

                            <i class="op-led op-led-green"></i>

                            {{ $booking->status }}

                        </span>

                        <span class="op-gate">
                            -
                        </span>

                    </div>

                @empty

                    <div class="op-row">
                        <span>
                            Tidak ada booking untuk hari ini.
                        </span>
                    </div>

                @endforelse

            </div>

        </div>


        {{-- GATE --}}
        <div>

            <div class="op-panel-head">

                <h5>
                    Okupansi Gate
                </h5>

            </div>


            <div class="op-gates">

                <div class="op-gate-item"
                     style="--gate-color:var(--teal);">

                    <div class="op-gate-top">

                        <span class="op-gate-num">
                            G01
                        </span>

                        <strong>
                            Bali 3 Hari
                        </strong>

                        <span>
                            90%
                        </span>

                    </div>

                    <div class="op-gate-bar">

                        @for($i=0;$i<10;$i++)

                            <i class="{{ $i < 9 ? 'on' : '' }}"></i>

                        @endfor

                    </div>

                </div>


                <div class="op-gate-item"
                     style="--gate-color:var(--amber);">

                    <div class="op-gate-top">

                        <span class="op-gate-num">
                            G02
                        </span>

                        <strong>
                            Lombok
                        </strong>

                        <span>
                            75%
                        </span>

                    </div>

                    <div class="op-gate-bar">

                        @for($i=0;$i<10;$i++)

                            <i class="{{ $i < 7 ? 'on' : '' }}"></i>

                        @endfor

                    </div>

                </div>


                <div class="op-gate-item"
                     style="--gate-color:var(--coral);">

                    <div class="op-gate-top">

                        <span class="op-gate-num">
                            G03
                        </span>

                        <strong>
                            Raja Ampat
                        </strong>

                        <span>
                            65%
                        </span>

                    </div>

                    <div class="op-gate-bar">

                        @for($i=0;$i<10;$i++)

                            <i class="{{ $i < 6 ? 'on' : '' }}"></i>

                        @endfor

                    </div>

                </div>


                <div class="op-gate-item"
                     style="--gate-color:var(--ink);">

                    <div class="op-gate-top">

                        <span class="op-gate-num">
                            G04
                        </span>

                        <strong>
                            Labuan Bajo
                        </strong>

                        <span>
                            55%
                        </span>

                    </div>

                    <div class="op-gate-bar">

                        @for($i=0;$i<10;$i++)

                            <i class="{{ $i < 5 ? 'on' : '' }}"></i>

                        @endfor

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ================= CHART ================= --}}
    <div class="op-radar">

        <div class="op-panel-head">

            <h5>
                Traffic Booking Bulanan
            </h5>

            <select class="form-select form-select-sm w-auto">

                <option>2026</option>
                <option>2025</option>

            </select>

        </div>

        <canvas id="bookingChart" height="80"></canvas>

    </div>

</div>


{{-- ================= CHART JS ================= --}}
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('bookingChart');

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    const ctx = canvas.getContext('2d');

    const gradient = ctx.createLinearGradient(
        0,
        0,
        0,
        260
    );

    gradient.addColorStop(
        0,
        'rgba(244,201,93,.30)'
    );

    gradient.addColorStop(
        1,
        'rgba(244,201,93,0)'
    );


    new Chart(canvas, {

        type:'line',

        data:{

            labels:[
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des'
            ],

            datasets:[{

                label:'Booking',

                data:@json($monthlyChart),

                borderColor:'#F4C95D',

                backgroundColor:gradient,

                fill:true,

                tension:.35,

                pointBackgroundColor:'#1E293B',

                pointBorderColor:'#F4C95D',

                pointBorderWidth:2,

                pointRadius:3,

                pointHoverRadius:5

            }]

        },


        options:{

            responsive:true,

            interaction:{
                intersect:false,
                mode:'index'
            },

            plugins:{

                legend:{
                    display:false
                },

                tooltip:{

                    backgroundColor:'#FFFFFF',

                    titleColor:'#1E293B',

                    bodyColor:'#1E293B',

                    borderColor:'#E2E8F0',

                    borderWidth:1,

                    padding:10,

                    cornerRadius:6,

                    titleFont:{
                        family:'IBM Plex Mono'
                    },

                    bodyFont:{
                        family:'IBM Plex Mono'
                    }

                }

            },


            scales:{

                x:{

                    grid:{
                        color:'rgba(255,255,255,.06)'
                    },

                    ticks:{

                        color:'rgba(255,255,255,.55)',

                        font:{
                            family:'IBM Plex Mono',
                            size:10
                        }

                    }

                },


                y:{

                    grid:{
                        color:'rgba(255,255,255,.06)'
                    },

                    beginAtZero:true,

                    ticks:{

                        color:'rgba(255,255,255,.55)',

                        font:{
                            family:'IBM Plex Mono',
                            size:10
                        }

                    }

                }

            }

        }

    });

});

</script>

@endsection
