<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?> - BANK DBS Indonesia</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>/assets/img/favicon.svg" rel="icon">
    <link href="<?= base_url() ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        p,
        a,
        span {
            color: white !important;
        }

        .card {
            border: 4px solid #b50418;
        }

        body {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-dark">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center bg-dark border-bottom">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="<?= base_url() ?>/assets/img/favicon.svg" alt="">
                <span class="d-none d-lg-block fs-5">DBS Archive System</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn text-light"></i>
            <hr class="bg-danger">
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url() ?>/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $this->session->userdata()['user']->name; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $this->session->userdata()['user']->name; ?></h6>
                            <span>username: @<?= $this->session->userdata()['user']->username; ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('/auth/signout') ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar bg-dark border-end mt-3">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item mb-3">
                <a class="nav-link bg-dark" href="/">
                    <i class="bi bi-house-door-fill" style="color: #b50418; font-size: 15pt;"></i>
                    <span>Homepage</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item mb-3">
                <a class="nav-link bg-dark collapsed" data-bs-target="#bidang-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-buildings-fill" style="color: #b50418; font-size: 15pt;"></i>
                    <span>Buildings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="bidang-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= base_url('building') ?>">
                            <i class="bi bi-circle"></i><span>Data Gedung</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('bidang/new') ?>">
                            <i class="bi bi-circle"></i><span>Data Ruangan</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Buildings Nav -->



            <li class="nav-item mb-3">
                <a class="nav-link bg-dark collapsed" data-bs-target="#vendor-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-archive-fill" style="color: #b50418; font-size: 15pt;"></i>
                    <span>Storages</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="vendor-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= base_url('vendor') ?>">
                            <i class="bi bi-circle"></i><span>Kelola Rak Arsip</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('vendor/incoming') ?>">
                            <i class="bi bi-circle"></i><span>Kelola Dus Arsip</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('vendor/new') ?>">
                            <i class="bi bi-circle"></i><span>Kelola Kategori Arsip</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Storages Nav -->


            <li class="nav-item mb-3">
                <a class="nav-link bg-dark collapsed" data-bs-target="#gudang-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-earmark-zip-fill" style="color: #b50418; font-size: 15pt;"></i>
                    <span>Arsiparis</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gudang-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= base_url('store') ?>">
                            <i class="bi bi-circle"></i><span>Kelola Dokumen</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('store/items') ?>">
                            <i class="bi bi-circle"></i><span>Input Dokumen Baru</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('store/new') ?>">
                            <i class="bi bi-circle"></i><span>Kelola Dokumen Arsip</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('store/new') ?>">
                            <i class="bi bi-circle"></i><span>Input Arsip Baru</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('store/new') ?>">
                            <i class="bi bi-circle"></i><span>Pencarian Arsip</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('store/new') ?>">
                            <i class="bi bi-circle"></i><span>Update Retensi Arsip</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('store/new') ?>">
                            <i class="bi bi-circle"></i><span>Unit Kerja</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Gudang Nav -->


            <li class="nav-item mb-3">
                <a class="nav-link bg-dark collapsed" data-bs-target="#inventory-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people-fill" style="color: #b50418; font-size: 15pt;"></i>
                    <span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="inventory-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="store">
                            <i class="bi bi-circle"></i><span>Kelola User</span>
                        </a>
                    </li>
                    <li>
                        <a href="store/items">
                            <i class="bi bi-circle"></i><span>Ganti Password</span>
                        </a>
                    </li>
                    <li>
                        <a href="store/new">
                            <i class="bi bi-circle"></i><span>Register User Baru</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Inventory Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <?php $this->load->view($view); ?>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            <strong><span>&copy; Copyright BANK DBS INDONESIA. All Rights Reserved</span></strong>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            <p>by <a href="#">Adrian Syahputra</a></p>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/assets/js/main.js"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

</body>

</html>