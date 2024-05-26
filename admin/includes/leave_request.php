<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['functionname'])) {
        $functionname = $_POST['functionname'];

        if ($functionname === 'updateApplicationStatus') {
            if (isset($_POST['leave_id'], $_POST['employee_id'], $_POST['status'])) {
                $leave_id = $_POST['leave_id'];
                $employee_id = $_POST['employee_id'];
                $application_status = $_POST['status'];

                $updateResult = updateApplicationStatus($conn, $leave_id, $employee_id, $application_status);
                if ($updateResult) {
                    echo "Application status updated successfully";
                } else {
                    echo "Failed to update application status";
                }
            } else {
                echo "Missing arguments";
            }
        } else if ($functionname === 'updateLeaveBalance') {
            if (isset($_POST['employee_id'], $_POST['leave_type'], $_POST['requested_days'])) {
                $employee_id = $_POST['employee_id'];
                $leave_type = $_POST['leave_type'];
                $requested_days = $_POST['requested_days'];

                $updateLeaveBalanceResult = updateLeaveBalance($conn, $employee_id, $leave_type, $requested_days);
                if ($updateLeaveBalanceResult) {
                    echo "Leave balance updated successfully";
                } else {
                    echo "Failed to update leave balance";
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

function updateApplicationStatus($conn, $leave_id, $employee_id, $application_status)
{
    $sqlUpdateLeave = "UPDATE leave_tbl SET application_status = ? WHERE leave_id = ?";
    $stmtLeave = mysqli_prepare($conn, $sqlUpdateLeave);
    mysqli_stmt_bind_param($stmtLeave, "si", $application_status, $leave_id);
    $resultUpdateLeave = mysqli_stmt_execute($stmtLeave);

    if (!$resultUpdateLeave) {
        return false;
    }

    $sqlCheckFaculty = "SELECT * FROM faculty_tbl WHERE faculty_id = ?";
    $stmtCheckFaculty = mysqli_prepare($conn, $sqlCheckFaculty);
    mysqli_stmt_bind_param($stmtCheckFaculty, "i", $employee_id);
    mysqli_stmt_execute($stmtCheckFaculty);
    $resultCheckFaculty = mysqli_stmt_get_result($stmtCheckFaculty);
    $isFaculty = mysqli_num_rows($resultCheckFaculty) > 0;

    $status = ($application_status === 'APPROVED') ? 'INACTIVE' : 'ACTIVE';
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

    return $resultUpdate;
}

function updateLeaveBalance($conn, $employee_id, $leave_type, $requested_days)
{
    $leave_balance_column = '';
    switch ($leave_type) {
        case 'Sick Leave':
            $leave_balance_column = 'sick_leave';
            break;
        case 'Annual Leave':
            $leave_balance_column = 'annual_leave';
            break;
        case 'Unpaid Leave':
            $leave_balance_column = 'unpaid_leave';
            break;
        default:
            return false;
    }

    $sqlSelectLeaveBalance = "SELECT annual_leave, sick_leave, unpaid_leave FROM leave_balance_tbl WHERE employee_id = ?";
    $stmtSelectLeaveBalance = mysqli_prepare($conn, $sqlSelectLeaveBalance);
    mysqli_stmt_bind_param($stmtSelectLeaveBalance, "i", $employee_id);
    mysqli_stmt_execute($stmtSelectLeaveBalance);
    $resultLeaveBalance = mysqli_stmt_get_result($stmtSelectLeaveBalance);
    $row = mysqli_fetch_assoc($resultLeaveBalance);

    $annual_leave_balance = $row['annual_leave'];
    $sick_leave_balance = $row['sick_leave'];
    $unpaid_leave_balance = $row['unpaid_leave'];

    switch ($leave_type) {
        case 'Sick Leave':
            if ($sick_leave_balance >= $requested_days) {
                $sick_leave_balance -= $requested_days;
            } else {
                return false;
            }
            break;
        case 'Annual Leave':
            if ($annual_leave_balance >= $requested_days) {
                $annual_leave_balance -= $requested_days;
            } else {
                return false;
            }
            break;
        case 'Unpaid Leave':
            if ($unpaid_leave_balance >= $requested_days) {
                $unpaid_leave_balance -= $requested_days;
            } else {
                return false;
            }
            break;
        default:
            return false;
    }

    $sqlUpdateLeaveBalance = "UPDATE leave_balance_tbl SET annual_leave = ?, sick_leave = ?, unpaid_leave = ? WHERE employee_id = ?";
    $stmtUpdateLeaveBalance = mysqli_prepare($conn, $sqlUpdateLeaveBalance);
    mysqli_stmt_bind_param($stmtUpdateLeaveBalance, "iiii", $annual_leave_balance, $sick_leave_balance, $unpaid_leave_balance, $employee_id);
    $resultUpdateLeaveBalance = mysqli_stmt_execute($stmtUpdateLeaveBalance);

    return $resultUpdateLeaveBalance;
}
?>