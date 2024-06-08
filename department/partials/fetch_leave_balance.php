<?php

include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $leave_type = $_POST['leave_type'];

    $leave_balance_column = '';
    switch ($leave_type) {
        case 'Annual Leave':
            $leave_balance_column = 'annual_leave';
            break;
        case 'Vacational Leave':
            $leave_balance_column = 'vacational_leave';
            break;
        default:
            echo json_encode(['balance' => 0]);
            exit;
    }

    $sql = "SELECT $leave_balance_column AS balance FROM leave_balance_tbl WHERE employee_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $employee_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                echo json_encode(['balance' => $row['balance']]);
            } else {
                echo json_encode(['balance' => 0]);
            }
        } else {
            error_log("Error fetching result: " . mysqli_error($conn));
            echo json_encode(['balance' => 0]);
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Error preparing statement: " . mysqli_error($conn));
        echo json_encode(['balance' => 0]);
    }
} else {
    error_log("Invalid request method.");
    echo json_encode(['balance' => 0]);
}
