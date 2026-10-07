<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hubungi Kami</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --navy-900:#061428;
    --navy-800:#0b2340;
    --navy-700:#12345c;
    --blue-500:#2f7de1;
    --blue-300:#7cb8ff;
    --orange-500:#ff6a3d;
    --orange-600:#f2531f;
    --green-500:#1fa96b;
    --cream:#fff9f2;
    --ink:#0b1c2c;
    --muted:#7a8ba0;
    --line:#e7edf3;
    --radius-lg:22px;
    --radius-md:14px;
    --shadow-soft:0 10px 24px -12px rgba(3,12,26,.14);
  }
  *{box-sizing:border-box;}
  body{margin:0;font-family:'Manrope',sans-serif;background:var(--cream);color:var(--ink);}
  h1,h2,h3,.display{font-family:'Plus Jakarta Sans',sans-serif;}
  a{color:inherit;}
  .wrap{max-width:1180px;margin:0 auto;padding:0 28px;}

  /* ===== TOP NAV ===== */
  .topnav{background:linear-gradient(160deg, var(--navy-900) 0%, var(--navy-800) 100%);padding:16px 0;}
  .topnav .wrap{display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}
  .brand{display:flex;align-items:center;gap:9px;color:#fff;font-weight:800;font-size:19px;}
  .brand svg{display:block;}
  .topnav-cta{display:flex;gap:10px;align-items:center;}

  .nav-links{display:flex;align-items:center;}
  .nav-links ul.onepage-menu{display:flex;align-items:center;gap:4px;list-style:none;margin:0;padding:0;}
  .nav-links ul.onepage-menu li{margin:0;}
  .nav-links ul.onepage-menu li a{
    color:rgba(255,255,255,.82);text-decoration:none;font-size:14px;font-weight:600;
    padding:8px 13px;border-radius:18px;transition:.2s;white-space:nowrap;display:inline-block;
  }
  .nav-links ul.onepage-menu li a:hover{background:rgba(255,255,255,.1);color:#fff;}
  .nav-links ul.onepage-menu li.current-menu-item a{background:rgba(255,255,255,.14);color:#fff;}

  .btn-ghost-sm{
    color:#fff;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.25);
    padding:8px 16px;border-radius:18px;font-weight:700;font-size:13px;text-decoration:none;
  }
  .btn-solid-sm{
    background:linear-gradient(135deg,var(--orange-500),var(--orange-600));
    color:#fff;padding:9px 18px;border-radius:18px;font-weight:700;font-size:13px;
    text-decoration:none;box-shadow:0 8px 16px -6px rgba(255,106,61,.5);
  }

  /* ===== HEADER ===== */
  .page-head{background:var(--navy-800);padding:44px 0 90px;color:#fff;position:relative;overflow:hidden;}
  .page-head::before{
    content:"";position:absolute;inset:0;
    background:radial-gradient(650px 320px at 85% -10%, rgba(255,106,61,.18), transparent 65%),
               radial-gradient(600px 300px at 5% 0%, rgba(124,184,255,.2), transparent 60%);
    pointer-events:none;
  }
  .page-head .inner{position:relative;z-index:2;text-align:center;}
  .crumb{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--blue-300);margin-bottom:16px;justify-content:center;flex-wrap:wrap;}
  .crumb a{color:var(--blue-300);text-decoration:none;font-weight:600;}
  .crumb a:hover{text-decoration:underline;}
  .crumb i{font-size:9px;color:rgba(255,255,255,.4);}
  .crumb span{color:rgba(255,255,255,.55);}
  .page-head h1{font-size:34px;font-weight:800;margin:0 0 10px;letter-spacing:-.4px;}
  .page-head p{color:var(--blue-300);font-size:15px;max-width:460px;margin:0 auto;line-height:1.6;}

  /* ===== QUICK CONTACT CARDS (mengambang di atas header) ===== */
  .quick-grid{
    display:grid;grid-template-columns:repeat(3,1fr);gap:20px;
    margin-top:-56px;position:relative;z-index:3;
  }
  .quick-card{
    background:#fff;border-radius:18px;box-shadow:var(--shadow-soft);border:1px solid var(--line);
    padding:24px;display:flex;flex-direction:column;gap:10px;
  }
  .quick-icon{
    width:44px;height:44px;border-radius:12px;
    background:linear-gradient(135deg,var(--navy-800),var(--navy-700));
    color:#fff;display:flex;align-items:center;justify-content:center;font-size:18px;
  }
  .quick-card h4{margin:0;font-size:15px;font-weight:800;}
  .quick-card p{margin:0;font-size:13px;color:var(--muted);line-height:1.6;}
  .quick-card .link{
    margin-top:2px;font-size:13.5px;font-weight:700;color:var(--blue-500);text-decoration:none;
    display:inline-flex;align-items:center;gap:6px;
  }
  .quick-card .link:hover{text-decoration:underline;}

  /* ===== KONTEN ===== */
  .content{display:grid;grid-template-columns:1fr 380px;gap:26px;padding:50px 0 70px;}
  .card{
    background:#fff;border-radius:var(--radius-lg);box-shadow:var(--shadow-soft);
    padding:30px;border:1px solid var(--line);
  }
  .card h3{font-size:18px;font-weight:800;margin:0 0 6px;}
  .card .card-sub{font-size:13.5px;color:var(--muted);margin:0 0 22px;}

  /* ----- Form ----- */
  .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
  .form-group{display:flex;flex-direction:column;gap:7px;}
  .form-group.full{grid-column:1 / -1;}
  .form-group label{font-size:12.5px;font-weight:700;color:var(--navy-800);}
  .form-group input, .form-group select, .form-group textarea{
    border:1px solid var(--line);border-radius:12px;padding:12px 14px;
    font-family:inherit;font-size:14px;color:var(--ink);outline:none;transition:.15s;background:#fff;
  }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus{
    border-color:var(--blue-500);box-shadow:0 0 0 3px rgba(47,125,225,.12);
  }
  .form-group textarea{resize:vertical;min-height:120px;font-family:inherit;}
  .topic-picker{display:flex;gap:8px;flex-wrap:wrap;}
  .topic-chip{
    border:1px solid var(--line);background:#fff;color:#5c7086;
    padding:8px 14px;border-radius:20px;font-size:13px;font-weight:700;cursor:pointer;transition:.15s;
  }
  .topic-chip:hover{background:#f2f6fb;}
  .topic-chip.is-active{background:var(--navy-800);border-color:var(--navy-800);color:#fff;}
  .submit-btn{
    margin-top:6px;border:none;border-radius:14px;padding:15px;
    background:linear-gradient(135deg,var(--orange-500),var(--orange-600));color:#fff;
    font-weight:800;font-size:15px;cursor:pointer;
    box-shadow:0 14px 26px -10px rgba(255,106,61,.55);
  }
  .submit-btn:hover{filter:brightness(1.05);}
  .form-note{font-size:12px;color:var(--muted);text-align:center;margin-top:2px;}

  /* ----- Sidebar info ----- */
  .info-row{display:flex;gap:14px;padding:16px 0;border-bottom:1px solid var(--line);}
  .info-row:last-of-type{border-bottom:none;}
  .info-ico{
    width:38px;height:38px;border-radius:11px;background:#eef5ff;color:var(--blue-500);
    display:flex;align-items:center;justify-content:center;font-size:15px;flex:0 0 auto;
  }
  .info-body .t{font-weight:800;font-size:13.5px;}
  .info-body .s{font-size:12.5px;color:var(--muted);margin-top:2px;line-height:1.6;}
  .info-body a{color:var(--blue-500);text-decoration:none;font-weight:700;}
  .info-body a:hover{text-decoration:underline;}

  .hours-list{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:9px;}
  .hours-list li{display:flex;justify-content:space-between;font-size:13px;}
  .hours-list li span:first-child{color:var(--muted);font-weight:600;}
  .hours-list li span:last-child{font-weight:800;}
  .hours-list li.closed span:last-child{color:var(--orange-600);}

  .social-row{display:flex;gap:10px;margin-top:6px;}
  .social-row a{
    width:38px;height:38px;border-radius:50%;background:#f2f6fb;color:var(--navy-800);
    display:flex;align-items:center;justify-content:center;font-size:15px;text-decoration:none;transition:.15s;
  }
  .social-row a:hover{background:var(--navy-800);color:#fff;}

  .map-box{
    border-radius:16px;overflow:hidden;border:1px solid var(--line);height:190px;position:relative;
    background:linear-gradient(135deg,#dfeaf7,#eef5ff);
  }
  .map-pin{
    position:absolute;top:50%;left:50%;transform:translate(-50%,-100%);
    color:var(--orange-500);font-size:30px;filter:drop-shadow(0 6px 8px rgba(0,0,0,.2));
  }
  .map-box .map-label{
    position:absolute;bottom:10px;left:10px;background:#fff;padding:6px 12px;border-radius:10px;
    font-size:11.5px;font-weight:700;color:var(--navy-800);box-shadow:var(--shadow-soft);
  }

  /* ----- FAQ ----- */
  .faq{margin-top:22px;}
  .faq-item{border-bottom:1px solid var(--line);}
  .faq-item:last-child{border-bottom:none;}
  .faq-q{
    width:100%;display:flex;align-items:center;justify-content:space-between;gap:10px;
    background:none;border:none;text-align:left;padding:16px 2px;cursor:pointer;
    font-family:inherit;font-size:14.5px;font-weight:700;color:var(--ink);
  }
  .faq-q i{color:var(--muted);transition:.2s;flex:0 0 auto;}
  .faq-item.is-open .faq-q i{transform:rotate(45deg);color:var(--orange-500);}
  .faq-a{max-height:0;overflow:hidden;transition:max-height .25s ease;}
  .faq-item.is-open .faq-a{max-height:200px;}
  .faq-a p{margin:0 2px 16px;font-size:13.5px;color:#4a5b6e;line-height:1.7;}

  @media (max-width: 980px){
    .content{grid-template-columns:1fr;}
    .quick-grid{grid-template-columns:1fr;margin-top:-30px;}
    .form-grid{grid-template-columns:1fr;}
  }
  @media (max-width: 760px){
    .nav-links{display:none;}
  }
  .topnav{padding:16px 0}
.topnav .wrap{
  max-width:1180px;margin:0 auto;padding:0 28px;
  display:flex;align-items:center;position:relative;
}
.topnav .brand img{
  width:120px;
  max-width:120px;
  height:auto;
  display:block;
}
.topnav .nav-links{
  position:absolute;left:50%;transform:translateX(-50%);
}
.topnav .nav-links ul.onepage-menu{
  display:flex;align-items:center;gap:6px;list-style:none;margin:0;padding:0;
}
.topnav .nav-links ul.onepage-menu li a{
  text-decoration:none;font-weight:600;font-size:14.5px;
  padding:9px 14px;border-radius:20px;display:inline-block;white-space:nowrap;
}
.topnav-cta{margin-left:auto}
</style>
</head>
<body>

<!-- ===== TOP NAV ===== -->
<div class="topnav">
  <div class="wrap">
    <div class="brand">
      <a href="{{ route('index') }}">
        <img src="{{ asset('assets2/img/logo.PNG') }}" alt="Travel GO">
      </a>
    </div>

    <div class="nav-links">
      <ul class="onepage-menu">
        <li><a href="{{ route('index') }}">Home</a></li>
        <li><a href="{{ route('destination') }}">Wisata</a></li>
        <li><a href="{{ route('transportasi2') }}">Transportasi</a></li>
        <li class="current-menu-item"><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('daftar') }}">Daftar</a></li>
        <li><a href="{{ route('masuk') }}">Masuk</a></li>
        <li><a href="{{ route('booking1') }}">Booking</a></li>
      </ul><!-- onepage-menu -->
    </div>

    <div class="topnav-cta"></div>
  </div>
</div>

<!-- ===== HEADER ===== -->
<div class="page-head">
  <div class="wrap inner">
    <div class="crumb">
      <a href="{{ route('index') }}">Beranda</a><i class="fa-solid fa-chevron-right"></i>
      <span>Contact</span>
    </div>
    <h1>Ada yang bisa kami bantu?</h1>
    <p>Tim kami siap membantu soal pemesanan, pembayaran, atau pertanyaan seputar perjalananmu — 7 hari seminggu.</p>
  </div>
</div>

<div class="wrap">
  <!-- Kartu kontak cepat -->
  <div class="quick-grid">
    <div class="quick-card">
      <div class="quick-icon"><i class="fa-solid fa-phone"></i></div>
      <h4>Telepon &amp; Hotline</h4>
      <p>Bicara langsung dengan customer service kami.</p>
      <a class="link" href="tel:18008668">1500 8668 <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="quick-card">
      <div class="quick-icon"><i class="fa-solid fa-envelope"></i></div>
      <h4>Email</h4>
      <p>Kirim pertanyaan detail, biasanya dibalas &lt; 24 jam.</p>
      <a class="link" href="mailto:halo@nusantaratrip.co.id">halo@nusantaratrip.co.id <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="quick-card">
      <div class="quick-icon"><i class="fa-brands fa-whatsapp"></i></div>
      <h4>Live Chat / WhatsApp</h4>
      <p>Respons tercepat untuk kendala pemesanan mendesak.</p>
      <a class="link" href="#" >Mulai chat <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </div>

  <!-- Konten utama -->
  <div class="content">

    <!-- Form -->
    <div class="card">
      <h3>Kirim Pesan ke Kami</h3>
      <p class="card-sub">Isi formulir di bawah, tim kami akan menghubungimu kembali.</p>

      <form onsubmit="return false;">
        <div class="form-group full" style="margin-bottom:16px;">
          <label>Topik</label>
          <div class="topic-picker">
            <button type="button" class="topic-chip is-active">Pemesanan</button>
            <button type="button" class="topic-chip">Pembayaran</button>
            <button type="button" class="topic-chip">Refund &amp; Reschedule</button>
            <button type="button" class="topic-chip">Kerja Sama</button>
            <button type="button" class="topic-chip">Lainnya</button>
          </div>
        </div>

        <div class="form-grid">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" placeholder="Nama kamu">
          </div>
          <div class="form-group">
            <label>Nomor HP</label>
            <input type="text" placeholder="08xx xxxx xxxx">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" placeholder="nama@email.com">
          </div>
          <div class="form-group">
            <label>Nomor Pesanan (opsional)</label>
            <input type="text" placeholder="mis. NT-2026-04521">
          </div>
          <div class="form-group full">
            <label>Pesan</label>
            <textarea placeholder="Ceritakan kendala atau pertanyaanmu di sini..."></textarea>
          </div>
          <div class="form-group full">
            <button type="submit" class="submit-btn">Kirim Pesan</button>
            <div class="form-note">Dengan mengirim, kamu setuju dengan Kebijakan Privasi kami.</div>
          </div>
        </div>
      </form>

      <!-- FAQ -->
      <div class="faq">
        <h3 style="margin-bottom:2px;">Pertanyaan Umum</h3>
        <p class="card-sub">Mungkin jawabannya sudah ada di sini.</p>

        <div class="faq-item is-open">
          <button type="button" class="faq-q">Bagaimana cara membatalkan atau reschedule tiket?<i class="fa-solid fa-plus"></i></button>
          <div class="faq-a"><p>Buka menu "Pesanan", pilih tiket yang ingin diubah, lalu ikuti langkah reschedule/refund. Kebijakan biaya mengikuti syarat masing-masing maskapai/operator.</p></div>
        </div>
        <div class="faq-item">
          <button type="button" class="faq-q">Berapa lama tim menjawab email?<i class="fa-solid fa-plus"></i></button>
          <div class="faq-a"><p>Rata-rata email dibalas dalam waktu kurang dari 24 jam pada hari kerja. Untuk kendala mendesak, gunakan Live Chat/WhatsApp.</p></div>
        </div>
        <div class="faq-item">
          <button type="button" class="faq-q">Apakah ada kantor cabang yang bisa dikunjungi langsung?<i class="fa-solid fa-plus"></i></button>
          <div class="faq-a"><p>Ya, kantor pusat kami di Jakarta terbuka untuk kunjungan pada jam kerja. Lihat alamat lengkap di panel kontak sebelah kanan.</p></div>
        </div>
      </div>
    </div>

    <!-- Sidebar info -->
    <div>
      <div class="card" style="margin-bottom:20px;">
        <h3 style="margin-bottom:4px;">Informasi Kontak</h3>
        <p class="card-sub">Kantor pusat &amp; jam operasional</p>

        <div class="info-row">
          <div class="info-ico"><i class="fa-solid fa-location-dot"></i></div>
          <div class="info-body">
            <div class="t">Kantor Pusat</div>
            <div class="s">Jl. Sudirman Kav. 25, Jakarta Selatan, DKI Jakarta 12920</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-ico"><i class="fa-solid fa-phone"></i></div>
          <div class="info-body">
            <div class="t">Hotline</div>
            <div class="s"><a href="tel:18008668">1500 8668</a> (Senin–Minggu, 24 jam)</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-ico"><i class="fa-solid fa-envelope"></i></div>
          <div class="info-body">
            <div class="t">Email</div>
            <div class="s"><a href="mailto:halo@nusantaratrip.co.id">halo@nusantaratrip.co.id</a></div>
          </div>
        </div>

        <div class="map-box" style="margin-top:6px;">
          <i class="fa-solid fa-location-dot map-pin"></i>
          <div class="map-label"><i class="fa-solid fa-map"></i> Jakarta Selatan</div>
        </div>

        <div class="social-row">
          <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" aria-label="Twitter/X"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
        </div>
      </div>

      <div class="card">
        <h3 style="margin-bottom:16px;"><i class="fa-solid fa-clock" style="color:var(--orange-500);margin-right:6px;"></i>Jam Operasional</h3>
        <ul class="hours-list">
          <li><span>Customer Service (Chat)</span><span>24 Jam</span></li>
          <li><span>Kantor Pusat</span><span>08.00–17.00</span></li>
          <li><span>Sabtu</span><span>09.00–14.00</span></li>
          <li class="closed"><span>Minggu &amp; Libur Nasional</span><span>Tutup</span></li>
        </ul>
      </div>
    </div>

  </div>
</div>

<script>
  // Topic chip selector
  document.querySelectorAll('.topic-chip').forEach(chip => {
    chip.addEventListener('click', () => {
      document.querySelectorAll('.topic-chip').forEach(c => c.classList.remove('is-active'));
      chip.classList.add('is-active');
    });
  });

  // FAQ accordion
  document.querySelectorAll('.faq-q').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.faq-item');
      const wasOpen = item.classList.contains('is-open');
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('is-open'));
      if (!wasOpen) item.classList.add('is-open');
    });
  });
</script>

</body>
</html>
