<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['leave_id'])) {
        $leave_id = $_POST['leave_id'];
        $sql = "UPDATE leave_tbl SET read_status = TRUE WHERE leave_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $leave_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "missing_leave_id";
    }
} else {
    echo "invalid_request";
}
?>
