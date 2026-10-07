<!DOCTYPE html>
<html>
	<head>
		<title>Travel Go</title>
<!--
Mercury travel - free HTML5 templates!
by Awe7 (http://awe7.com/freebies)
-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- Fonts-->
		<link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome/font-awesome.min.css">
		<!-- Vendors-->
		<link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/grid.css">
		<link rel="stylesheet" type="text/css" href="assets/vendors/magnific-popup/magnific-popup.min.css">
		<link rel="stylesheet" type="text/css" href="assets/vendors/swiper/swiper.css">
		<link rel="stylesheet" type="text/css" href="assets/vendors/jquery.select2/select2.css">
		<link rel="stylesheet" type="text/css" href="assets/vendors/jquery-ui/jquery-ui.min.css">
		<!-- App & fonts-->
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
		<link rel="stylesheet" type="text/css" id="app-stylesheet" href="assets/css/main.css"><!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="page-wrap" id="root">

			<!-- header -->
			<header class="header awe-skin-dark header--fixed">
				<div class="container-fluid pd-0">
					<div class="header__inner">
						<div class="header__logo_menu_wrap">
							<style>
.header__logo img{
    width:200px !important;
    max-width:200px !important;
    height:auto !important;
    display:block;
}
</style>

<div class="header__logo">
    <a href="index.html">
        <img src="assets2/img/logo.png" alt="Travel GOI">
    </a>
</div>
<div class="header__menu">
<nav class="onepage-nav">

    <style>
.header__inner{
    display:flex!important;
    align-items:center!important;
    justify-content:space-between!important;
    width:100%;
}
.header__logo_menu_wrap{
    display:flex!important;
    align-items:center!important;
    gap:55px!important;
    flex:1;
}
.header__logo{
    display:flex!important;
    align-items:center!important;
    flex-shrink:0!important;
}
.header__logo img{
    width:120px!important;
    max-width:120px!important;
    height:auto!important;
    display:block!important;
}
.header__menu{
    display:flex!important;
    align-items:center!important;
}
.onepage-nav{
    display:flex!important;
    align-items:center!important;
}
.onepage-menu{
    display:flex!important;
    align-items:center!important;
    gap:35px!important;
    margin:0!important;
    padding:0!important;
    list-style:none!important;
}
.onepage-menu li{
    display:flex!important;
    align-items:center!important;
    margin:0!important;
    padding:0!important;
}
.onepage-menu li a{
    display:flex!important;
    align-items:center!important;
    height:45px!important;
    padding:0!important;
    margin:0!important;
    white-space:nowrap!important;
}
.header__hotline_book_wrap{
    display:flex!important;
    align-items:center!important;
    gap:10px!important;
    white-space:nowrap!important;
}
.header__hotline{
    display:flex!important;
    align-items:center!important;
    gap:6px!important;
}
.header__booking{
    display:flex!important;
    align-items:center!important;
    gap:8px!important;
}
.header__booking a{
    display:inline-flex!important;
    align-items:center!important;
    justify-content:center!important;
    height:42px!important;
    padding:0 16px!important;
    margin:0!important;
    white-space:nowrap!important;
}
.header__booking .btn-login{
    color:#fff!important;
    border:1px solid rgba(255,255,255,.8)!important;
    background:transparent!important;
}
.header__booking .btn-register,
.header__booking .btn-booking{
    color:#fff!important;
    background:#ff6a3d!important;
    border:1px solid #ff6a3d!important;
}
@media(max-width:1200px){
    .header__logo_menu_wrap{
        gap:30px!important;
    }
    .onepage-menu{
        gap:22px!important;
    }
    .header__hotline{
        display:none!important;
    }
}
@media(max-width:991px){
    .header__logo img{
        width:95px!important;
        max-width:95px!important;
    }
    .header__logo_menu_wrap{
        gap:20px!important;
    }
}
</style>

<header class="header awe-skin-dark header--fixed">
    <div class="container-fluid pd-0">
        <div class="header__inner">

            <!-- LOGO + MENU -->
            <div class="header__logo_menu_wrap">

                <div class="header__logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('assets2/img/logo.png') }}" alt="Travel GO">
                    </a>
                </div>

                <div class="header__menu">
                    <nav class="onepage-nav">

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


                        <div class="navbar-toggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                    </nav>
                </div>
            </div>

            <!-- KANAN HEADER -->
            <div class="header__hotline_book_wrap">




                <!-- TOMBOL -->
                <div class="header__booking">


                </div>

            </div>

        </div>
    </div>
</header>

</nav><!-- End / onepage-nav -->

</div>
</div>

<div class="header__hotline_book_wrap">


    <!-- HOTLINE -->
    <div class="header__hotline">

<style>
.header__hotline_book_wrap{
    display:flex;
    align-items:center;
    gap:18px;
    white-space:nowrap;
}

.header__lang{
    position:relative;
}

.header__hotline{
    display:flex;
    align-items:center;
    gap:6px;
}

.header__hotline span{
    margin-right:3px;
}

.header__booking{
    display:flex !important;
    align-items:center;
    gap:8px;
}

.header__booking a{
    display:inline-flex !important;
    align-items:center;
    justify-content:center;
    height:42px;
    padding:0 16px !important;
    margin:0 !important;
    white-space:nowrap;
    text-decoration:none;
}

.header__booking .btn-login{
    color:#fff;
    border:1px solid rgba(255,255,255,.7);
    background:transparent;
}

.header__booking .btn-login:hover{
    background:#fff;
    color:#222;
}

.header__booking .btn-register{
    color:#fff;
    background:#ff6a3d;
    border:1px solid #ff6a3d;
}

.header__booking .btn-booking{
    color:#fff;
    background:#ff6a3d;
    border:1px solid #ff6a3d;
}

@media(max-width:991px){
    .header__hotline_book_wrap{
        gap:10px;
    }

    .header__hotline{
        display:none;
    }

    .header__booking{
        gap:5px;
    }

    .header__booking a{
        padding:0 11px !important;
        font-size:12px;
    }
}
</style>

<div class="header__hotline_book_wrap">




    <!-- Tombol -->


</div>
```
</header>
			<!-- Content-->
			<div class="md-content">

				<!-- hero -->
				<div class="hero" id="id-1">
					<div class="hero__wrapper">

						<!-- swiper__module swiper-container -->
						<div class="swiper__module swiper-container awe-skin-dark hero__main_slider" data-options='{"spaceBetween":0}'>
							<div class="swiper-wrapper">
								<div class="hero__item" style="background-image: url('assets/img/hero/1.jpg');"><img src="assets/img/hero/1.jpg" alt=""/>
									<div class="hero__box_info">
										<div class="container">
											<h2 class="hero__title">Vibrant Hong Kong: 3 Day</h2>
											<p class="hero__info"><span>3 Day 2 Night</span><span>Tokyo</span><span>709 Review</span></p>
										</div>
									</div>
								</div>
								<div class="hero__item" style="background-image: url('assets/img/hero/2.jpg');"><img src="assets/img/hero/2.jpg" alt=""/>
									<div class="hero__box_info">
										<div class="container">
											<h2 class="hero__title">Splendours of India: Holiday of a Lifetime</h2>
											<p class="hero__info"><span>3 Day 2 Night</span><span>Beijing</span><span>780 Review</span></p>
										</div>
									</div>
								</div>
								<div class="hero__item" style="background-image: url('assets/img/hero/3.jpg');"><img src="assets/img/hero/3.jpg" alt=""/>
									<div class="hero__box_info">
										<div class="container">
											<h2 class="hero__title">Discover Hong Kong and Bangkok incl. Airfare</h2>
											<p class="hero__info"><span>3 Day 2 Night</span><span>Nara</span><span>746 Review</span></p>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-button-custom">
								<div class="swiper-button-prev-custom"></div>
								<div class="swiper-button-next-custom"></div>
							</div>
						</div><!-- End / swiper__module swiper-container -->


						<!-- swiper-thumbnails__module swiper-container -->
						<div class="swiper-thumbnails__module swiper-container awe-skin-dark hero__thumbails" data-options='{"spaceBetween":0}'>
							<div class="swiper-wrapper">
								<div class="hero__item" style="background-image: url('assets/img/hero/1.jpg');"><span>Bhutan</span></div>
								<div class="hero__item" style="background-image: url('assets/img/hero/2.jpg');"><span>Panama</span></div>
								<div class="hero__item" style="background-image: url('assets/img/hero/3.jpg');"><span>Cameroon</span></div>
							</div>
							<div class="swiper-button-custom">
								<div class="swiper-button-prev-custom"></div>
								<div class="swiper-button-next-custom"></div>
							</div>
						</div><!-- End / swiper-thumbnails__module swiper-container -->




					</div>
				</div><!-- End / hero -->


				<!-- Section -->
				<section class="awe-section pd-0" id="box-search">
					<div class="box-search-wrapper">
						<div class="container">






</div>
<!-- End / box-search -->

</div>
</div>
</section>
```

				<!-- End / Section -->


				<!-- Section -->
				<section class="awe-section bg-gray">
					<div class="container">
						<div class="row">
							<div class="col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 ">

								<!-- title -->
								<div class="title">
									<h2 class="title__title">Selamat datang di <span class='main-color'>Travel Go</span><br /> Kami telah memelopori perjalanan unik di<br /> <span class='main-color'>Asia</span> selama lebih dari dua dekade.</h2>
<p class="title__text">Sudah menjadi fakta yang lama terbukti bahwa seorang pembaca akan terdistraksi oleh konten yang dapat dibaca dari suatu halaman saat melihat tata letaknya. Tujuan menggunakan Lorem Ipsum adalah karena ia memiliki distribusi huruf yang kurang lebih normal.</p>
								</div><!-- End / title -->

							</div>
							<div class="col-md-12 col-lg-12 ">
								<div class="grid-css grid-css--masonry" data-col-lg="4" data-col-md="3" data-col-sm="2" data-col-xs="1" data-gap="30">
									<div class="grid__inner">
										<div class="grid-sizer"></div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/1.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/1.jpg" style="background-image: url('assets/img/image_box_1/1.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/1.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Hong Kong</h4>
																	<p class="box-image__tour">309</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/2.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/2.jpg" style="background-image: url('assets/img/image_box_1/2.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/2.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Istanbul</h4>
																	<p class="box-image__tour">287</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/3.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/3.jpg" style="background-image: url('assets/img/image_box_1/3.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/3.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Siem Reap</h4>
																	<p class="box-image__tour">387</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/4.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/4.jpg" style="background-image: url('assets/img/image_box_1/4.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/4.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Istanbul</h4>
																	<p class="box-image__tour">273</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/5.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/5.jpg" style="background-image: url('assets/img/image_box_1/5.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/5.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Hong Kong</h4>
																	<p class="box-image__tour">266</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/6.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/6.jpg" style="background-image: url('assets/img/image_box_1/6.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/6.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Da Nang</h4>
																	<p class="box-image__tour">128</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/7.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/7.jpg" style="background-image: url('assets/img/image_box_1/7.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/7.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Shanghai</h4>
																	<p class="box-image__tour">196</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
										<div class="grid-item">
											<div class="grid-item__inner">
												<div class="grid-item__content-wrapper">

													<!-- box-image -->
													<div class="box-image" href="assets/img/image_box_1/8.jpg">
														<div><a class="box-image__bg" href="assets/img/image_box_1/8.jpg" style="background-image: url('assets/img/image_box_1/8.jpg');" data-effect="mfp-zoom-in"><img src="assets/img/image_box_1/8.jpg" alt=""/>
																<div class="box-image__info">
																	<h4 class="box-image__country">Hong Kong</h4>
																	<p class="box-image__tour">290</p>
																</div></a></div>
													</div><!-- End / box-image -->

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- End / Section -->


		<!-- Section -->
<section class="awe-section">
	<div class="container">

		<!-- title -->
		<div class="title title__style-02">
			<h2 class="title__title">Paket Wisata Terbaik</h2>
		</div><!-- End / title -->

		<div class="grid-css grid_css_style_02 grid-css--masonry" data-col-lg="3" data-col-md="2" data-col-sm="2" data-col-xs="1" data-gap="30">
			<div class="filter">
				<ul class="filter__list">
					<li><a href="#" data-filter="*">Semua</a></li>
					<li><a href="#" data-filter=".cat1">Destinasi</a></li>
					<li><a href="#" data-filter=".cat2">Gaya Perjalanan</a></li>
				</ul>
			</div>

			<div class="grid__inner">
				<div class="grid-sizer"></div>

				<div class="grid-item cat1">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">
							<div class="box-image2">
								<div>
									<a class="box-image2__bg" href="#" style="background-image: url('assets/img/image_box_2/1.jpg');">
										<img src="assets/img/image_box_2/1.jpg" alt=""/>
									</a>
									<div class="box-image2__info">
										<p class="box-image2__country">Siem Reap</p>
										<p class="box-image2__tour">Pelayaran Sungai Mekong Boutique: Laos hingga Tiongkok</p>
									</div>
									<div class="box-image2__info_bot">
										<span class="box-image2__date">7 Hari / 8 Malam</span>
										<a class="box-image2__view" href="#">Lihat Paket</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="grid-item cat2">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">
							<div class="box-image2">
								<div>
									<a class="box-image2__bg" href="#" style="background-image: url('assets/img/image_box_2/2.jpg');">
										<img src="assets/img/image_box_2/2.jpg" alt=""/>
									</a>
									<div class="box-image2__info">
										<p class="box-image2__country">Hong Kong</p>
										<p class="box-image2__tour">Wisata Klasik Vietnam dari Kota Ho Chi Minh</p>
									</div>
									<div class="box-image2__info_bot">
										<span class="box-image2__date">7 Hari / 8 Malam</span>
										<a class="box-image2__view" href="#">Lihat Paket</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="grid-item cat1">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">
							<div class="box-image2">
								<div>
									<a class="box-image2__bg" href="#" style="background-image: url('assets/img/image_box_2/3.jpg');">
										<img src="assets/img/image_box_2/3.jpg" alt=""/>
									</a>
									<div class="box-image2__info">
										<p class="box-image2__country">Ubud</p>
										<p class="box-image2__tour">Menjelajahi Jalur Sutra</p>
									</div>
									<div class="box-image2__info_bot">
										<span class="box-image2__date">7 Hari / 8 Malam</span>
										<a class="box-image2__view" href="#">Lihat Paket</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="grid-item cat2">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">
							<div class="box-image2">
								<div>
									<a class="box-image2__bg" href="#" style="background-image: url('assets/img/image_box_2/4.jpg');">
										<img src="assets/img/image_box_2/4.jpg" alt=""/>
									</a>
									<div class="box-image2__info">
										<p class="box-image2__country">Kepulauan Phi Phi</p>
										<p class="box-image2__tour">Liburan Dubai & Maladewa Termasuk Tiket Pesawat</p>
									</div>
									<div class="box-image2__info_bot">
										<span class="box-image2__date">7 Hari / 8 Malam</span>
										<a class="box-image2__view" href="#">Lihat Paket</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="grid-item cat1">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">
							<div class="box-image2">
								<div>
									<a class="box-image2__bg" href="#" style="background-image: url('assets/img/image_box_2/5.jpg');">
										<img src="assets/img/image_box_2/5.jpg" alt=""/>
									</a>
									<div class="box-image2__info">
										<p class="box-image2__country">Istanbul</p>
										<p class="box-image2__tour">Menjelajahi Hong Kong dan Bangkok Termasuk Tiket Pesawat</p>
									</div>
									<div class="box-image2__info_bot">
										<span class="box-image2__date">7 Hari / 8 Malam</span>
										<a class="box-image2__view" href="#">Lihat Paket</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="grid-item cat2">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">
							<div class="box-image2">
								<div>
									<a class="box-image2__bg" href="#" style="background-image: url('assets/img/image_box_2/6.jpg');">
										<img src="assets/img/image_box_2/6.jpg" alt=""/>
									</a>
									<div class="box-image2__info">
										<p class="box-image2__country">Bangkok</p>
										<p class="box-image2__tour">Odise Tiongkok dengan Pelayaran Sungai Yangtze</p>
									</div>
									<div class="box-image2__info_bot">
										<span class="box-image2__date">7 Hari / 8 Malam</span>
										<a class="box-image2__view" href="#">Lihat Paket</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="text-center">
			<a class="md-btn mt-60 md-btn--primary md-btn--pill" href="#">
				Jelajahi Lebih Banyak
			</a>
		</div>

	</div>
</section>
<!-- End / Section -->

<div class="container">

	<!-- Section -->
	<section class="awe-section awe-skin-dark bg-fixed style-03" style="background-image:url(assets/img/bg/3.jpg);">

		<!-- title -->
		<div class="title title__style-03">
			<h5 class="title__title_small">Promo Pekan Suci 2018</h5>
			<h2 class="title__title">Liburan Dubai & Maladewa Termasuk Tiket Pesawat</h2>
			<p class="title__text">
				Periode Keberangkatan: 28–30 Maret atau 29 Maret–1 April 2018 <br>
				Periode Pemesanan: Kursi Terbatas <br>
				Hotel: Fragrance Imperial atau hotel sekelas <br>
				Maskapai: Melalui Cebu Pacific
			</p>
		</div><!-- End / title -->

	</section>

</div>
					<!-- End / Section -->

				</div>

				<!-- Section -->
<section class="awe-section">
	<div class="container">

		<!-- title -->
		<div class="title title__style-02">
			<h2 class="title__title">Paket Wisata Kami</h2>
		</div><!-- End / title -->

		<div class="grid-css grid_css_style_02 grid-css--masonry" data-col-lg="2" data-col-md="2" data-col-sm="1" data-col-xs="1" data-gap="30">
			<div class="filter">
				<ul class="filter__list">
					<li><a href="#" data-filter="*">Semua</a></li>
					<li><a href="#" data-filter=".cat1">Paket Baru</a></li>
					<li><a href="#" data-filter=".cat2">Paket Tersedia</a></li>
					<li><a href="#" data-filter=".cat3">Segera Hadir</a></li>
					<li><a href="#" data-filter=".cat4">Paket Promo</a></li>
				</ul>
			</div>

			<div class="grid__inner">
				<div class="grid-sizer"></div>

				<div class="grid-item cat1 cat4">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">

							<!-- box-image3 -->
							<div class="box-image3">
								<div class="box-image3__box">
									<a class="box-image3__bg" href="#" style="background-image: url('assets/img/image_box_3/1.jpg');">
										<img src="assets/img/image_box_3/1.jpg" alt=""/>
									</a>
									<div class="box-image3__info">
										<p class="box-image3__country">Bali</p>
										<span class="box-image3__date">7 Hari / 8 Malam</span>
									</div>
								</div>
								<div class="box-image3__info_right">
									<h6 class="box-image3__tour"><a href="#">Liburan Eksklusif Bali Termasuk Hotel</a></h6>
									<p class="box-image3__text">Nikmati keindahan Pantai Kuta, Tanah Lot, Ubud, dan berbagai destinasi favorit di Pulau Dewata.</p>
									<a class="box-image3__view" href="#">Lihat Paket</a>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="grid-item cat2 cat3">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">

							<div class="box-image3">
								<div class="box-image3__box">
									<a class="box-image3__bg" href="#" style="background-image: url('assets/img/image_box_3/2.jpg');">
										<img src="assets/img/image_box_3/2.jpg" alt=""/>
									</a>
									<div class="box-image3__info">
										<p class="box-image3__country">Labuan Bajo</p>
										<span class="box-image3__date">4 Hari / 3 Malam</span>
									</div>
								</div>
								<div class="box-image3__info_right">
									<h6 class="box-image3__tour"><a href="#">Open Trip Labuan Bajo</a></h6>
									<p class="box-image3__text">Jelajahi Pulau Padar, Pink Beach, Pulau Komodo, dan snorkeling di perairan yang jernih.</p>
									<a class="box-image3__view" href="#">Lihat Paket</a>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="grid-item cat4 cat3">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">

							<div class="box-image3">
								<div class="box-image3__box">
									<a class="box-image3__bg" href="#" style="background-image: url('assets/img/image_box_3/3.jpg');">
										<img src="assets/img/image_box_3/3.jpg" alt=""/>
									</a>
									<div class="box-image3__info">
										<p class="box-image3__country">Yogyakarta</p>
										<span class="box-image3__date">3 Hari / 2 Malam</span>
									</div>
								</div>
								<div class="box-image3__info_right">
									<h6 class="box-image3__tour"><a href="#">Wisata Budaya Yogyakarta</a></h6>
									<p class="box-image3__text">Kunjungi Candi Borobudur, Malioboro, Keraton Yogyakarta, dan wisata kuliner khas.</p>
									<a class="box-image3__view" href="#">Lihat Paket</a>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="grid-item cat3 cat1">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">

							<div class="box-image3">
								<div class="box-image3__box">
									<a class="box-image3__bg" href="#" style="background-image: url('assets/img/image_box_3/4.jpg');">
										<img src="assets/img/image_box_3/4.jpg" alt=""/>
									</a>
									<div class="box-image3__info">
										<p class="box-image3__country">Bromo</p>
										<span class="box-image3__date">2 Hari / 1 Malam</span>
									</div>
								</div>
								<div class="box-image3__info_right">
									<h6 class="box-image3__tour"><a href="#">Sunrise Gunung Bromo</a></h6>
									<p class="box-image3__text">Saksikan matahari terbit yang menakjubkan dan jelajahi lautan pasir serta kawah Bromo.</p>
									<a class="box-image3__view" href="#">Lihat Paket</a>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="grid-item cat1 cat2 cat3">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">

							<div class="box-image3">
								<div class="box-image3__box">
									<a class="box-image3__bg" href="#" style="background-image: url('assets/img/image_box_3/5.jpg');">
										<img src="assets/img/image_box_3/5.jpg" alt=""/>
									</a>
									<div class="box-image3__info">
										<p class="box-image3__country">Raja Ampat</p>
										<span class="box-image3__date">5 Hari / 4 Malam</span>
									</div>
								</div>
								<div class="box-image3__info_right">
									<h6 class="box-image3__tour"><a href="#">Eksplorasi Raja Ampat</a></h6>
									<p class="box-image3__text">Nikmati surga bawah laut Indonesia dengan snorkeling, diving, dan island hopping.</p>
									<a class="box-image3__view" href="#">Lihat Paket</a>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="grid-item cat2 cat4">
					<div class="grid-item__inner">
						<div class="grid-item__content-wrapper">

							<div class="box-image3">
								<div class="box-image3__box">
									<a class="box-image3__bg" href="#" style="background-image: url('assets/img/image_box_3/6.jpg');">
										<img src="assets/img/image_box_3/6.jpg" alt=""/>
									</a>
									<div class="box-image3__info">
										<p class="box-image3__country">Lombok</p>
										<span class="box-image3__date">4 Hari / 3 Malam</span>
									</div>
								</div>
								<div class="box-image3__info_right">
									<h6 class="box-image3__tour"><a href="#">Liburan Seru di Lombok</a></h6>
									<p class="box-image3__text">Kunjungi Pantai Tanjung Aan, Bukit Merese, Gili Trawangan, dan nikmati keindahan alam Lombok.</p>
									<a class="box-image3__view" href="#">Lihat Paket</a>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</section>
				<!-- End / Section -->


				<!-- Section -->
				<section class="awe-section bg-gray pb-0">
					<div class="container">

						<!-- title -->
						<div class="title title__style-02">
							<h2 class="title__title">Tour Guide</h2>
						</div><!-- End / title -->


						<!-- swiper__module swiper-container -->
						<div class="swiper__module swiper-container" data-options='{"slidesPerView":4,"slidesPerColumn":2,"breakpoints":{"320":{"slidesPerView":1,"slidesPerColumn":1},"640":{"slidesPerView":1,"slidesPerColumn":1},"768":{"slidesPerView":1,"slidesPerColumn":1},"1024":{"slidesPerView":3,"slidesPerColumn":2}}}'>
							<div class="swiper-wrapper">

								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/male/18.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Bryan Ryan</h6><span class="expert__work">Photography</span>
									</div>
								</div><!-- End / expert -->


								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/female/17.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Cynthia Aguilar</h6><span class="expert__work">Tour guider</span>
									</div>
								</div><!-- End / expert -->


								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/female/4.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Olivia Ryan</h6><span class="expert__work">Programs Assistant</span>
									</div>
								</div><!-- End / expert -->


								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/male/4.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Alan Lane</h6><span class="expert__work">Tour manager</span>
									</div>
								</div><!-- End / expert -->


								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/male/15.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Brittany Williams</h6><span class="expert__work">CEO & Founder</span>
									</div>
								</div><!-- End / expert -->


								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/female/12.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Sean Coleman</h6><span class="expert__work">Sale excutive</span>
									</div>
								</div><!-- End / expert -->


								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/male/5.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Rachel Wagner</h6><span class="expert__work">Tour consultant</span>
									</div>
								</div><!-- End / expert -->


								<!-- expert -->
								<div class="expert">
									<div class="expert__avatar"><img src="https://uinames.com/api/photos/female/6.jpg"/></div>
									<div class="expert__body">
										<h6 class="expert__name">Bryan Ryan</h6><span class="expert__work">Photography</span>
									</div>
								</div><!-- End / expert -->

							</div>
							<div class="swiper-button-custom">
								<div class="swiper-button-prev-custom"></div>
								<div class="swiper-button-next-custom"></div>
							</div>
						</div><!-- End / swiper__module swiper-container -->


						<!-- swiper__module swiper-container -->
						<div class="swiper__module swiper-container sec-partner" data-options='{"slidesPerView":6,"breakpoints":{"320":{"slidesPerView":2},"640":{"slidesPerView":3},"768":{"slidesPerView":5},"1024":{"slidesPerView":6}}}'>
							<div class="swiper-wrapper">

								<!--  -->
								<div><a href="#"><img src="assets/img/brand/1.png"/></a>
								</div><!-- End /  -->


								<!--  -->
								<div><a href="#"><img src="assets/img/brand/2.png"/></a>
								</div><!-- End /  -->


								<!--  -->
								<div><a href="#"><img src="assets/img/brand/3.png"/></a>
								</div><!-- End /  -->


								<!--  -->
								<div><a href="#"><img src="assets/img/brand/4.png"/></a>
								</div><!-- End /  -->


								<!--  -->
								<div><a href="#"><img src="assets/img/brand/5.png"/></a>
								</div><!-- End /  -->


								<!--  -->
								<div><a href="#"><img src="assets/img/brand/6.png"/></a>
								</div><!-- End /  -->

							</div>
							<div class="swiper-button-custom">
								<div class="swiper-button-prev-custom"></div>
								<div class="swiper-button-next-custom"></div>
							</div>
						</div><!-- End / swiper__module swiper-container -->

					</div>
				</section>
				<!-- End / Section -->

			</div>
			<!-- End / Content-->

			<!-- footer -->
			<div class="footer">
				<div class="container">
					<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2  col-xxs-12">
						<h6 class="footer__title">About us</h6>

						<!-- widget_list -->
						<div class="widget_list">
							<li><a href="#">SEO Optimization</a></li>
							<li><a href="#">Business Planning</a></li>
							<li><a href="#">Social Media</a></li>
							<li><a href="#">Web Development</a></li>
							<li><a href="#">Taxation Services</a></li>
							<li><a href="#">Content Management</a></li>
							<li><a href="#">Risk Management</a></li>
							<li><a href="#">Social Media</a></li>
						</div><!-- End / widget_list -->

					</div>
					<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2  col-xxs-12">
						<h6 class="footer__title">Destinations</h6>

						<!-- widget_list -->
						<div class="widget_list">
							<li><a href="#">SEO Optimization</a></li>
							<li><a href="#">Social Media</a></li>
							<li><a href="#">Support Services</a></li>
							<li><a href="#">Suppport Team</a></li>
							<li><a href="#">Content Management</a></li>
							<li><a href="#">Lawyer Consulting</a></li>
							<li><a href="#">Web Development</a></li>
							<li><a href="#">Risk Management</a></li>
						</div><!-- End / widget_list -->

					</div>
					<div class="col-md-4 col-lg-4 ">
						<h6 class="footer__title">Travel style</h6>

						<!-- widget_list -->
						<div class="widget_list column-2">
							<li><a href="#">Website Design</a></li>
							<li><a href="#">Business Planning</a></li>
							<li><a href="#">Taxation Services</a></li>
							<li><a href="#">Support Services</a></li>
							<li><a href="#">Social Media</a></li>
							<li><a href="#">Market Research</a></li>
							<li><a href="#">Online Marketing</a></li>
							<li><a href="#">SEO Optimization</a></li>
							<li><a href="#">SEO Optimization</a></li>
							<li><a href="#">Taxation Services</a></li>
							<li><a href="#">Email Marketing</a></li>
							<li><a href="#">Brand & Identity</a></li>
							<li><a href="#">Brand & Identity</a></li>
						</div><!-- End / widget_list -->

					</div>
					<div class="col-md-4 col-lg-4 ">
						<h6 class="footer__title">Subscribes</h6>
						<p style="opacity:.7;">Receive news and offers from Mundo</p>
						<div class="footer__form_wrapper">

							<!-- form-item -->
							<div class="form-item">
								<input class="form-control" type="text" name="input" placeholder="Your email here"/>
							</div><!-- End / form-item -->


							<!-- form-item -->
							<div class="form-item">
								<a class="md-btn footer__btn_custom" href="#">Subscribe
								</a>
							</div><!-- End / form-item -->

						</div>
						<div class="footer__social"><span style="font-size:18px;font-weight:bold;">Let’s Get Social:</span>

							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="fa fa-facebook"></i>
							</a><!-- End / social-icon -->


							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="fa fa-twitter"></i>
							</a><!-- End / social-icon -->


							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="fa fa-linkedin"></i>
							</a><!-- End / social-icon -->


							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="fa fa-behance"></i>
							</a><!-- End / social-icon -->


							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="fa fa-vimeo"></i>
							</a><!-- End / social-icon -->

						</div>
					</div>
				</div>
			</div><!-- End / footer -->

			<div class="footer__wrapper">
				<div class="container">
					<p class="footer__copy">2018 &copy; Copyright <a href="http://awe7.com">Travel GO</a>. Free template by <a href="http://awe7.com">Awe7</a>.</p><span class="footer__backtotop" id="back-to-top"> <i class="fa fa-arrow-up"></i>Back to top</span>
				</div>
			</div>
		</div>
		<!-- Vendors-->
		<script type="text/javascript" src="assets/vendors/_jquery/jquery.min.js"></script>
		<script type="text/javascript" src="assets/vendors/imagesloaded/imagesloaded.pkgd.js"></script>
		<script type="text/javascript" src="assets/vendors/isotope-layout/isotope.pkgd.js"></script>
		<script type="text/javascript" src="assets/vendors/jquery-one-page/jquery.nav.min.js"></script>
		<script type="text/javascript" src="assets/vendors/jquery.easing/jquery.easing.min.js"></script>
		<script type="text/javascript" src="assets/vendors/jquery.matchHeight/jquery.matchHeight.min.js"></script>
		<script type="text/javascript" src="assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="assets/vendors/masonry-layout/masonry.pkgd.js"></script>
		<script type="text/javascript" src="assets/vendors/swiper/swiper.jquery.js"></script>
		<script type="text/javascript" src="assets/vendors/menu/menu.js"></script>
		<script type="text/javascript" src="assets/vendors/jquery.select2/select2.js"></script>
		<script type="text/javascript" src="assets/vendors/jquery-ui/jquery-ui.min.js"></script>
		<!-- App-->
		<script type="text/javascript" src="assets/js/main.js"></script>
	</body>
</html>
