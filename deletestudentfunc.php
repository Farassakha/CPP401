<?php
include('connection.php');

if (isset($_POST['id_student'])) {
    $id = $_POST['id_student'];

    // Prepare the statement to prevent SQL injection
    $stmt = $connect->prepare("DELETE FROM students WHERE id_student = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Student deleted successfully.";
    } else {
        echo "Error deleting student: " . $stmt->error;
    }

    $stmt->close();
}

// Redirect to student list page
header("Location: admin.php");
exit;
