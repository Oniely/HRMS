<?php
include('connection.php');

function updateDataEmployee($conn, $leave_id, $employee_id, $newData, $application_status)
{
    // Use prepared statement to prevent SQL injection
    $sqlUpdate = "UPDATE employee_tbl SET status = ? WHERE employee_id = ?";
    $stmt = mysqli_prepare($conn, $sqlUpdate);
    mysqli_stmt_bind_param($stmt, "si", $newData['status'], $employee_id);
    $resultUpdate = mysqli_stmt_execute($stmt);

    if ($resultUpdate) {
        // Update leave_tbl
        $sqlUpdateLeave = "UPDATE leave_tbl SET application_status = ? WHERE leave_id = ?";
        $stmtLeave = mysqli_prepare($conn, $sqlUpdateLeave);
        mysqli_stmt_bind_param($stmtLeave, "si", $application_status, $leave_id);
        $resultUpdateLeave = mysqli_stmt_execute($stmtLeave);

        if ($resultUpdateLeave) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the function name is provided and is 'updateDataEmployee'
    if (isset($_POST['functionname']) && $_POST['functionname'] === 'updateDataEmployee') {
        // Check if all necessary arguments are provided
        if (isset($_POST['arguments']) && count($_POST['arguments']) === 4) {
            $leave_id = $_POST['arguments'][0];
            $employee_id = $_POST['arguments'][1];
            $newData = $_POST['arguments'][2];
            $application_status = $_POST['arguments'][3];

            // Update the data
            $updateResult = updateDataEmployee($conn, $leave_id, $employee_id, $newData, $application_status);

            if ($updateResult) {
                echo "Request Approved/Rejected Successfully";
            } else {
                echo "Error updating employee data";
            }
        } else {
            echo "Missing arguments";
        }
    } else {
        echo "Invalid function name";
    }
} else {
    echo "Invalid request method";
}
