<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Njenggrik</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('/') }}assets/img/favicon.png" rel="icon">
    <link href="{{ asset('/') }}assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/') }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/') }}assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- =======================================================
   * Template Name: Yummy
   * Updated: Mar 10 2023 with Bootstrap v5.2.3
   * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
   * Author: BootstrapMade.com
   * License: https://bootstrapmade.com/license/
   ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
                {{-- Uncomment the line below if you also wish to use an image logo --}}
                <img src="assets/img/logo.png" alt="">
                {{-- <h1>{{ $judulheader }}<span>.</span></h1> --}}
            </a>

            <a class="nav" href="cart">
                <i class="fas fa-shopping-cart fa-2" style="color: black"></i>
            </a>

            <button class="btn bg-dark rounded-pill text-white ">
                Nomor Meja {{ request()->id }}
            </button>

        </div>
    </header><!-- End Header -->

    <main id="main">
        <!-- ======= Menu Section ======= -->
        <section id="menu" class="menu">
            <div class="container">

                <div class="section-header">
                    {{-- <h2>Our Menu</h2> --}}
                    <p>Our <span> Menu</span></p>
                </div>
                <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <?php $n = 0; ?>
                    @foreach ($menu_tenant_lama as $key => $judul)
                        <li class="nav-item">
                            <a class="nav-link <?php if ($n == 0) {
                                echo 'active show';
                            } ?>  " data-bs-toggle="tab"
                                data-bs-target="#{{ $key }}">
                                <h4>{{ $judul }}</h4>
                            </a>
                        </li><!-- End tab nav item -->
                        <?php $n++; ?>
                    @endforeach
                </ul>

                <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                    <?php $n = 0; ?>

                    @foreach ($menu_tenant as $key => $menu)
                        <div class="tab-pane fade   <?php if ($n == 0) {
                            echo 'active show';
                        } ?> " id="{{ $key }}">

                            <div class="tab-header text-center">
                                <p>Menu</p>
                                {{-- <h3>{{ $key }}</h3> --}}
                            </div>

                            <div class="row gy-5">
                                @foreach ($menu as $value)
                                    <div class="col-lg-4 menu-item">
                                        <a href="assets/img/menu/menu-item-1.png" class="glightbox">
                                            <img src="{{ url('/picture_menu/' . $value->foto_menu) }}"
                                                class="menu-img img-fluid" alt=""></a>
                                        <h4>{{ $value->name_menu }}</h4>
                                        <p class="ingredients">
                                            {{ $value->desc_menu }}
                                        </p>
                                        <p class="price">
                                            {{-- Rp.{{ $value->harga_menu }} --}}
                                            <?php echo 'Rp' . number_format($value->harga_menu, 0, ',', '.'); ?>
                                        </p>
                                        <input name="qty" name="{{ $value->id }} }}" type="asd">
                                    </div><!-- Menu Item -->
                                @endforeach
                            </div>
                        </div><!-- End Starter Menu Content -->
                        <?php $n++; ?>
                    @endforeach
                </div>
            </div>
        </section><!-- End Menu Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Glory Tech.</span></strong> All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
                Designed by <strong>Glory Tech.</strong>
            </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('/') }}assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('/') }}assets/js/main.js"></script>

</body>

</html>
