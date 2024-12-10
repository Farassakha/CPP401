<?php
session_start();
include "connection.php";

$student_id = $_SESSION['id_student'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Personal Information</title>
    <link
        rel="stylesheet"
        href="assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link
        rel="stylesheet"
        href="assets/vendors/flag-icon-css/css/flag-icon.min.css" />
    <link
        rel="stylesheet"
        href="assets/vendors/css/vendor.bundle.base.css" />
    <link
        rel="stylesheet"
        href="assets/vendors/select2/select2.min.css" />
    <link
        rel="stylesheet"
        href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/menu.bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/menustyle.css" rel="stylesheet" />
</head>

<body>
    <div class="container position-relative p-0" id="home">
        <nav
            class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0 justify-content-between d-flex">
            <a href="menu.php" class="navbar-brand p-0">
                <h1 class="m-0 text-white">EduPay</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button
                class="navbar-toggler rounded-pill"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <a
                    href="logoutstudent.php"
                    class="btn btn-danger rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Logout</a>
            </div>
        </nav>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-sample">
                                    <div class="form-row ">
                                        <label class="text-center">Payment Success!</label>
                                        <img src="img/success.png" alt="Payment Success!" style="width: 50%;">
                                    </div>
                                    <a href="menu.php" class="btn btn-danger">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>