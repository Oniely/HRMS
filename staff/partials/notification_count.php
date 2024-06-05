<?php
include('../includes/connection.php');
session_start();
if (isset($_SESSION['employee_id'])) {
    $employee_id = $_SESSION['employee_id'];
} else {
    die("Error: Department session variable is not set.");
}
if (isset($conn) && $conn) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT COUNT(*) AS notification_count FROM leave_tbl WHERE employee_id = ?");
    if ($stmt) {
        $stmt->bind_param("s", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            $notificationCount = $row['notification_count'];
            echo $row["notification_count"];
        } else {
            echo "0";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    die("Error: Database connection not established.");
}
