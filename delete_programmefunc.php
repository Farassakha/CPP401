<?php
include('connection.php');

if (isset($_POST['id_programme'])) {
    $id = $_POST['id_programme'];

    // Prepare the statement to prevent SQL injection
    $stmt = $connect->prepare("DELETE FROM programme WHERE id_programme = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Programme deleted successfully.";
    } else {
        echo "Error deleting student: " . $stmt->error;
    }

    $stmt->close();
}

// Redirect to student list page
header("Location: programme.php");
exit;
