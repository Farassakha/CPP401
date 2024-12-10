<?php
include('connection.php');

$id = $_GET['id'] ?? '';
$programmeName = "";
$programmeCode = "";
$programmeCost = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Fetch the programme data based on the ID passed in the URL
    if (!empty($id)) {
        $sql = "SELECT * FROM programme WHERE id_programme = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $programmeName = $row['programme_name'];
            $programmeCode = $row['programme_code'];
            $programmeCost = $row['programme_cost'];
        } else {
            $errorMessage = "Programme not found.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update the student data in the database
    $programmeName = $_POST['programmeName'];
    $programmeCode = $_POST['programmeCode'];
    $programmeCost = $_POST['programmeCost'];

    $sql = "UPDATE programme SET programme_name = ?,programme_code = ?, programme_cost = ? WHERE id_programme = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssii", $programmeName, $programmeCode, $programmeCost, $id);

    if ($stmt->execute()) {
        $successMessage = "Student updated successfully.";
        header("Location: programme.php"); // Redirect to programme
        exit();
    } else {
        $errorMessage = "Error updating programme.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Create Student - EduPay</title>
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
        href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div
            id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div
                class="spinner-border text-primary"
                style="width: 3rem; height: 3rem"
                role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="studentlist.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">
                        <i class="fa fa-hashtag me-2"></i>EDUPAY
                    </h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="admin.php" class="nav-item nav-link"><i class="fa fa-user-graduate me-2"></i>Student Lists</a>
                    <a href="programme.php" class="nav-item nav-link"><i class="fa fa-graduation-cap me-2"></i>Programme Lists</a>
                    <a href="payment_list.php" class="nav-item nav-link "><i class="fa fa-money-bill-wave me-2"></i>Payment Lists</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav
                class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                </form>
                <div class="navbar-nav align-items-center ms-auto">
                </div>

                <a href="admin.php" class="btn btn-primary">Back</a>
            </nav>
            <!-- Navbar End -->

            <!--Create Student Form Starts-->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <h6 class="mb-0 fs-2">Change Programme Data</h6>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_student" value="<?php echo htmlspecialchars($id); ?>">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="programmeName" name="programmeName" placeholder="" value="<?php echo htmlspecialchars($programmeName); ?>">
                                    <label for="programmeName">Programme Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="programmeCode" name="programmeCode" placeholder="Password" value="<?php echo htmlspecialchars($programmeCode); ?>">
                                    <label for="programmeCode">Programme Code</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="programmeCost" name="programmeCost" placeholder="Password" value="<?php echo htmlspecialchars($programmeCost); ?>">
                                    <label for="programmeCost">Programme Cost</label>
                                </div>
                                <!--Button Submit & Cancel Starts-->
                                <div class="row mb-3">
                                    <div class="offset-sm-3 col-sm-3 d-grid">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="col-sm-3 d-grid">
                                        <a href="programme.php" class="btn btn-outline-primary" role="button">Cancel</a>
                                    </div>
                                </div>
                                <!--Button Submit & Cancel Ends-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Create Student Form End--!>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">EduPay</a>, All Right Reserved.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>