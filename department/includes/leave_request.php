<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['functionname'])) {
        $functionname = $_POST['functionname'];

        if ($functionname === 'updateApplicationStatus') {
            if (isset($_POST['leave_id'], $_POST['status'])) {
                $leave_id = $_POST['leave_id'];
                $application_status = $_POST['status'];

                $updateResult = updateApplicationStatus($conn, $leave_id, $application_status);
                if ($updateResult) {
                    echo "Application status updated successfully";
                } else {
                    echo "Failed to update application status";
                }
            } else {
                echo "Missing arguments";
            }
        } else {
            echo "Invalid function name";
        }
    } else {
        echo "Missing function name";
    }
} else {
    echo "Invalid request method";
}

function updateApplicationStatus($conn, $leave_id, $application_status)
{
    $sqlUpdateLeave = "UPDATE leave_tbl SET application_status = ? WHERE leave_id = ?";
    $stmtLeave = mysqli_prepare($conn, $sqlUpdateLeave);
    mysqli_stmt_bind_param($stmtLeave, "si", $application_status, $leave_id);
    $resultUpdateLeave = mysqli_stmt_execute($stmtLeave);

    if ($resultUpdateLeave) {
        return true;
    } else {
        return false;
    }
}
// function forwardToAdmin($conn, $leave_id) {
//     $sql = "UPDATE leave_tbl SET admin_read_status = 0 WHERE leave_id = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     if (!$stmt) {
//         error_log("Error preparing statement for resetting admin read status: " . mysqli_error($conn));
//         return false;
//     }
//     mysqli_stmt_bind_param($stmt, "i", $notification_id);
//     $result = mysqli_stmt_execute($stmt);
//     mysqli_stmt_close($stmt);

//     if (!$result) {
//         error_log("Error resetting admin read status: " . mysqli_error($conn));
//         return false;
//     }
//     return true;
// }