<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Travel GO</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0b2a43;
            --sea: #0a8fb8;
            --coral: #ff5d32;
            --ink: #16303f;
            --mute: #5f7482;
            --line: #d5e0e7;
            --paper: #eef4f7;
            --field: #f8fbfc;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            color: var(--ink);
            background: var(--paper);
            min-height: 100vh;
            padding: 32px 16px;
            display: grid;
            place-items: center;
        }

        /* ===== LATAR PEMANDANGAN ===== */
        .scenery {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* ===== KARTU TIKET ===== */
        .booking-box {
            width: 100%;
            max-width: 1080px;
            display: grid;
            grid-template-columns: 340px 1fr;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(11, 42, 67, .16);
        }

        /* Bagian kiri = stub tiket */
        .booking-left {
            position: relative;
            background: var(--navy);
            color: #fff;
            padding: 44px 36px;
            display: flex;
            flex-direction: column;
        }

        /* tepi perforasi tiket */
        .booking-left::after {
            content: "";
            position: absolute;
            top: 0; right: 0; bottom: 0;
            width: 10px;
            background: radial-gradient(circle at 100% 50%, #fff 0 5px, transparent 5.5px) 0 0 / 10px 20px repeat-y;
        }

        .logo-chip {
            align-self: flex-start;
            background: #fff;
            border-radius: 12px;
            padding: 8px 14px;
            margin-bottom: 36px;
        }

        .logo-chip img {
            display: block;
            width: 110px;
            height: auto;
        }

        .booking-left h1 {
            font-size: 30px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -.02em;
            margin-bottom: 12px;
        }

        .booking-left p {
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255, 255, 255, .78);
            margin-bottom: 32px;
        }

        .steps {
            list-style: none;
            counter-reset: step;
            margin-top: auto;
            border-top: 1px dashed rgba(255, 255, 255, .28);
            padding-top: 24px;
        }

        .steps li {
            counter-increment: step;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            font-size: 13.5px;
            line-height: 1.5;
            color: rgba(255, 255, 255, .9);
            margin-bottom: 16px;
        }

        .steps li::before {
            content: counter(step);
            flex: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--coral);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: grid;
            place-items: center;
        }

        /* ===== FORM ===== */
        .booking-right {
            padding: 44px 48px;
        }

        .booking-right h2 {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .desc {
            color: var(--mute);
            font-size: 14px;
            margin: 6px 0 26px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
            margin: 26px 0 16px;
        }

        .section-title::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .section-title:first-of-type { margin-top: 0; }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .full { grid-column: 1 / -1; }

        .form-group label,
        .group-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .opt {
            font-weight: 500;
            color: var(--mute);
        }

        .form-control {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            font: inherit;
            font-size: 14px;
            color: var(--ink);
            background: var(--field);
            border: 1.5px solid var(--line);
            border-radius: 10px;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-control::placeholder { color: #98a9b5; }

        .form-control:hover { border-color: #a9c3d1; }

        .form-control:focus {
            background: #fff;
            border-color: var(--sea);
            box-shadow: 0 0 0 4px rgba(10, 143, 184, .14);
        }

        textarea.form-control {
            height: 96px;
            padding: 12px 14px;
            resize: vertical;
        }

        select.form-control { cursor: pointer; }

        input[type="file"].form-control {
            padding: 6px;
            height: auto;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            font: inherit;
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            background: #e3eef4;
            border: 0;
            border-radius: 7px;
            padding: 9px 14px;
            margin-right: 12px;
            cursor: pointer;
        }

        /* pilihan metode pembayaran */
        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip { position: relative; }

        .chip input {
            position: absolute;
            opacity: 0;
            inset: 0;
            cursor: pointer;
        }

        .chip span {
            display: block;
            padding: 11px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--ink);
            background: var(--field);
            border: 1.5px solid var(--line);
            border-radius: 10px;
            transition: background .2s, color .2s, border-color .2s;
        }

        .chip:hover span { border-color: #a9c3d1; }

        .chip input:checked + span {
            background: var(--navy);
            border-color: var(--navy);
            color: #fff;
        }

        .chip input:focus-visible + span {
            outline: 3px solid rgba(10, 143, 184, .45);
            outline-offset: 2px;
        }

        /* ===== ALERT ===== */
        .error-msg,
        .success-msg {
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 22px;
            border-left: 4px solid;
        }

        .error-msg {
            background: #fff2ef;
            color: #a5321a;
            border-color: #e5533a;
        }

        .error-msg ul { padding-left: 18px; }

        .success-msg {
            background: #edf9f1;
            color: #17693a;
            border-color: #2fa35d;
        }

        /* ===== TOMBOL ===== */
        .btn-booking {
            width: 100%;
            height: 52px;
            margin-top: 28px;
            border: 0;
            border-radius: 12px;
            background: var(--coral);
            color: #fff;
            font: inherit;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .15s;
        }

        .btn-booking:hover { background: #ea4d22; }
        .btn-booking:active { transform: scale(.99); }

        .btn-booking:focus-visible {
            outline: 3px solid rgba(255, 93, 50, .4);
            outline-offset: 3px;
        }

        .back-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-home a {
            color: var(--mute);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .back-home a:hover { color: var(--sea); text-decoration: underline; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .booking-box {
                grid-template-columns: 1fr;
                max-width: 700px;
            }

            .booking-left { padding: 36px 32px 40px; }

            .booking-left::after {
                top: auto;
                left: 0;
                width: auto;
                height: 10px;
                background: radial-gradient(circle at 50% 100%, #fff 0 5px, transparent 5.5px) 0 0 / 20px 10px repeat-x;
            }

            .logo-chip { margin-bottom: 24px; }
            .booking-left p { margin-bottom: 0; }
            .steps { display: none; }
            .booking-right { padding: 36px 32px; }
        }

        @media (max-width: 600px) {
            body { padding: 12px; align-items: start; }
            .booking-box { border-radius: 16px; }
            .booking-left { padding: 28px 22px 32px; }
            .booking-left h1 { font-size: 25px; }
            .booking-right { padding: 28px 20px; }
            .booking-right h2 { font-size: 24px; }
            .grid { grid-template-columns: 1fr; gap: 14px; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>

<body>

<!-- LATAR PEMANDANGAN (SVG, tanpa file gambar) -->
<svg class="scenery" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
    <defs>
        <linearGradient id="sky" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#0b2a43"/>
            <stop offset=".45" stop-color="#2f7397"/>
            <stop offset=".72" stop-color="#f4b48a"/>
            <stop offset="1" stop-color="#ffd9a8"/>
        </linearGradient>
        <radialGradient id="glow" cx=".5" cy=".5" r=".5">
            <stop offset="0" stop-color="#fff1cf" stop-opacity=".95"/>
            <stop offset="1" stop-color="#fff1cf" stop-opacity="0"/>
        </radialGradient>
        <linearGradient id="sea" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#3b8fb3"/>
            <stop offset="1" stop-color="#0b2f4a"/>
        </linearGradient>
    </defs>

    <rect width="1440" height="900" fill="url(#sky)"/>

    <!-- matahari -->
    <circle cx="1010" cy="560" r="230" fill="url(#glow)"/>
    <circle cx="1010" cy="560" r="62" fill="#ffe9bd"/>

    <!-- awan -->
    <g fill="#fff" opacity=".22">
        <ellipse cx="260" cy="200" rx="150" ry="16"/>
        <ellipse cx="350" cy="222" rx="110" ry="12"/>
        <ellipse cx="1120" cy="150" rx="170" ry="15"/>
        <ellipse cx="1230" cy="174" rx="110" ry="11"/>
    </g>

    <!-- gunung jauh -->
    <path d="M0 640 L0 520 Q90 440 170 500 Q270 380 380 490 Q480 420 580 520 Q700 430 800 540 L900 600 L1440 620 L1440 660 L0 660 Z"
          fill="#4a7fa0" opacity=".75"/>
    <!-- gunung tengah -->
    <path d="M0 680 L0 590 Q140 470 260 580 Q380 500 500 600 L640 660 L1440 680 L1440 700 L0 700 Z"
          fill="#2a5d80"/>
    <path d="M900 690 Q1050 560 1180 640 Q1290 560 1440 620 L1440 700 L900 700 Z" fill="#2a5d80"/>

    <!-- laut -->
    <rect y="660" width="1440" height="240" fill="url(#sea)"/>

    <!-- pantulan matahari -->
    <g stroke="#ffe3b0" stroke-linecap="round" opacity=".7">
        <line x1="960" y1="690" x2="1060" y2="690" stroke-width="5"/>
        <line x1="940" y1="715" x2="1080" y2="715" stroke-width="4"/>
        <line x1="970" y1="742" x2="1050" y2="742" stroke-width="4"/>
        <line x1="930" y1="772" x2="1090" y2="772" stroke-width="3"/>
        <line x1="975" y1="805" x2="1045" y2="805" stroke-width="3"/>
    </g>

    <!-- tanjung depan -->
    <path d="M0 900 L0 760 Q120 700 260 760 Q380 800 460 900 Z" fill="#0f334f"/>
    <path d="M1440 900 L1440 780 Q1330 730 1210 790 Q1130 830 1090 900 Z" fill="#0f334f"/>
</svg>

<div class="booking-box">

    <!-- INFORMASI TRAVEL -->
    <aside class="booking-left">

        <div class="logo-chip">
            <img src="{{ asset('assets2/img/logo.PNG') }}" alt="Travel GO">
        </div>

        <h1>Pesan perjalananmu</h1>

        <p>
            Isi data di samping untuk memesan paket wisata bersama Travel GO.
            Tim kami akan menghubungi kamu untuk konfirmasi.
        </p>

        <ol class="steps">
            <li>Isi data pemesan dan pilih destinasi</li>
            <li>Tim Travel GO menghubungi kamu untuk konfirmasi</li>
            <li>Selesaikan pembayaran, lalu berangkat</li>
        </ol>

    </aside>


    <!-- FORM BOOKING -->
    <main class="booking-right">

        <h2>Form booking</h2>
        <p class="desc">Lengkapi data pemesanan kamu.</p>

        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error-msg">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking1.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- DATA PEMESAN -->
            <div class="section-title">Data pemesan</div>

            <div class="grid">

                <div class="form-group">
                    <label for="nama">Nama lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control"
                           placeholder="Nama kamu" value="{{ old('nama') }}" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="Email aktif" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="telepon">No. telepon</label>
                    <input type="tel" id="telepon" name="telepon" class="form-control"
                           placeholder="08xxxxxxxxxx" value="{{ old('telepon') }}" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_orang">Jumlah orang</label>
                    <input type="number" id="jumlah_orang" name="jumlah_orang" class="form-control"
                           min="1" placeholder="1" value="{{ old('jumlah_orang') }}" required>
                </div>

            </div>


            <!-- PERJALANAN -->
            <div class="section-title">Perjalanan</div>

            <div class="grid">

                <div class="form-group">
                    <label for="destinasi">Destinasi</label>
                    <select id="destinasi" name="destinasi" class="form-control" required>
                        <option value="">Pilih destinasi</option>
                        @foreach ($destinasi as $item)
                            <option value="{{ $item->nama_destinasi }}" @selected(old('destinasi') === $item->nama_destinasi)>
                                {{ $item->nama_destinasi }} - {{ $item->lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal_berangkat">Tanggal berangkat</label>
                    <input type="date" id="tanggal_berangkat" name="tanggal_berangkat" class="form-control"
                           value="{{ old('tanggal_berangkat') }}" min="{{ now()->toDateString() }}" required>
                </div>

                <div class="form-group full">
                    <label for="transportasi_id">Transportasi <span class="opt">(opsional)</span></label>
                    <select id="transportasi_id" name="transportasi_id" class="form-control">
                        <option value="">Pilih transportasi</option>
                        @foreach ($transportasis as $transportasi)
                            <option value="{{ $transportasi->id }}" @selected(old('transportasi_id') == $transportasi->id)>
                                {{ $transportasi->nama_transportasi }} - {{ $transportasi->jenis_transportasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>


            <!-- PEMBAYARAN -->
            <div class="section-title">Pembayaran</div>

            <div class="grid">

                <div class="form-group full">
                    <span class="group-label">Metode pembayaran <span class="opt">(opsional)</span></span>
                    <div class="chips">
                        @foreach (['Transfer Bank', 'QRIS', 'E-Wallet', 'Kartu Kredit'] as $metode)
                            <label class="chip">
                                <input type="radio" name="metode_pembayaran" value="{{ $metode }}"
                                       @checked(old('metode_pembayaran') === $metode)>
                                <span>{{ $metode }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="form-group full">
                    <label for="payment_proof">Bukti pembayaran <span class="opt">(opsional, JPG, PNG, atau PDF)</span></label>
                    <input type="file" id="payment_proof" name="payment_proof" class="form-control"
                           accept=".jpg,.jpeg,.png,.pdf">
                </div>

                <div class="form-group full">
                    <label for="catatan">Catatan <span class="opt">(opsional)</span></label>
                    <textarea id="catatan" name="catatan" class="form-control"
                              placeholder="Permintaan khusus, dll.">{{ old('catatan') }}</textarea>
                </div>

            </div>

            <button type="submit" class="btn-booking">Kirim booking</button>

        </form>

        <div class="back-home">
            <a href="{{ route('index') }}">← Kembali ke halaman utama</a>
        </div>

    </main>

</div>

</body>
</html>
