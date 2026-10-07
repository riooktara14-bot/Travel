<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Masuk - Travel GO</title>
<style>

*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Arial,sans-serif;min-height:100vh;background:linear-gradient(135deg,#eaf7ff,#f8fbff);display:flex;align-items:center;justify-content:center;padding:30px}
.login-box{width:100%;max-width:950px;min-height:560px;background:#fff;border-radius:22px;overflow:hidden;display:flex;box-shadow:0 15px 50px rgba(0,0,0,.12)}
.login-left{width:45%;padding:50px;background:linear-gradient(145deg,#087fbd,#05a6d8);color:#fff;display:flex;flex-direction:column;justify-content:center}
.login-left img{width:130px;height:auto;object-fit:contain;margin-bottom:30px}
.login-left h1{font-size:34px;margin-bottom:15px}
.login-left p{line-height:1.7;opacity:.9;margin-bottom:25px}
.login-left ul{list-style:none}
.login-left li{margin:15px 0;font-size:15px}
.login-right{width:55%;padding:55px 60px;display:flex;flex-direction:column;justify-content:center}
.login-right h2{font-size:30px;color:#222;margin-bottom:8px}
.desc{color:#777;margin-bottom:30px}
.form-group{margin-bottom:20px}
.form-group label{display:block;margin-bottom:8px;font-weight:600;color:#333}
.form-control{width:100%;height:48px;border:1px solid #ddd;border-radius:9px;padding:0 15px;outline:none;font-size:14px}
.form-control:focus{border-color:#078fc9;box-shadow:0 0 0 3px rgba(7,143,201,.1)}
.form-row{display:flex;justify-content:space-between;align-items:center;margin:-5px 0 20px}
.remember{font-size:13px;color:#666}
.remember input{margin-right:5px}
.forgot{font-size:13px;color:#078fc9;text-decoration:none}
.btn-login{width:100%;height:48px;border:0;border-radius:9px;background:#ff6b3d;color:#fff;font-weight:bold;cursor:pointer;font-size:15px}
.btn-login:hover{background:#ed572b}
.register-link{text-align:center;margin-top:22px;color:#777;font-size:14px}
.register-link a{color:#078fc9;font-weight:bold;text-decoration:none}
.back-home{text-align:center;margin-top:15px}
.back-home a{color:#777;text-decoration:none;font-size:13px}
.error-msg{background:#ffe6e6;color:#c0392b;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:18px}
.field-error{color:#c0392b;font-size:12px;margin-top:5px}
@media(max-width:768px){
body{padding:15px}
.login-box{display:block}
.login-left,.login-right{width:100%}
.login-left{padding:35px 30px}
.login-left ul{display:none}
.login-right{padding:40px 25px}
}
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

</style>
</head>
<body>

<div class="login-box">

    <div class="login-left">
        <img src="{{ asset('assets2/img/logo.PNG') }}" alt="Travel GO">
        <h1>Selamat Datang!</h1>
        <p>
            Masuk ke akun Travel GO dan mulai rencanakan
            perjalanan wisata impianmu dengan lebih mudah.
        </p>
        <ul>
            <li>✈️ Temukan destinasi menarik</li>
            <li>🚗 Pilih transportasi perjalanan</li>
            <li>🎫 Booking perjalanan dengan mudah</li>
        </ul>
    </div>

    <div class="login-right">
        <h2>Masuk ke Akun</h2>
        <p class="desc">Silakan masukkan email dan password kamu.</p>

        @if(session('success'))
            <div class="error-msg" style="background:#e6ffed;color:#1a7f37;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                       placeholder="Masukkan email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Masukkan password" required>
            </div>

            <div class="form-row">
                <label class="remember">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>

                <a href="#" class="forgot">Lupa password?</a>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="register-link">
            Belum punya akun?
            <a href="{{ route('daftar') }}">Daftar sekarang</a>
        </div>

        <div class="back-home">
            <a href="{{ route('index') }}">← Kembali ke halaman utama</a>
        </div>
    </div>

</div>

</body>
</html>
