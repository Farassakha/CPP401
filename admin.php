<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Student List</title>
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
                <a href="admin.php" class="navbar-brand mx-4 mb-3">
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

                <a href="index.php" class="btn btn-danger">Logout</a>
            </nav>
            <!-- Navbar End -->

            <!-- Table Student Start Here -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="createstudent.php" class="btn btn-primary btn-sm">Create Student</a>
                        <h6 class="mb-0 fs-2">Student List</h6>
                        <form class="d-none d-md-flex ms-5">
                            <input
                                class="form-control border-1"
                                type="search"
                                name="search"
                                placeholder="Search Student Name" />
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Matric No</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Programme</th>
                                    <th scope="col">Email Address</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Subject Count</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('connection.php');

                                $sqlstudent = "SELECT students.*, programme.programme_code 
                                                  FROM students 
                                                 LEFT JOIN programme ON students.programme_id = programme.id_programme";

                                // Check if there is a search query
                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $searchTerm = $connect->real_escape_string($_GET['search']);
                                    $sqlstudent .= " WHERE students.name LIKE '%$searchTerm%'";
                                }

                                $result = $connect->query($sqlstudent);

                                // // Modify SQL to include search criteria if applicable
                                // $sqlstudent = "SELECT * FROM students $searchQuery";
                                // $result = $connect->query($sqlstudent);

                                if (!$result) {
                                    die("Invalid Query:" . $connect->error);
                                }

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['id_student']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['metric_no']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['programme_code']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email_address']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['subject_count']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['semester']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                                    echo "<td>";
                                    echo "<a class='btn btn-primary btn-sm mb-2' href='editstudent.php?id=" . htmlspecialchars($row['id_student']) . "'>Edit</a>";
                                    echo "<form action='deletestudentfunc.php' method='POST'>";
                                    echo "<input type='hidden' name='id_student' value='" . htmlspecialchars($row['id_student']) . "'>";
                                    echo "<button type='submit' class='btn btn-danger btn-sm'>Delete</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Student Ends Here -->

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