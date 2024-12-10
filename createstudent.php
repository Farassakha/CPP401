<?php
include('connection.php');

// Initialize variables
$name = "";
$password = "";
$metric_no = "";
$gender = "";
$subject_count = "";
$programme_id = "";
$email_address = "";
$phone_number = "";
$semester = "";
$year = "";

$errorMessage = "";
$successMessage = "";

// Fetch programmes from the database with JOIN query
$programmeOptions = '';
$query = "SELECT programme_code, id_programme FROM programme";
$result = $connect->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $selected = ($programme_id == $row['id_programme']) ? 'selected' : '';
        $programmeOptions .= "<option value='{$row['id_programme']}' $selected>{$row['programme_code']}</option>";
    }
} else {
    $programmeOptions = "<option value=''>No programmes available</option>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['studentName'];
    $password = $_POST['password'];
    $metric_no = $_POST['matricNo'];
    $gender = $_POST['selectGender'];
    $programme_id = $_POST['selectProgramme'];
    $email_address = $_POST['email'];
    $phone_number = $_POST['phoneNumber'];
    $semester = $_POST['selectSemester'];
    $year = $_POST['selectYear'];
    $subject_count = $_POST['selectSubject'];

    // Validation: Ensure all fields are filled
    $arrFields = [
        'Name' => $name,
        'Password' => $password,
        'Metric No' => $metric_no,
        'Gender' => $gender,
        'Programme ID' => $programme_id,
        'Email Address' => $email_address,
        'Phone Number' => $phone_number,
        'Semester' => $semester,
        'Year' => $year,
        'Subject Count' => $subject_count
    ];

    foreach ($arrFields as $field => $value) {
        if (empty($value)) {
            $errorMessage = 'Please fill all the fields!';
            break;
        }
    }

    if (empty($errorMessage)) {
        // Verify programme exists
        $query = "SELECT programme_code FROM programme WHERE id_programme = ?";
        $programme_stmt = $connect->prepare($query);
        $programme_stmt->bind_param("i", $programme_id);
        $programme_stmt->execute();
        $programme_result = $programme_stmt->get_result();

        if ($programme_result->num_rows > 0) {
            $programme_row = $programme_result->fetch_assoc();
            $programme_code = $programme_row['programme_code'];

            // Insert data into students table
            $insert_query = "INSERT INTO students (name, password, metric_no, gender, programme_id, email_address, phone_number, semester, year, subject_count) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connect->prepare($insert_query);
            $stmt->bind_param('ssssissssi', $name, $password, $metric_no, $gender, $programme_id, $email_address, $phone_number, $semester, $year, $subject_count);

            if ($stmt->execute()) {
                $successMessage = 'Student Successfully Added!';
                $name = $password = $metric_no = $gender = $programme_id = $email_address = $phone_number = $semester = $year = $subject_count = '';

                header("Location: admin.php");
                exit();
            } else {
                $errorMessage = 'Error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Invalid programme selected!';
        }
        $programme_stmt->close();
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
            </nav>
            <!-- Navbar End -->

            <!--Create Student Form Starts-->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <h6 class="mb-0 fs-2">Add New Student</h6>
                    </div>
                    <form action="" method="post">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="studentName" name="studentName" placeholder="" value="<?php echo htmlspecialchars($name); ?>">
                                    <label for="studentName">Student Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="matricNo" name="matricNo" placeholder="Password" value="<?php echo htmlspecialchars($metric_no); ?>">
                                    <label for="matricNo">Matric No</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
                                    <label for="password">Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="selectProgramme" name="selectProgramme">
                                        <?= $programmeOptions ?>
                                    </select>
                                    <label for="selectProgramme" class="form-label">Programme</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="selectSubject" aria-label="Floating label select example" name="selectSubject">
                                        <option value="" <?php if ($subject_count == "") echo "selected"; ?>>Choose Subject Count</option>
                                        <option value="3" <?php if ($subject_count == 3) echo "selected"; ?>>3</option>
                                        <option value="5" <?php if ($subject_count == 5) echo "selected"; ?>>5</option>
                                    </select>
                                    <label for="selectSubject">Select Subject Count</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Insert Email..." name="email" value="<?php echo htmlspecialchars($email_address); ?>">
                                    <label for="email">Email Address</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="phoneNumber" placeholder="Insert Phone Number..." name="phoneNumber" value="<?php echo htmlspecialchars($phone_number); ?>">
                                    <label for="phoneNumber">Phone Number</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="selectGender" aria-label="Floating label select example" name="selectGender">
                                        <option value="" <?php if ($gender == "") echo "selected"; ?>>Choose Gender</option>
                                        <option value="male" <?php if ($gender == "male") echo "selected"; ?>>Male</option>
                                        <option value="female" <?php if ($gender == "female") echo "selected"; ?>>Female</option>
                                    </select>
                                    <label for="selectGender">Select Gender</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="selectSemester" aria-label="Floating label select example" name="selectSemester">
                                        <option value="" <?php if ($semester == "") echo "selected"; ?>>Choose Semester</option>
                                        <option value="January" <?php if ($semester == "January") echo "selected"; ?>>January</option>
                                        <option value="April" <?php if ($semester == "April") echo "selected"; ?>>April</option>
                                        <option value="July" <?php if ($semester == "July") echo "selected"; ?>>July</option>
                                        <option value="November" <?php if ($semester == "November") echo "selected"; ?>>November</option>
                                    </select>
                                    <label for="selectSemester">Select Semester</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="selectYear" aria-label="Floating label select example" name="selectYear">
                                        <option value="" <?php if ($year == "") echo "selected"; ?>>Choose Year</option>
                                        <?php for ($y = 2021; $y <= 2029; $y++): ?>
                                            <option value="<?php echo $y; ?>" <?php if ($year == $y) echo "selected"; ?>><?php echo $y; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <label for="selectYear">Select Year</label>
                                </div>
                                <!--Button Submit & Cancel Starts-->
                                <div class="row mb-3">
                                    <div class="offset-sm-3 col-sm-3 d-grid">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="col-sm-3 d-grid">
                                        <a href="admin.php" class="btn btn-outline-primary" role="button">Cancel</a>
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