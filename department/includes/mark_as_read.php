<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['leave_id'])) {
        $leave_id = $_POST['leave_id'];

        // Update department read status
        $sql = "UPDATE leave_tbl SET department_read_status = 1 WHERE leave_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            error_log("Error preparing statement for updating department read status: " . mysqli_error($conn));
            echo "Error preparing statement";
            exit;
        }
        mysqli_stmt_bind_param($stmt, "i", $leave_id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if (!$result) {
            error_log("Error executing statement for updating department read status: " . mysqli_error($conn));
            echo "Error updating status";
        } else {
            echo "Status updated successfully";
        }
    } else {
        echo "Missing parameters";
    }
} else {
    echo "Invalid request method";
}
