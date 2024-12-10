<?php
include 'connection.php';

session_start();

// Check if student is logged in
if (!isset($_SESSION['id_student'])) {
    header("Location: login.php");
    exit();
}

$studentid = $_SESSION['id_student'];

// Prepare SQL query to fetch payment history
$query = "SELECT p.*, s.name
          FROM payments p
          JOIN students s ON p.id_student = s.id_student
          WHERE p.id_student = ?
          ORDER BY p.payment_date DESC";

try {
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $studentid);
    $stmt->execute();
    $result = $stmt->get_result();
} catch (Exception $e) {
    // Handle any database errors
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Payment History</title>
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
    <!--Navbar starts-->
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
        <!--Navbar ends-->
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <a href="student_tuitionlist.php" class="btn btn-danger">Back</a>
                                </ol>
                            </nav>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title text-center mb-5">Payment History</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Full Name</th>
                                                        <th>Semester</th>
                                                        <th>Subjects</th>
                                                        <th>Total Tuition</th>
                                                        <th>Payment Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $count . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['payment_semester']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['subject_count']) . "</td>";
                                                            echo "<td>$ " . number_format($row['total_tuition'], 2) . "</td>";
                                                            echo "<td>" . date('M d, Y', strtotime($row['payment_date'])) . "</td>";
                                                            echo "</tr>";
                                                            $count++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6' class='text-center'>No payment history found.</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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