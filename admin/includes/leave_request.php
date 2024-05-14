<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['functionname'])) {
        $functionname = $_POST['functionname'];

        if ($functionname === 'updateDataEmployee') {
            if (isset($_POST['leave_id'], $_POST['employee_id'], $_POST['newData'], $_POST['status'], $_POST['leave_type'], $_POST['requested_days'])) {
                $leave_id = $_POST['leave_id'];
                $employee_id = $_POST['employee_id'];
                $newData = $_POST['newData'];
                $application_status = $_POST['status'];
                $leave_type = $_POST['leave_type'];
                $requested_days = $_POST['requested_days'];

                $updateResult = updateDataEmployee($conn, $leave_id, $employee_id, $newData, $application_status);
                if ($updateResult) {
                    echo "Request Approved/Rejected Successfully";
                }

                $updateLeaveBalanceResult = updateLeaveBalance($conn, $employee_id, $leave_type, $requested_days);
                if ($updateLeaveBalanceResult) {
                    echo "Leave Balance Updated Successfully";
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
                    echo "Leave Balance Updated Successfully";
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

function updateDataEmployee($conn, $leave_id, $employee_id, $newData, $application_status)
{
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

    if ($resultUpdate) {
        $sqlUpdateLeave = "UPDATE leave_tbl SET application_status = ? WHERE leave_id = ?";
        $stmtLeave = mysqli_prepare($conn, $sqlUpdateLeave);
        mysqli_stmt_bind_param($stmtLeave, "si", $application_status, $leave_id);
        $resultUpdateLeave = mysqli_stmt_execute($stmtLeave);

        if ($resultUpdateLeave) {
            // Select the leave details
            $sqlSelectLeave = "SELECT * FROM leave_tbl WHERE leave_id = ?";
            $stmtSelectLeave = mysqli_prepare($conn, $sqlSelectLeave);
            mysqli_stmt_bind_param($stmtSelectLeave, "i", $leave_id);
            mysqli_stmt_execute($stmtSelectLeave);
            $resultLeave = mysqli_stmt_get_result($stmtSelectLeave);
            $rowLeave = mysqli_fetch_assoc($resultLeave);

            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
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

    // Retrieve the current leave balance
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
                return false; // Not enough sick leave balance
            }
            break;
        case 'Annual Leave':
            if ($annual_leave_balance >= $requested_days) {
                $annual_leave_balance -= $requested_days;
            } else {
                return false; // Not enough annual leave balance
            }
            break;
        case 'Unpaid Leave':
            if ($unpaid_leave_balance >= $requested_days) {
                $unpaid_leave_balance -= $requested_days;
            } else {
                return false; // Not enough unpaid leave balance
            }
            break;
        default:
            return false; // Invalid leave type
    }

    $sqlUpdateLeaveBalance = "UPDATE leave_balance_tbl SET annual_leave = ?, sick_leave = ?, unpaid_leave = ? WHERE employee_id = ?";
    $stmtUpdateLeaveBalance = mysqli_prepare($conn, $sqlUpdateLeaveBalance);
    mysqli_stmt_bind_param($stmtUpdateLeaveBalance, "iiii", $annual_leave_balance, $sick_leave_balance, $unpaid_leave_balance, $employee_id);
    $resultUpdateLeaveBalance = mysqli_stmt_execute($stmtUpdateLeaveBalance);

    if ($resultUpdateLeaveBalance) {
        return true;
    } else {
        return false;
    }
}
