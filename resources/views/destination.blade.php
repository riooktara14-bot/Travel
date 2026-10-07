<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Destinasi Wisata - Travel GO</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --navy-900:#061428; --navy-800:#0b2340; --navy-700:#12345c;
  --blue-500:#2f7de1; --blue-300:#7cb8ff;
  --orange-500:#ff6a3d; --orange-600:#f2531f;
  --cream:#fff9f2; --ink:#0b1c2c; --muted:#8296ab;
}
*{box-sizing:border-box}
body{margin:0;font-family:'Manrope',sans-serif;background:var(--cream);color:var(--ink)}
h1,h2,h3{font-family:'Plus Jakarta Sans',sans-serif}

/* ===== HERO ===== */

.hero{
    position:relative;
    overflow:hidden;
    padding:24px 0 40px;
    background:
        linear-gradient(rgba(6,20,40,.65), rgba(6,20,40,.75)),
        url("{{ asset('assets2/img/bg2.JPG') }}") center center / cover no-repeat;
    color:#fff;
    text-align:center;
}

.wrap{max-width:1180px;margin:0 auto;padding:0 28px}

/* ===== NAV / MENU ===== */
.nav{position:relative;display:flex;align-items:center;padding:22px 0 46px}
.brand{display:flex;align-items:center;gap:10px}
.brand img{width:130px;max-width:130px;height:auto;display:block}
.nav-links{position:absolute;left:50%;transform:translateX(-50%)}
.nav-links ul.onepage-menu{display:flex;align-items:center;gap:6px;list-style:none;margin:0;padding:0}
.nav-links ul.onepage-menu li{margin:0}
.nav-links ul.onepage-menu li a{
  color:rgba(255,255,255,.82);text-decoration:none;font-size:14.5px;font-weight:600;
  padding:9px 14px;border-radius:20px;transition:.2s;white-space:nowrap;display:inline-block;
}
.nav-links ul.onepage-menu li a:hover{background:rgba(255,255,255,.1);color:#fff}
.nav-links ul.onepage-menu li.current-menu-item a{background:rgba(255,255,255,.14);color:#fff}
.nav-cta{display:flex;gap:10px;align-items:center;margin-left:auto}
.btn-ghost{
  color:#fff;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.25);
  padding:9px 18px;border-radius:20px;font-weight:700;font-size:14px;text-decoration:none;
}
.btn-solid{
  background:linear-gradient(135deg,var(--orange-500),var(--orange-600));
  color:#fff;padding:10px 20px;border-radius:20px;font-weight:700;font-size:14px;
  text-decoration:none;box-shadow:0 8px 20px -6px rgba(255,106,61,.55);
}
@media(max-width:900px){
  .nav-links{display:none}
  .nav-cta .btn-ghost{display:none}
}
.eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.18);
  padding:7px 16px;border-radius:20px;font-size:12.5px;font-weight:700;
  letter-spacing:.4px;text-transform:uppercase;color:var(--blue-300);margin-bottom:20px;
}
.hero h1{font-size:38px;margin:0 0 12px}
.hero h1 span{color:var(--orange-500)}
.hero p{color:#b9c7d8;font-size:15.5px;max-width:520px;margin:0 auto}

/* ===== SEARCH BAR ===== */
.search-bar{
  max-width:820px;margin:32px auto 0;background:#fff;border-radius:18px;
  box-shadow:0 25px 50px -18px rgba(3,12,26,.4);padding:10px;display:flex;gap:8px;
}
.search-bar input{
  flex:1;border:none;outline:none;padding:14px 18px;font-size:15px;
  font-family:inherit;color:var(--ink);border-radius:12px;
}
.search-bar button{
  background:linear-gradient(135deg,var(--orange-500),var(--orange-600));
  color:#fff;border:none;border-radius:12px;padding:0 26px;font-weight:700;
  font-size:14.5px;cursor:pointer;
}

/* ===== ACTIVITY GRID ===== */
.grid-section{max-width:1180px;margin:0 auto;padding:30px 28px 70px}
.grid-title{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
.grid-title h2{font-size:21px;margin:0}
.grid-title span{font-size:13px;color:var(--muted)}
.activity-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px}
.activity-card{
  background:#fff;border-radius:16px;overflow:hidden;
  box-shadow:0 10px 26px -14px rgba(11,35,64,.18);
  color:inherit;display:block;
}
.activity-thumb{
  height:180px;background:#edf2f7;overflow:hidden;
}
.activity-thumb img{
  width:100%;height:100%;object-fit:cover;display:block;
}
.activity-body{padding:14px 16px 16px}
.activity-cat{font-size:11px;font-weight:800;color:var(--blue-500);text-transform:uppercase;letter-spacing:.3px;margin-bottom:6px}
.activity-name{font-size:14.5px;font-weight:700;color:var(--ink);line-height:1.35;margin:0 0 8px}
.activity-description{font-size:12.5px;color:#5c7086;line-height:1.6;margin:0 0 12px}
.activity-meta{display:flex;align-items:center;gap:5px;font-size:12px;color:var(--muted);margin-bottom:10px}
.activity-meta i{color:#f5b400;font-size:11px}
.activity-price-row{display:flex;justify-content:space-between;align-items:baseline;border-top:1px solid #f0f3f7;padding-top:10px;gap:8px}
.activity-price{font-size:15px;font-weight:800;color:var(--ink)}
.activity-price small{font-size:11px;font-weight:600;color:var(--muted)}
.search-bar select{
  border:1px solid #e3ecf5;border-radius:12px;padding:0 14px;font:inherit;color:var(--ink);
  background:#fff;max-width:210px;
}
.empty-state{
  grid-column:1/-1;background:#fff;border:1px dashed #d5e0eb;border-radius:16px;
  padding:38px 24px;text-align:center;color:var(--muted);
}
.empty-state h3{color:var(--ink);margin:0 0 8px}
.empty-state p{margin:0}

@media(max-width:1024px){.activity-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:560px){
  .activity-grid{grid-template-columns:1fr}
  .hero h1{font-size:28px}
  .search-bar{flex-direction:column}
  .search-bar select{max-width:none;padding:14px}
  .search-bar button{padding:14px}
}
</style>
</head>
<body>

<section class="hero">
  <div class="wrap">

    <nav class="nav">
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
          <li><a href="{{ route('contact') }}">Contact</a></li>
          <li><a href="{{ route('daftar') }}">Daftar</a></li>
          <li><a href="{{ route('masuk') }}">Masuk</a></li>
          <li><a href="{{ route('booking1') }}">Booking</a></li>
        </ul>
      </div>

    </nav>

    <div class="eyebrow"><i class="fa-solid fa-map-location-dot"></i> Pilihan Wisata Indonesia</div>
    <h1>Temukan <span>destinasi wisata</span> impianmu</h1>
    <p>Jelajahi destinasi pilihan, lihat informasi lengkap, lokasi, durasi, dan harga perjalanan.</p>

    <form class="search-bar" method="GET" action="{{ route('destination') }}">
      <input
        type="search"
        name="q"
        value="{{ $search }}"
        placeholder="Cari nama, lokasi, atau deskripsi destinasi..."
        aria-label="Cari destinasi wisata">
      <select name="lokasi" aria-label="Filter berdasarkan lokasi">
        <option value="">Semua lokasi</option>
        @foreach($lokasiList as $lokasi)
          <option value="{{ $lokasi }}" @selected($selectedLocation === $lokasi)>{{ $lokasi }}</option>
        @endforeach
      </select>
      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
    </form>
  </div>
</section>

<section class="grid-section">
  <div class="grid-title">
    <h2>Destinasi Wisata</h2>
    <span>{{ $destinasi->count() }} destinasi ditemukan</span>
  </div>

  <div class="activity-grid">
    @forelse($destinasi as $wisata)
      <article class="activity-card">
        <div class="activity-thumb">
          <img
            src="{{ $wisata->gambar ?: asset('assets2/img/bg2.JPG') }}"
            alt="Foto {{ $wisata->nama_destinasi }}"
            loading="lazy">
        </div>
        <div class="activity-body">
          <div class="activity-cat"><i class="fa-solid fa-location-dot"></i> {{ $wisata->lokasi }}</div>
          <h3 class="activity-name">{{ $wisata->nama_destinasi }}</h3>
          <p class="activity-description">{{ $wisata->deskripsi ?: 'Informasi deskripsi destinasi ini belum tersedia.' }}</p>
          <div class="activity-meta">
            <i class="fa-regular fa-clock"></i> Durasi perjalanan {{ $wisata->durasi }} hari
          </div>
          <div class="activity-price-row">
            <div class="activity-price">
              Rp{{ number_format((float) $wisata->harga, 0, ',', '.') }} <small>/orang</small>
            </div>
          </div>
        </div>
      </article>
    @empty
      <div class="empty-state">
        <h3>Destinasi belum ditemukan</h3>
        <p>Coba ubah kata kunci atau pilih lokasi yang berbeda.</p>
      </div>
    @endforelse
  </div>
</section>

</body>
</html>
