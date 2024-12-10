<?php
include('connection.php');
session_start();

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';  //UNTUK NGECEK APAKAH DATA BERHASIL KESIMPEN DI SESSION


if (!isset($_SESSION['name'])) {
    header("location: index.php");
    exit();
}

$name = $_SESSION['name']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>EduPay</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

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
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div
            id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div
                class="spinner-grow text-primary"
                style="width: 3rem; height: 3rem"
                role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
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

            <!-- Navbar & Hero End -->

            <!-- Feature Start -->
            <div class="container-xxl py-6">
                <div class="container">
                    <div class="row g-4 justify-content-between">
                        <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <a href="student_information.php" class="text-decoration-none">
                                <div class="feature-item bg-light rounded text-center p-5 mt-5">
                                    <i class="fa fa-4x fa-info text-primary mb-4"></i>
                                    <h5 class="mb-3">Student Info</h5>
                                    <p class="m-0">
                                        View your student information here!
                                    </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <a href="student_tuitionlist.php?id_student=<?php echo $_SESSION['id_student']; ?>" class="text-decoration-none">
                            <div class="feature-item bg-light rounded text-center p-5 mt-5">
                                <i class="fa fa-4x fa-file-invoice text-primary mb-4"></i>
                                <h5 class="mb-3">Tuition Payment</h5>
                                <p class="m-0">
                                    View your student tuition here! Make sure to pay on time!
                                </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->
    </div>

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