<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cari Transportasi</title>
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
    --cream:#fff9f2;
    --ink:#0b1c2c;
    --muted:#9fb3c8;
    --radius-lg:22px;
    --radius-md:14px;
    --shadow-float:0 30px 60px -20px rgba(3,12,26,.55);
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    font-family:'Manrope',sans-serif;
    background:var(--cream);
    color:var(--ink);
  }
  h1,h2,h3,.display{font-family:'Plus Jakarta Sans',sans-serif;}

  /* ===== HERO ===== */
  .hero{
    position:relative;
    min-height:640px;
    overflow:hidden;
    background:
      radial-gradient(1100px 500px at 12% -10%, rgba(124,184,255,.35), transparent 60%),
      linear-gradient(160deg, var(--navy-900) 0%, var(--navy-800) 45%, var(--navy-700) 100%);
    padding-bottom:120px;
  }
  .hero::before{ /* soft aurora glow */
    content:"";
    position:absolute; inset:0;
    background:radial-gradient(700px 350px at 85% 10%, rgba(255,106,61,.18), transparent 65%);
    pointer-events:none;
  }
  .mountains{
    position:absolute; left:0; right:0; bottom:-2px; width:100%;
    opacity:.9;
  }
  .stars{
    position:absolute; inset:0;
    background-image:
      radial-gradient(2px 2px at 20% 20%, rgba(255,255,255,.5), transparent),
      radial-gradient(1.5px 1.5px at 60% 12%, rgba(255,255,255,.4), transparent),
      radial-gradient(1.5px 1.5px at 80% 30%, rgba(255,255,255,.35), transparent),
      radial-gradient(1.5px 1.5px at 35% 8%, rgba(255,255,255,.3), transparent),
      radial-gradient(1.5px 1.5px at 92% 18%, rgba(255,255,255,.3), transparent);
    pointer-events:none;
  }

  .wrap{max-width:1180px;margin:0 auto;padding:0 28px;position:relative;z-index:2;}

  /* nav */
  .nav{
  position:relative;
  display:flex;
  align-items:center;
  padding:24px 0 10px;
}
.nav-links{
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  display:flex;
  align-items:center;
}

  /* menu berbasis <ul class="onepage-menu"> (mis. dari Laravel Blade) */
  .nav-links ul.onepage-menu{
    display:flex;align-items:center;gap:6px;
    list-style:none;margin:0;padding:0;
  }
  .nav-links ul.onepage-menu li{margin:0;}
  .nav-links ul.onepage-menu li a{
    color:rgba(255,255,255,.82);text-decoration:none;font-size:14.5px;font-weight:600;
    padding:9px 14px;border-radius:20px;transition:.2s;white-space:nowrap;
    display:inline-block;
  }
  .nav-links ul.onepage-menu li a:hover{background:rgba(255,255,255,.1);color:#fff;}
  .nav-links ul.onepage-menu li.current-menu-item a{
    background:rgba(255,255,255,.14);color:#fff;
  }
  .nav-cta{display:flex;gap:10px;align-items:center;margin-left:6px;}
  .btn-ghost{
    color:#fff;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.25);
    padding:9px 18px;border-radius:20px;font-weight:700;font-size:14px;text-decoration:none;
  }
  .btn-solid{
    background:linear-gradient(135deg,var(--orange-500),var(--orange-600));
    color:#fff;padding:10px 20px;border-radius:20px;font-weight:700;font-size:14px;
    text-decoration:none;box-shadow:0 8px 20px -6px rgba(255,106,61,.55);
  }

  /* headline */
  .hero-copy{text-align:center;padding:56px 0 8px;color:#fff;}
  .eyebrow{
    display:inline-flex;align-items:center;gap:8px;
    background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.18);
    padding:7px 16px;border-radius:20px;font-size:12.5px;font-weight:700;
    letter-spacing:.4px;text-transform:uppercase;color:var(--blue-300);
    margin-bottom:22px;
  }
  .hero-copy h1{
    font-size:44px;font-weight:800;line-height:1.15;margin:0 0 14px;
    letter-spacing:-.5px;
  }
  .hero-copy h1 span{color:var(--orange-500);}
  .hero-copy p{
    color:var(--muted);font-size:16.5px;max-width:520px;margin:0 auto;line-height:1.6;
  }

  /* ===== SEARCH CARD ===== */
  .search-card{
    position:relative;z-index:3;
    max-width:1020px;margin:44px auto 0;
    background:#fff;
    border-radius:var(--radius-lg);
    box-shadow:var(--shadow-float);
    padding:14px;
  }
  .tabs{
    display:flex;gap:6px;overflow-x:auto;padding:6px 6px 14px;
    scrollbar-width:none;
  }
  .tabs::-webkit-scrollbar{display:none;}
  .tab{
    flex:0 0 auto;
    display:flex;align-items:center;gap:8px;
    padding:11px 18px;border-radius:14px;border:none;background:transparent;
    color:#5c7086;font-weight:700;font-size:14px;cursor:pointer;transition:.18s;
  }
  .tab i{font-size:15px;}
  .tab:hover{background:#f2f6fb;}
  .tab.is-active{
    background:linear-gradient(135deg,var(--navy-800),var(--navy-700));
    color:#fff;box-shadow:0 10px 20px -8px rgba(11,35,64,.5);
  }

  .panel{display:none;padding:10px 8px 8px;}
  .panel.is-active{display:block;animation:fade .25s ease;}
  @keyframes fade{from{opacity:0;transform:translateY(4px);}to{opacity:1;transform:translateY(0);}}

  .fields{
    display:grid;grid-template-columns:1fr auto 1fr 1fr 1fr auto;
    gap:0;align-items:stretch;
    border:1px solid #e7edf3;border-radius:16px;overflow:hidden;
  }
  .field{
    padding:14px 18px;border-right:1px solid #e7edf3;position:relative;
  }
  .field:last-of-type{border-right:none;}
  .field label{
    display:flex;align-items:center;gap:6px;
    font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;
    color:#94a5b8;margin-bottom:6px;
  }
  .field label i{color:var(--orange-500);font-size:12px;}
  .field .val{font-size:15px;font-weight:700;color:var(--ink);}
  .field .sub{font-size:12.5px;color:#9aacc0;margin-top:2px;}
  .field select, .field input{
    border:none;background:transparent;font-family:inherit;font-size:15px;font-weight:700;
    color:var(--ink);width:100%;padding:0;outline:none;appearance:none;
  }
  .field.grow{grid-column:span 1;}

  /* ===== FIELD PICKER (Dari/Ke dengan detail) ===== */
  .field-pick{cursor:pointer;}
  .field-trigger{
    background:none;border:none;padding:0;text-align:left;width:100%;
    cursor:pointer;font-family:inherit;display:block;
  }
  .field-trigger .val{display:flex;align-items:center;gap:6px;}
  .field-trigger .val i{font-size:11px;color:#c3cedb;transition:.2s;}
  .field-pick.is-open .field-trigger .val i{transform:rotate(180deg);color:var(--blue-500);}

  .dest-panel{
    display:none;position:absolute;top:calc(100% + 12px);left:0;
    width:310px;max-height:360px;overflow-y:auto;
    background:#fff;border:1px solid #e7edf3;border-radius:18px;
    box-shadow:0 26px 50px -18px rgba(3,12,26,.38);
    padding:10px;z-index:30;
  }
  .field-pick.is-open .dest-panel{display:block;animation:fade .18s ease;}
  .dest-search{padding:4px 4px 10px;position:sticky;top:0;background:#fff;}
  .dest-search input{
    width:100%;border:1px solid #e7edf3;border-radius:11px;padding:10px 12px;
    font-size:13.5px;font-family:inherit;outline:none;font-weight:600;color:var(--ink);
  }
  .dest-search input:focus{border-color:var(--blue-500);}
  .dest-label{
    font-size:10.5px;font-weight:800;text-transform:uppercase;letter-spacing:.4px;
    color:#b6c2d1;padding:8px 8px 4px;
  }
  .dest-item{
    display:flex;align-items:center;gap:11px;width:100%;text-align:left;
    border:none;background:none;padding:9px 8px;border-radius:12px;cursor:pointer;
    font-family:inherit;
  }
  .dest-item:hover{background:#f2f6fb;}
  .dest-emoji{
    width:36px;height:36px;border-radius:10px;background:#eef5ff;color:var(--blue-500);
    display:flex;align-items:center;justify-content:center;font-size:14px;flex:0 0 auto;
  }
  .dest-info{display:flex;flex-direction:column;gap:1px;flex:1;min-width:0;}
  .dest-name{font-weight:800;font-size:13.5px;color:var(--ink);}
  .dest-detail{font-size:11.5px;color:#9aacc0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
  .dest-price{font-size:11px;font-weight:800;color:var(--orange-600);white-space:nowrap;flex:0 0 auto;}
  .dest-empty{padding:18px 10px;text-align:center;font-size:12.5px;color:#9aacc0;font-weight:600;}

  .swap-btn{
    display:flex;align-items:center;justify-content:center;
    width:0;position:relative;
  }
  .swap-btn button{
    position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
    width:38px;height:38px;border-radius:50%;
    background:#fff;border:1px solid #e2e8f0;color:var(--blue-500);
    box-shadow:0 6px 16px -6px rgba(20,60,120,.35);
    cursor:pointer;z-index:2;font-size:13px;
    transition:.2s;
  }
  .swap-btn button:hover{background:var(--blue-500);color:#fff;transform:translate(-50%,-50%) rotate(180deg);}

  .search-btn-wrap{display:flex;align-items:center;padding:8px;}
  .search-btn{
    width:100%;height:100%;min-height:56px;min-width:64px;
    background:linear-gradient(135deg,var(--orange-500),var(--orange-600));
    border:none;border-radius:14px;color:#fff;font-size:19px;cursor:pointer;
    box-shadow:0 12px 24px -10px rgba(255,106,61,.6);
    transition:.2s;
  }
  .search-btn:hover{filter:brightness(1.06);transform:translateY(-1px);}

  .quick-tags{
    display:flex;gap:8px;flex-wrap:wrap;padding:16px 10px 4px;
  }
  .quick-tags span{
    font-size:12.5px;color:#8296ab;font-weight:600;
  }
  .quick-tags a{
    font-size:12.5px;color:var(--blue-500);background:#eef5ff;border:1px solid #dbeaff;
    padding:5px 12px;border-radius:20px;text-decoration:none;font-weight:700;
  }

  /* trust strip */
  .trust{
    max-width:1020px;margin:26px auto 0;display:flex;align-items:center;justify-content:center;
    gap:26px;flex-wrap:wrap;
  }
  .trust span{color:rgba(255,255,255,.55);font-size:12.5px;font-weight:700;letter-spacing:.3px;text-transform:uppercase;}
  .trust .logos{display:flex;gap:22px;align-items:center;flex-wrap:wrap;}
  .trust .logos div{
    color:rgba(255,255,255,.7);font-weight:800;font-size:14px;letter-spacing:.3px;
  }

  @media (max-width: 900px){
    .nav-links{display:none;}
    .hero-copy h1{font-size:32px;}
    .fields{grid-template-columns:1fr;}
    .field{border-right:none;border-bottom:1px solid #e7edf3;}
    .swap-btn{width:100%;height:0;}
    .swap-btn button{top:0;left:auto;right:22px;transform:translate(0,-50%) rotate(90deg);}
    .search-btn-wrap{padding:12px;}
    .search-btn{min-height:52px;}
  }

    :root{
        --navy-900:#061428;
        --navy-800:#0b2340;
        --navy-700:#12345c;
        --blue-500:#2f7de1;
        --blue-300:#7cb8ff;
        --orange-500:#ff6a3d;
        --orange-600:#f2531f;
        --cream:#fff9f2;
        --ink:#0b1c2c;
        --muted:#9fb3c8;
    }

    *{
        box-sizing:border-box;
    }

    body{
        margin:0;
        font-family:'Manrope',sans-serif;
        background:var(--cream);
        color:var(--ink);
    }

    /* ==================================================
       BACKGROUND HERO
       PATH GAMBAR:
       public/assets2/img/bg3.jpg
       ================================================== */

    .hero{
        position:relative;
        min-height:640px;
        overflow:hidden;

        /* JALUR / PATH GAMBAR BACKGROUND */
        background-image:
            linear-gradient(
                rgba(6,20,40,0.25),
                rgba(6,20,40,0.25)
            ),
            url("{{ asset('assets2/img/bg3.jpg') }}");

        /* POSISI GAMBAR */
        background-position:center center;

        /* GAMBAR TIDAK DIULANG */
        background-repeat:no-repeat;

        /* GAMBAR MEMENUHI AREA HERO */
        background-size:cover;

        padding-bottom:120px;
        color:#fff;
    }

    /* Efek overlay */
    .hero::before{
        content:"";
        position:absolute;
        inset:0;

        background:rgba(0,0,0,0.15);

        pointer-events:none;
        z-index:1;
    }

    /* Isi hero berada di atas gambar */
    .hero .wrap{
        position:relative;
        z-index:2;
    }

    /* ================================
       JUDUL
       ================================ */

    .hero-copy{
        text-align:center;
        padding:56px 0 8px;
        color:#fff;
    }

    .hero-copy h1{
        color:#fff;
        font-size:44px;
        font-weight:800;
        line-height:1.15;
        margin:0 0 14px;
    }

    .hero-copy h1 span{
        color:var(--orange-500);
    }

    .hero-copy p{
        color:rgba(255,255,255,.9);
        font-size:16.5px;
        max-width:520px;
        margin:0 auto;
        line-height:1.6;
    }

    /* ================================
       NAVIGASI
       ================================ */

    .nav{
        position:relative;
        display:flex;
        align-items:center;
        padding:24px 0 10px;
    }

    .nav-links{
        position:absolute;
        left:50%;
        transform:translateX(-50%);
    }

    .nav-links ul.onepage-menu{
        display:flex;
        align-items:center;
        gap:6px;
        list-style:none;
        margin:0;
        padding:0;
    }

    .nav-links ul.onepage-menu li{
        margin:0;
    }

    .nav-links ul.onepage-menu li a{
        color:#fff;
        text-decoration:none;
        font-size:14.5px;
        font-weight:600;
        padding:9px 14px;
        border-radius:20px;
        transition:.2s;
        white-space:nowrap;
        display:inline-block;
    }

    .nav-links ul.onepage-menu li a:hover{
        background:rgba(255,255,255,.15);
        color:#fff;
    }

    /* ================================
       RESPONSIVE
       ================================ */

    @media(max-width:900px){

        .nav-links{
            display:none;
        }

        .hero{
            min-height:600px;
            background-position:center center;
        }

        .hero-copy h1{
            font-size:32px;
        }
    }

    @media(max-width:560px){

        .hero{
            min-height:650px;
            background-position:center center;
        }

        .hero-copy h1{
            font-size:28px;
        }
    }

</style>
</head>
<body>

<section class="hero">
  <div class="stars"></div>

  <div class="wrap">
    <nav class="nav">

 <div class="brand">
    <a href="{{ route('index') }}">
        <img src="{{ asset('assets2/img/logo.png') }}" alt="Travel GOI">
    </a>
</div>

<style>
.brand img{
    width:200px !important;
    max-width:200px !important;
    height:auto !important;
    display:block;
}
</style>
<div class="nav-links">
    <ul class="onepage-menu">
        <li class="current-menu-item">
            <a href="{{ route('index') }}">Home</a>
        </li>
        <li>
            <a href="{{ route('destination') }}">Wisata</a>
        </li>
        <li>
            <a href="{{ route('transportasi2') }}">Transportasi</a>
        </li>
        <li>
            <a href="{{ route('contact') }}">Contact</a>
        </li>
        <li>
            <a href="{{ route('daftar') }}">Daftar</a>
        </li>
        <li>
            <a href="{{ route('masuk') }}">Masuk</a>
        </li>
        <li>
            <a href="{{ route('booking1') }}">Booking</a>
        </li>
    </ul>
</div>

</nav>

    <div class="hero-copy">
      <div class="eyebrow"><i class="fa-solid fa-route"></i> Semua moda transportasi, satu pencarian</div>
      <h1>Ke mana pun tujuannya,<br>pesan <span>transportasinya</span> di sini</h1>
      <p>Bandingkan pesawat, kereta, bus, antar jemput bandara, dan rental mobil dalam satu tempat — cepat, transparan, tanpa ribet.</p>
    </div>

    <!-- ===== SEARCH CARD ===== -->
    <div class="search-card">
      <div class="tabs" role="tablist">
        <button class="tab is-active" data-target="p-pesawat"><i class="fa-solid fa-plane-departure"></i>Pesawat</button>
        <button class="tab" data-target="p-kereta"><i class="fa-solid fa-train"></i>Kereta Api</button>
        <button class="tab" data-target="p-bus"><i class="fa-solid fa-bus"></i>Bus &amp; Travel</button>
        <button class="tab" data-target="p-jemput"><i class="fa-solid fa-plane-arrival"></i>Antar Jemput</button>
        <button class="tab" data-target="p-mobil"><i class="fa-solid fa-car-side"></i>Rental Mobil</button>
      </div>

      <!-- PESAWAT -->
      <div class="panel is-active" id="p-pesawat">
        <div class="fields">
          <div class="field field-pick">
            <label><i class="fa-solid fa-plane-departure"></i>Dari</label>
            <button type="button" class="field-trigger">
              <span class="val">Jakarta (CGK) <i class="fa-solid fa-chevron-down"></i></span>
              <span class="sub">Soekarno-Hatta Intl.</span>
            </button>
            <div class="dest-panel">
              <div class="dest-search"><input type="text" placeholder="Cari kota atau bandara"></div>
              <div class="dest-label">Kota Populer</div>
              <div class="dest-list">
                <button type="button" class="dest-item" data-name="Jakarta (CGK)" data-sub="Soekarno-Hatta Intl.">
                  <span class="dest-emoji"><i class="fa-solid fa-city"></i></span>
                  <span class="dest-info"><span class="dest-name">Jakarta (CGK)</span><span class="dest-detail">Soekarno-Hatta Intl.</span></span>
                  <span class="dest-price">Mulai 850rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Surabaya (SUB)" data-sub="Juanda Intl.">
                  <span class="dest-emoji"><i class="fa-solid fa-city"></i></span>
                  <span class="dest-info"><span class="dest-name">Surabaya (SUB)</span><span class="dest-detail">Juanda Intl.</span></span>
                  <span class="dest-price">Mulai 750rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Denpasar (DPS)" data-sub="Ngurah Rai Intl.">
                  <span class="dest-emoji"><i class="fa-solid fa-umbrella-beach"></i></span>
                  <span class="dest-info"><span class="dest-name">Denpasar (DPS)</span><span class="dest-detail">Ngurah Rai Intl.</span></span>
                  <span class="dest-price">Mulai 900rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Medan (KNO)" data-sub="Kualanamu Intl.">
                  <span class="dest-emoji"><i class="fa-solid fa-city"></i></span>
                  <span class="dest-info"><span class="dest-name">Medan (KNO)</span><span class="dest-detail">Kualanamu Intl.</span></span>
                  <span class="dest-price">Mulai 980rb</span>
                </button>
              </div>
            </div>
          </div>
          <div class="swap-btn"><button type="button" aria-label="Tukar"><i class="fa-solid fa-right-left"></i></button></div>
          <div class="field field-pick">
            <label><i class="fa-solid fa-plane-arrival"></i>Ke</label>
            <button type="button" class="field-trigger">
              <span class="val">Siem Reap (REP) <i class="fa-solid fa-chevron-down"></i></span>
              <span class="sub">Angkor Intl.</span>
            </button>
            <div class="dest-panel">
              <div class="dest-search"><input type="text" placeholder="Cari kota atau bandara"></div>
              <div class="dest-label">Destinasi Populer</div>
              <div class="dest-list">
                <button type="button" class="dest-item" data-name="Siem Reap (REP)" data-sub="Angkor Intl.">
                  <span class="dest-emoji"><i class="fa-solid fa-landmark"></i></span>
                  <span class="dest-info"><span class="dest-name">Siem Reap (REP)</span><span class="dest-detail">Angkor Intl. · Kamboja</span></span>
                  <span class="dest-price">Mulai 1,45jt</span>
                </button>
                <button type="button" class="dest-item" data-name="Bangkok (BKK)" data-sub="Suvarnabhumi Intl.">
                  <span class="dest-emoji"><i class="fa-solid fa-city"></i></span>
                  <span class="dest-info"><span class="dest-name">Bangkok (BKK)</span><span class="dest-detail">Suvarnabhumi · Thailand</span></span>
                  <span class="dest-price">Mulai 1,1jt</span>
                </button>
                <button type="button" class="dest-item" data-name="Singapura (SIN)" data-sub="Changi Intl.">
                  <span class="dest-emoji"><i class="fa-solid fa-city"></i></span>
                  <span class="dest-info"><span class="dest-name">Singapura (SIN)</span><span class="dest-detail">Changi · Singapura</span></span>
                  <span class="dest-price">Mulai 1,25jt</span>
                </button>
                <button type="button" class="dest-item" data-name="Kuala Lumpur (KUL)" data-sub="KLIA">
                  <span class="dest-emoji"><i class="fa-solid fa-city"></i></span>
                  <span class="dest-info"><span class="dest-name">Kuala Lumpur (KUL)</span><span class="dest-detail">KLIA · Malaysia</span></span>
                  <span class="dest-price">Mulai 990rb</span>
                </button>
              </div>
            </div>
          </div>
          <div class="field">
            <label><i class="fa-regular fa-calendar"></i>Berangkat</label>
            <input type="text" value="Jum, 07 Agt 2026" placeholder="Pilih tanggal">
            <div class="sub">1 malam</div>
          </div>
          <div class="field">
            <label><i class="fa-solid fa-user-group"></i>Penumpang</label>
            <div class="val">2 Dewasa</div>
            <div class="sub">Kelas Ekonomi</div>
          </div>
          <div class="field grow" style="border-right:1px solid #e7edf3;"></div>
          <div class="search-btn-wrap"><button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button></div>
        </div>
        <div class="quick-tags">
          <span>Populer:</span>
          <a href="#">Jakarta → Bali</a>
          <a href="#">Jakarta → Siem Reap</a>
          <a href="#">Surabaya → Bangkok</a>
        </div>
      </div>

      <!-- KERETA -->
      <div class="panel" id="p-kereta">
        <div class="fields">
          <div class="field field-pick">
            <label><i class="fa-solid fa-train"></i>Stasiun Asal</label>
            <button type="button" class="field-trigger">
              <span class="val">Gambir (GMR) <i class="fa-solid fa-chevron-down"></i></span>
              <span class="sub">Jakarta Pusat</span>
            </button>
            <div class="dest-panel">
              <div class="dest-search"><input type="text" placeholder="Cari stasiun"></div>
              <div class="dest-label">Stasiun Populer</div>
              <div class="dest-list">
                <button type="button" class="dest-item" data-name="Gambir (GMR)" data-sub="Jakarta Pusat">
                  <span class="dest-emoji"><i class="fa-solid fa-train-subway"></i></span>
                  <span class="dest-info"><span class="dest-name">Gambir (GMR)</span><span class="dest-detail">Jakarta Pusat</span></span>
                  <span class="dest-price">Mulai 150rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Bandung (BD)" data-sub="Kota Bandung">
                  <span class="dest-emoji"><i class="fa-solid fa-train-subway"></i></span>
                  <span class="dest-info"><span class="dest-name">Bandung (BD)</span><span class="dest-detail">Kota Bandung</span></span>
                  <span class="dest-price">Mulai 100rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Yogyakarta (YK)" data-sub="Kota Yogyakarta">
                  <span class="dest-emoji"><i class="fa-solid fa-train-subway"></i></span>
                  <span class="dest-info"><span class="dest-name">Yogyakarta (YK)</span><span class="dest-detail">Kota Yogyakarta</span></span>
                  <span class="dest-price">Mulai 180rb</span>
                </button>
              </div>
            </div>
          </div>
          <div class="swap-btn"><button type="button" aria-label="Tukar"><i class="fa-solid fa-right-left"></i></button></div>
          <div class="field field-pick">
            <label><i class="fa-solid fa-train"></i>Stasiun Tujuan</label>
            <button type="button" class="field-trigger">
              <span class="val">Surabaya Gubeng (SGU) <i class="fa-solid fa-chevron-down"></i></span>
              <span class="sub">Jawa Timur</span>
            </button>
            <div class="dest-panel">
              <div class="dest-search"><input type="text" placeholder="Cari stasiun"></div>
              <div class="dest-label">Stasiun Populer</div>
              <div class="dest-list">
                <button type="button" class="dest-item" data-name="Surabaya Gubeng (SGU)" data-sub="Jawa Timur">
                  <span class="dest-emoji"><i class="fa-solid fa-train-subway"></i></span>
                  <span class="dest-info"><span class="dest-name">Surabaya Gubeng (SGU)</span><span class="dest-detail">Jawa Timur</span></span>
                  <span class="dest-price">Mulai 320rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Semarang Tawang (SMT)" data-sub="Jawa Tengah">
                  <span class="dest-emoji"><i class="fa-solid fa-train-subway"></i></span>
                  <span class="dest-info"><span class="dest-name">Semarang Tawang (SMT)</span><span class="dest-detail">Jawa Tengah</span></span>
                  <span class="dest-price">Mulai 220rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Solo Balapan (SLO)" data-sub="Jawa Tengah">
                  <span class="dest-emoji"><i class="fa-solid fa-train-subway"></i></span>
                  <span class="dest-info"><span class="dest-name">Solo Balapan (SLO)</span><span class="dest-detail">Jawa Tengah</span></span>
                  <span class="dest-price">Mulai 200rb</span>
                </button>
              </div>
            </div>
          </div>
          <div class="field">
            <label><i class="fa-regular fa-calendar"></i>Berangkat</label>
            <input type="text" value="Sab, 08 Agt 2026" placeholder="Pilih tanggal">
          </div>
          <div class="field">
            <label><i class="fa-solid fa-user-group"></i>Penumpang</label>
            <div class="val">2 Dewasa</div>
            <div class="sub">Eksekutif</div>
          </div>
          <div class="field grow" style="border-right:1px solid #e7edf3;"></div>
          <div class="search-btn-wrap"><button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button></div>
        </div>
      </div>

      <!-- BUS -->
      <div class="panel" id="p-bus">
        <div class="fields">
          <div class="field field-pick">
            <label><i class="fa-solid fa-bus"></i>Kota Asal</label>
            <button type="button" class="field-trigger">
              <span class="val">Jakarta <i class="fa-solid fa-chevron-down"></i></span>
              <span class="sub">Terminal Kp. Rambutan</span>
            </button>
            <div class="dest-panel">
              <div class="dest-search"><input type="text" placeholder="Cari kota atau terminal"></div>
              <div class="dest-label">Kota Populer</div>
              <div class="dest-list">
                <button type="button" class="dest-item" data-name="Jakarta" data-sub="Terminal Kp. Rambutan">
                  <span class="dest-emoji"><i class="fa-solid fa-bus"></i></span>
                  <span class="dest-info"><span class="dest-name">Jakarta</span><span class="dest-detail">Terminal Kp. Rambutan</span></span>
                  <span class="dest-price">Mulai 120rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Bandung" data-sub="Terminal Leuwipanjang">
                  <span class="dest-emoji"><i class="fa-solid fa-bus"></i></span>
                  <span class="dest-info"><span class="dest-name">Bandung</span><span class="dest-detail">Terminal Leuwipanjang</span></span>
                  <span class="dest-price">Mulai 90rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Yogyakarta" data-sub="Terminal Giwangan">
                  <span class="dest-emoji"><i class="fa-solid fa-bus"></i></span>
                  <span class="dest-info"><span class="dest-name">Yogyakarta</span><span class="dest-detail">Terminal Giwangan</span></span>
                  <span class="dest-price">Mulai 150rb</span>
                </button>
              </div>
            </div>
          </div>
          <div class="swap-btn"><button type="button" aria-label="Tukar"><i class="fa-solid fa-right-left"></i></button></div>
          <div class="field field-pick">
            <label><i class="fa-solid fa-bus"></i>Kota Tujuan</label>
            <button type="button" class="field-trigger">
              <span class="val">Surabaya <i class="fa-solid fa-chevron-down"></i></span>
              <span class="sub">Terminal Purabaya</span>
            </button>
            <div class="dest-panel">
              <div class="dest-search"><input type="text" placeholder="Cari kota atau terminal"></div>
              <div class="dest-label">Kota Populer</div>
              <div class="dest-list">
                <button type="button" class="dest-item" data-name="Surabaya" data-sub="Terminal Purabaya">
                  <span class="dest-emoji"><i class="fa-solid fa-bus"></i></span>
                  <span class="dest-info"><span class="dest-name">Surabaya</span><span class="dest-detail">Terminal Purabaya</span></span>
                  <span class="dest-price">Mulai 220rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Semarang" data-sub="Terminal Mangkang">
                  <span class="dest-emoji"><i class="fa-solid fa-bus"></i></span>
                  <span class="dest-info"><span class="dest-name">Semarang</span><span class="dest-detail">Terminal Mangkang</span></span>
                  <span class="dest-price">Mulai 160rb</span>
                </button>
                <button type="button" class="dest-item" data-name="Malang" data-sub="Terminal Arjosari">
                  <span class="dest-emoji"><i class="fa-solid fa-bus"></i></span>
                  <span class="dest-info"><span class="dest-name">Malang</span><span class="dest-detail">Terminal Arjosari</span></span>
                  <span class="dest-price">Mulai 190rb</span>
                </button>
              </div>
            </div>
          </div>
          <div class="field">
            <label><i class="fa-regular fa-calendar"></i>Berangkat</label>
            <input type="text" value="Sab, 08 Agt 2026" placeholder="Pilih tanggal">
          </div>
          <div class="field">
            <label><i class="fa-solid fa-chair"></i>Kursi</label>
            <div class="val">2 Kursi</div>
            <div class="sub">Kelas Executive</div>
          </div>
          <div class="field grow" style="border-right:1px solid #e7edf3;"></div>
          <div class="search-btn-wrap"><button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button></div>
        </div>
      </div>

      <!-- ANTAR JEMPUT -->
      <div class="panel" id="p-jemput">
        <div class="fields">
          <div class="field">
            <label><i class="fa-solid fa-plane-arrival"></i>Titik Jemput</label>
            <select><option>Bandara Soekarno-Hatta</option><option>Bandara Ngurah Rai</option></select>
          </div>
          <div class="swap-btn"><button type="button" aria-label="Tukar"><i class="fa-solid fa-right-left"></i></button></div>
          <div class="field">
            <label><i class="fa-solid fa-location-dot"></i>Titik Antar</label>
            <input type="text" placeholder="Nama hotel / alamat">
          </div>
          <div class="field">
            <label><i class="fa-regular fa-calendar"></i>Tanggal &amp; Jam</label>
            <input type="text" value="Jum, 07 Agt · 14:00" placeholder="Pilih tanggal &amp; jam">
          </div>
          <div class="field">
            <label><i class="fa-solid fa-user-group"></i>Penumpang</label>
            <div class="val">2 Orang</div>
          </div>
          <div class="field grow" style="border-right:1px solid #e7edf3;"></div>
          <div class="search-btn-wrap"><button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button></div>
        </div>
      </div>

      <!-- RENTAL MOBIL -->
      <div class="panel" id="p-mobil">
        <div class="fields">
          <div class="field">
            <label><i class="fa-solid fa-car-side"></i>Lokasi Ambil</label>
            <select><option>Jakarta</option><option>Denpasar</option><option>Yogyakarta</option></select>
          </div>
          <div class="field">
            <label><i class="fa-regular fa-calendar"></i>Tanggal Ambil</label>
            <input type="text" value="Jum, 07 Agt · 09:00" placeholder="Pilih tanggal">
          </div>
          <div class="field">
            <label><i class="fa-regular fa-calendar-check"></i>Tanggal Kembali</label>
            <input type="text" value="Min, 09 Agt · 09:00" placeholder="Pilih tanggal">
          </div>
          <div class="field">
            <label><i class="fa-solid fa-user-tie"></i>Sopir</label>
            <div class="val">Dengan Sopir</div>
          </div>
          <div class="field grow" style="border-right:1px solid #e7edf3;"></div>
          <div class="search-btn-wrap"><button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button></div>
        </div>
      </div>

    </div><!-- /search-card -->

    <div class="trust">
      <span>Dipercaya oleh</span>
      <div class="logos">
        <div>GARUDA</div><div>KAI Access</div><div>Blue Bird</div><div>AirAsia</div><div>Damri</div>
      </div>
    </div>
  </div>

  <!-- siluet gunung, mengacu pada nuansa referensi -->
  <svg class="mountains" viewBox="0 0 1440 220" preserveAspectRatio="none">
    <path d="M0,220 L0,140 L180,60 L260,110 L360,20 L480,120 L620,50 L740,130 L860,70 L1000,150 L1140,40 L1260,120 L1440,60 L1440,220 Z" fill="#0a1e38" opacity="0.9"/>
    <path d="M0,220 L0,170 L220,110 L340,150 L520,80 L660,160 L820,100 L980,180 L1160,90 L1300,160 L1440,110 L1440,220 Z" fill="#0e2947" opacity="0.95"/>
  </svg>
</section>

<script>
  const tabs = document.querySelectorAll('.tab');
  const panels = document.querySelectorAll('.panel');
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('is-active'));
      panels.forEach(p => p.classList.remove('is-active'));
      tab.classList.add('is-active');
      document.getElementById(tab.dataset.target).classList.add('is-active');
      closeAllPickers();
    });
  });

  document.querySelectorAll('.swap-btn button').forEach(btn => {
    btn.addEventListener('click', () => {
      const group = btn.closest('.fields');
      const pickers = group.querySelectorAll('.field-pick .field-trigger');
      if (pickers.length >= 2) {
        const a = pickers[0], b = pickers[1];
        const aVal = a.querySelector('.val').firstChild.textContent.trim();
        const aSub = a.querySelector('.sub').textContent;
        const bVal = b.querySelector('.val').firstChild.textContent.trim();
        const bSub = b.querySelector('.sub').textContent;
        a.querySelector('.val').firstChild.textContent = bVal + ' ';
        a.querySelector('.sub').textContent = bSub;
        b.querySelector('.val').firstChild.textContent = aVal + ' ';
        b.querySelector('.sub').textContent = aSub;
      } else {
        const fields = group.querySelectorAll('select, input[type="text"]');
        if (fields.length >= 2) {
          const tmp = fields[0].value; fields[0].value = fields[1].value; fields[1].value = tmp;
        }
      }
    });
  });

  /* ===== Field picker: buka/tutup, pilih destinasi, cari ===== */
  function closeAllPickers(except) {
    document.querySelectorAll('.field-pick.is-open').forEach(fp => {
      if (fp !== except) fp.classList.remove('is-open');
    });
  }

  document.querySelectorAll('.field-pick').forEach(fp => {
    const trigger = fp.querySelector('.field-trigger');
    const searchInput = fp.querySelector('.dest-search input');
    const items = fp.querySelectorAll('.dest-item');
    const list = fp.querySelector('.dest-list');

    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      const willOpen = !fp.classList.contains('is-open');
      closeAllPickers();
      if (willOpen) {
        fp.classList.add('is-open');
        if (searchInput) { searchInput.value = ''; items.forEach(it => it.style.display = 'flex'); searchInput.focus(); }
      }
    });

    fp.querySelector('.dest-panel')?.addEventListener('click', e => e.stopPropagation());

    items.forEach(item => {
      item.addEventListener('click', () => {
        trigger.querySelector('.val').firstChild.textContent = item.dataset.name + ' ';
        trigger.querySelector('.sub').textContent = item.dataset.sub || '';
        fp.classList.remove('is-open');
      });
    });

    if (searchInput) {
      searchInput.addEventListener('input', () => {
        const q = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        items.forEach(it => {
          const match = it.dataset.name.toLowerCase().includes(q) || (it.dataset.sub || '').toLowerCase().includes(q);
          it.style.display = match ? 'flex' : 'none';
          if (match) visibleCount++;
        });
        let empty = list.querySelector('.dest-empty');
        if (visibleCount === 0) {
          if (!empty) {
            empty = document.createElement('div');
            empty.className = 'dest-empty';
            empty.textContent = 'Tidak ditemukan';
            list.appendChild(empty);
          }
        } else if (empty) {
          empty.remove();
        }
      });
    }
  });

  document.addEventListener('click', () => closeAllPickers());
</script>

</body>
</html>
