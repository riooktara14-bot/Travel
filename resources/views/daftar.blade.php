<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Travel GO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <style>
        *{box-sizing:border-box}

        body{
            margin:0;
            font-family:Arial,sans-serif;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
            overflow-x:hidden;
            padding:30px 0;

            /* ===== BACKGROUND UTAMA ===== */
            background:
                radial-gradient(1000px 600px at 10% -10%, rgba(124,184,255,.35), transparent 60%),
                radial-gradient(800px 500px at 95% 10%, rgba(255,106,61,.22), transparent 60%),
                radial-gradient(700px 500px at 50% 110%, rgba(0,143,213,.25), transparent 60%),
                linear-gradient(160deg, #061428 0%, #0b2340 45%, #12345c 100%);
        }

        /* bintang-bintang kecil, senada dengan hero halaman transportasi */
        body::before{
            content:"";
            position:fixed; inset:0;
            background-image:
                radial-gradient(2px 2px at 15% 20%, rgba(255,255,255,.5), transparent),
                radial-gradient(1.5px 1.5px at 40% 10%, rgba(255,255,255,.4), transparent),
                radial-gradient(1.5px 1.5px at 65% 30%, rgba(255,255,255,.35), transparent),
                radial-gradient(1.5px 1.5px at 85% 15%, rgba(255,255,255,.3), transparent),
                radial-gradient(1.5px 1.5px at 25% 70%, rgba(255,255,255,.25), transparent),
                radial-gradient(1.5px 1.5px at 75% 80%, rgba(255,255,255,.25), transparent);
            pointer-events:none;
            z-index:0;
        }

        /* siluet gunung di bagian bawah, biar ada kesan "travel" */
        .mountains{
            position:fixed; left:0; right:0; bottom:-2px; width:100%;
            z-index:0; opacity:.9; pointer-events:none;
        }

        .register-wrapper{
            width:100%;
            max-width:1050px;
            padding:30px;
            position:relative;
            z-index:2;
        }
        .register-box{
            display:flex;
            background:#fff;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 30px 60px -20px rgba(3,12,26,.55);
        }
        .register-info{
            width:42%;
            padding:55px 45px;
            background:linear-gradient(145deg,#0066b3,#008fd5);
            color:#fff;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }
        .register-info img{
            width:150px;
            margin-bottom:25px;
        }
        .register-info h2{
            font-size:32px;
            margin:0 0 15px;
        }
        .register-info p{
            line-height:1.7;
            opacity:.9;
        }
        .register-info ul{
            padding:0;
            list-style:none;
            margin-top:20px;
        }
        .register-info li{
            margin:14px 0;
        }
        .register-form{
            width:58%;
            padding:45px;
        }
        .register-form h2{
            margin:0 0 8px;
            font-size:30px;
            color:#222;
        }
        .subtitle{
            color:#777;
            margin-bottom:25px;
        }
        .form-group{
            margin-bottom:17px;
        }
        .form-group label{
            display:block;
            margin-bottom:7px;
            font-weight:600;
            color:#333;
        }
        .form-control-custom{
            width:100%;
            height:48px;
            border:1px solid #ddd;
            border-radius:10px;
            padding:0 15px;
            outline:none;
            transition:.3s;
        }
        .form-control-custom:focus{
            border-color:#008fd5;
            box-shadow:0 0 0 3px rgba(0,143,213,.1);
        }
        .register-btn{
            width:100%;
            height:50px;
            border:0;
            border-radius:10px;
            background:#ff6a3d;
            color:#fff;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
            margin-top:5px;
        }
        .register-btn:hover{
            background:#f45b2e;
        }
        .login-text{
            text-align:center;
            margin-top:20px;
            color:#777;
        }
        .login-text a{
            color:#0085c8;
            font-weight:bold;
            text-decoration:none;
        }
        @media(max-width:768px){
            .register-wrapper{padding:15px}
            .register-box{display:block}
            .register-info,
            .register-form{
                width:100%;
            }
            .register-info{
                padding:30px;
                text-align:center;
            }
            .register-info img{
                margin:0 auto 15px;
            }
            .register-info ul{
                display:none;
            }
            .register-form{
                padding:30px 25px;
            }
        }
    </style>
</head>

<body>

<!-- siluet gunung dekoratif -->
<svg class="mountains" viewBox="0 0 1440 220" preserveAspectRatio="none">
    <path d="M0,220 L0,140 L180,60 L260,110 L360,20 L480,120 L620,50 L740,130 L860,70 L1000,150 L1140,40 L1260,120 L1440,60 L1440,220 Z" fill="#0a1e38" opacity="0.9"/>
    <path d="M0,220 L0,170 L220,110 L340,150 L520,80 L660,160 L820,100 L980,180 L1160,90 L1300,160 L1440,110 L1440,220 Z" fill="#0e2947" opacity="0.95"/>
</svg>

<div class="register-wrapper">
    <div class="register-box">

        <!-- INFORMASI -->
        <div class="register-info">
            <img src="{{ asset('assets2/img/logo.PNG') }}" alt="Travel GO">

            <h2>Jelajahi Indonesia</h2>

            <p>
                Buat akun Travel GO dan nikmati kemudahan
                mencari destinasi wisata, transportasi, serta
                melakukan booking perjalanan.
            </p>

            <ul>
                <li>✈️ Temukan destinasi wisata</li>
                <li>🏨 Pilih perjalanan favorit</li>
                <li>🎫 Booking lebih mudah</li>
            </ul>
        </div>

        <!-- FORM DAFTAR -->
        <div class="register-form">

            <h2>Buat Akun</h2>
            <p class="subtitle">
                Daftar sekarang untuk mulai menggunakan Travel GO
            </p>

            <form action="{{ route('daftar') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama"
                        class="form-control-custom"
                        placeholder="Masukkan nama lengkap"
                        required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control-custom"
                        placeholder="Masukkan email"
                        required>
                </div>

                <div class="form-group">
                    <label>Nomor HP</label>
                    <input
                        type="tel"
                        name="no_hp"
                        class="form-control-custom"
                        placeholder="Contoh: 08123456789"
                        required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control-custom"
                        placeholder="Buat password"
                        required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control-custom"
                        placeholder="Ulangi password"
                        required>
                </div>

                <button type="submit" class="register-btn">Daftar sekarang</button>

            </form>

            <div class="login-text">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>

        </div>

    </div>
</div>

</body>
</html>
