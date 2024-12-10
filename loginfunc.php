<?php
session_start();
include "connection.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: index.php?error= Username Required");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error= Password Required");
        exit();
    } else {
        // Query for admin login
        $sqladmin = "SELECT * FROM admin WHERE name = ? AND password = ?";
        $stmt_admin = $connect->prepare($sqladmin);
        $stmt_admin->bind_param("ss", $username, $password);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        // Query for student login with JOIN to get programme_code
        $sqlstudent = "
            SELECT s.*, p.programme_code 
            FROM students s 
            JOIN programme p ON s.programme_id = p.id_programme
            WHERE s.name = ? AND s.password = ?";
        $stmt_student = $connect->prepare($sqlstudent);
        $stmt_student->bind_param("ss", $username, $password);
        $stmt_student->execute();
        $result_student = $stmt_student->get_result();

        if ($result_admin->num_rows === 1) {
            $row = $result_admin->fetch_assoc();
            // If the user is an admin
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = 'admin';

            header("Location: admin.php"); // Redirect to admin page
            exit();
        } else if ($result_student->num_rows === 1) {
            $row = $result_student->fetch_assoc();
            // If the user is a student
            $_SESSION['name'] = $row['name'];
            $_SESSION['id_student'] = $row['id_student'];
            $_SESSION['metric_no'] = $row['metric_no'];
            $_SESSION['programme'] = $row['programme_code']; // Fetch programme_code
            $_SESSION['email_address'] = $row['email_address'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['semester'] = $row['semester'];
            $_SESSION['year'] = $row['year'];
            $_SESSION['role'] = 'student';

            header("Location: menu.php"); // Redirect to student menu
            exit();
        } else {
            header("Location: index.php?error=Incorrect Username or Password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
