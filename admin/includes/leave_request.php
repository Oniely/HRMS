<?php
include('connection.php');

function updateDataEmployee($conn, $leave_id, $employee_id, $newData, $application_status)
{
    // Check if the employee is in the faculty_tbl
    $sqlCheckFaculty = "SELECT * FROM faculty_tbl WHERE faculty_id = ?";
    $stmtCheckFaculty = mysqli_prepare($conn, $sqlCheckFaculty);
    mysqli_stmt_bind_param($stmtCheckFaculty, "i", $employee_id);
    mysqli_stmt_execute($stmtCheckFaculty);
    $resultCheckFaculty = mysqli_stmt_get_result($stmtCheckFaculty);
    $isFaculty = mysqli_num_rows($resultCheckFaculty) > 0;

    // Determine the status based on the application status
    $status = ($application_status === 'APPROVED') ? 'INACTIVE' : 'ACTIVE';

    // Use different update queries based on whether the employee is faculty or not
    if ($isFaculty) {
        $sqlUpdateFaculty = "UPDATE faculty_tbl SET status = ? WHERE faculty_id = ?";
        $stmtUpdateFaculty = mysqli_prepare($conn, $sqlUpdateFaculty);
        mysqli_stmt_bind_param($stmtUpdateFaculty, "si", $status, $employee_id);
        $resultUpdate = mysqli_stmt_execute($stmtUpdateFaculty);
    } else {
        $sqlUpdateEmployee = "UPDATE employee_tbl SET status = ? WHERE employee_id = ?";
        $stmtUpdateEmployee = mysqli_prepare($conn, $sqlUpdateEmployee);
        mysqli_stmt_bind_param($stmtUpdateEmployee, "si", $status, $employee_id);
        $resultUpdate = mysqli_stmt_execute($stmtUpdateEmployee);
    }

    if ($resultUpdate) {
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['functionname']) && $_POST['functionname'] === 'updateDataEmployee') {
        if (isset($_POST['arguments']) && count($_POST['arguments']) === 4) {
            $leave_id = $_POST['arguments'][0];
            $employee_id = $_POST['arguments'][1];
            $newData = $_POST['arguments'][2];
            $application_status = $_POST['arguments'][3];

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
