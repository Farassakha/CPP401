<?php
session_start();
include "connection.php";

// Check if student is logged in
if (!isset($_SESSION['id_student'])) {
    header("Location: index.php");
    exit();
}

$student_id = $_SESSION['id_student'];

// Retrieve student details for payment
$query = "SELECT
    students.name,
    students.semester,
    students.subject_count,
    programme.programme_cost,
    (students.subject_count * programme.programme_cost) AS total_tuition
FROM
    students
LEFT JOIN
    programme ON students.programme_id = programme.id_programme
WHERE
    students.id_student = ?";

$stmt = $connect->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student_details = $result->fetch_assoc();

// Prepare insert statement for payment table
$insert_payment_query = "INSERT INTO payments (
    id_student, 
    student_name, 
    payment_semester, 
    subject_count, 
    total_tuition, 
    payment_date
) VALUES (?, ?, ?, ?, ?, NOW())";

$stmt = $connect->prepare($insert_payment_query);
$stmt->bind_param(
    "issid",
    $student_id,
    $student_details['name'],
    $student_details['semester'],
    $student_details['subject_count'],
    $student_details['total_tuition']
);

if ($stmt->execute()) {
    // Payment record inserted successfully
    header("Location: student_paymentconfirm.php");
    exit();
} else {
    // Handle error
    $error_message = "Payment processing failed. Please try again.";
    // You might want to log this error
}
