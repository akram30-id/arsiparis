<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Bank DBS Indonesia - <?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('img/favicon.png') ?>" rel="icon">
    <link href="<?= base_url('img/favicon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- DATATABLE CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- JQUERY JS CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <!-- JQUERY AUTOCOMPLETE -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

    <style>
        a {
            color: #fff;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(.5rem);
            border-radius: 18px;
        }

        /* .modal-backdrop {
            position: !important;
        } */
        .modal-backdrop {
            z-index: -1;
        }

        td {
            vertical-align: middle;
        }

        input[type=checkbox] {
        /* Double-sized Checkboxes */
        -ms-transform: scale(1); /* IE */
        -moz-transform: scale(1); /* FF */
        -webkit-transform: scale(1); /* Safari and Chrome */
        -o-transform: scale(1); /* Opera */
        transform: scale(1);
        padding: 10px;
        border: 1px solid #000;
        }

    </style>

    <!-- =======================================================
  * Template Name: Plato
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/plato-responsive-bootstrap-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Hero Section ======= -->
    <!-- <section id="hero">
        <div class="hero-container" data-aos="fade-up">
        </div>
    </section>End Hero -->

    <section id="hero">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-2 text-center">
                <a href="<?= base_url() ?>">
                    <div class="card mb-3">
                        <div class="card-body">
                            <i class="bi bi-house" style="color: #940014; font-size: 48pt;"></i>
                            <h3 class="fw-bold">Home</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-2 text-center">
                <a href="<?= base_url('building#content') ?>">
                    <div class="card mb-3">
                        <div class="card-body">
                            <i class="bi bi-building" style="color: #940014; font-size: 48pt;"></i>
                            <h3 class="fw-bold">Buildings</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-2 text-center">
                <a href="<?= base_url('storage#content') ?>">
                    <div class="card mb-3">
                        <div class="card-body">
                            <i class="bi bi-archive" style="color: #940014; font-size: 48pt;"></i>
                            <h3 class="fw-bold">Storages</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-sm-2 text-center">
                <a href="<?= base_url('archive#content') ?>">
                    <div class="card mb-3">
                        <div class="card-body">
                            <i class="bi bi-file-zip" style="color: #940014; font-size: 48pt;"></i>
                            <h3 class="fw-bold">Archives</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-2 text-center">
                <a href="<?= base_url('user#content') ?>">
                    <div class="card mb-3">
                        <div class="card-body">
                            <i class="bi bi-people" style="color: #940014; font-size: 48pt;"></i>
                            <h3 class="fw-bold">Users</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-2 text-center">
                <a href="<?= base_url('auth/signout') ?>">
                    <div class="card mb-3">
                        <div class="card-body">
                            <i class="bi bi-box-arrow-right" style="color: #940014; font-size: 48pt;"></i>
                            <h3 class="fw-bold">Logout</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <a href="<?= base_url() ?>">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('img/favicon.png') ?>" alt="">
                        <h1 style="margin-left: 8px; margin-top: 4px;">DBS ARCHIVE SYSTEM</h1>
                    </div>
                </a>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="<?= base_url() ?>assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

        </div>
    </header><!-- End Header -->

    <main id="main">

        <?php $this->load->view($view); ?>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright 2023. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/plato-responsive-bootstrap-website-template/ -->
                Designed by
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $('.datatable').DataTable({
            responsive: true,
            scrollX: true,
            scrollY: false,
            scrollCollapse: true,
        });

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


        /*$(".btn-modal").on("click", function() {
            $(".modal-backdrop").remove();
        }); */



        $('#pencipta').autocomplete({
            source: "<?= base_url('archive/show_profiles') ?>"
        })
    </script>

</body>

</html>