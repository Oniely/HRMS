<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['functionname'])) {
        $functionname = $_POST['functionname'];

        // Log the function name and all received POST data
        error_log("Function name: " . $functionname);
        error_log("POST data: " . json_encode($_POST));

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
                echo "Missing arguments for updateApplicationStatus";
                error_log("Missing arguments for updateApplicationStatus: " . json_encode($_POST));
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
                echo "Missing arguments for updateLeaveBalance";
                error_log("Missing arguments for updateLeaveBalance: " . json_encode($_POST));
            }
        } else {
            echo "Invalid function name";
            error_log("Invalid function name: " . $functionname);
        }
    } else {
        echo "Missing function name";
        error_log("Missing function name");
    }
} else {
    echo "Invalid request method";
    error_log("Invalid request method");
}

function updateApplicationStatus($conn, $leave_id, $employee_id, $application_status)
{
    // Update the leave application status
    $sqlUpdateLeave = "UPDATE leave_tbl SET application_status = ? WHERE leave_id = ?";
    $stmtLeave = mysqli_prepare($conn, $sqlUpdateLeave);
    if (!$stmtLeave) {
        error_log("Error preparing statement for updating leave: " . mysqli_error($conn));
        return false;
    }
    mysqli_stmt_bind_param($stmtLeave, "si", $application_status, $leave_id);
    $resultUpdateLeave = mysqli_stmt_execute($stmtLeave);
    mysqli_stmt_close($stmtLeave);

    if (!$resultUpdateLeave) {
        error_log("Error executing statement for updating leave: " . mysqli_error($conn));
        return false;
    }

    // Check if the employee is a faculty member
    $sqlCheckFaculty = "SELECT * FROM faculty_tbl WHERE faculty_id = ?";
    $stmtCheckFaculty = mysqli_prepare($conn, $sqlCheckFaculty);
    if (!$stmtCheckFaculty) {
        error_log("Error preparing statement for checking faculty: " . mysqli_error($conn));
        return false;
    }
    mysqli_stmt_bind_param($stmtCheckFaculty, "i", $employee_id);
    mysqli_stmt_execute($stmtCheckFaculty);
    $resultCheckFaculty = mysqli_stmt_get_result($stmtCheckFaculty);
    $isFaculty = mysqli_num_rows($resultCheckFaculty) > 0;
    mysqli_stmt_close($stmtCheckFaculty);

    // Default status
    $status = ($application_status === 'APPROVED') ? 'INACTIVE' : 'ACTIVE';

    if ($application_status === 'APPROVED') {
        // Check the leave end date
        $sqlLeaveEndDate = "SELECT to_date FROM leave_tbl WHERE leave_id = ?";
        $stmtLeaveEndDate = mysqli_prepare($conn, $sqlLeaveEndDate);
        if (!$stmtLeaveEndDate) {
            error_log("Error preparing statement for fetching leave end date: " . mysqli_error($conn));
            return false;
        }
        mysqli_stmt_bind_param($stmtLeaveEndDate, "i", $leave_id);
        mysqli_stmt_execute($stmtLeaveEndDate);
        $resultLeaveEndDate = mysqli_stmt_get_result($stmtLeaveEndDate);
        $leaveRow = mysqli_fetch_assoc($resultLeaveEndDate);
        mysqli_stmt_close($stmtLeaveEndDate);

        if (!$leaveRow) {
            error_log("Error fetching leave end date: No rows returned");
            return false;
        }

        $currentDate = new DateTime();
        $to_date = new DateTime($leaveRow['to_date']);

        // Log date comparison
        error_log("Current date: " . $currentDate->format('Y-m-d'));
        error_log("Leave end date: " . $to_date->format('Y-m-d'));

        // If the current date is past the leave end date, set the status to ACTIVE
        if ($currentDate > $to_date) {
            $status = 'ACTIVE';
        }
    }

    // Update the status in the appropriate table
    if ($isFaculty) {
        $sqlUpdateFaculty = "UPDATE faculty_tbl SET status = ? WHERE faculty_id = ?";
        $stmtUpdateFaculty = mysqli_prepare($conn, $sqlUpdateFaculty);
        if (!$stmtUpdateFaculty) {
            error_log("Error preparing statement for updating faculty status: " . mysqli_error($conn));
            return false;
        }
        mysqli_stmt_bind_param($stmtUpdateFaculty, "si", $status, $employee_id);
        $resultUpdate = mysqli_stmt_execute($stmtUpdateFaculty);
        mysqli_stmt_close($stmtUpdateFaculty);
    } else {
        $sqlUpdateEmployee = "UPDATE employee_tbl SET status = ? WHERE employee_id = ?";
        $stmtUpdateEmployee = mysqli_prepare($conn, $sqlUpdateEmployee);
        if (!$stmtUpdateEmployee) {
            error_log("Error preparing statement for updating employee status: " . mysqli_error($conn));
            return false;
        }
        mysqli_stmt_bind_param($stmtUpdateEmployee, "si", $status, $employee_id);
        $resultUpdate = mysqli_stmt_execute($stmtUpdateEmployee);
        mysqli_stmt_close($stmtUpdateEmployee);
    }

    if (!$resultUpdate) {
        error_log("Error executing statement for updating status: " . mysqli_error($conn));
        return false;
    }

    return true;
}


function updateLeaveBalance($conn, $employee_id, $leave_type, $requested_days)
{
    $leave_balance_column = '';
    $isBalanceLeave = false;

    // Determine if the leave type affects the balance
    switch ($leave_type) {
        case 'Sick Leave':
        case 'Annual Leave':
        case 'Vacational Leave':
        case 'Unpaid Leave':
            $leave_balance_column = strtolower(str_replace(' ', '_', $leave_type));
            $isBalanceLeave = true;
            break;
        case 'Bereavement Leave':
        case 'Marriage Leave':
        case 'Other Leave':
            $leave_balance_column = strtolower(str_replace(' ', '_', $leave_type));
            $isBalanceLeave = false;
            break;
        default:
            return false;
    }

    if ($isBalanceLeave) {
        // Fetch the current leave balances
        $sqlSelectLeaveBalance = "SELECT $leave_balance_column FROM leave_balance_tbl WHERE employee_id = ?";
        $stmtSelectLeaveBalance = mysqli_prepare($conn, $sqlSelectLeaveBalance);
        if (!$stmtSelectLeaveBalance) {
            error_log("Error preparing statement for fetching leave balances: " . mysqli_error($conn));
            return false;
        }
        mysqli_stmt_bind_param($stmtSelectLeaveBalance, "i", $employee_id);
        mysqli_stmt_execute($stmtSelectLeaveBalance);
        $resultLeaveBalance = mysqli_stmt_get_result($stmtSelectLeaveBalance);
        $row = mysqli_fetch_assoc($resultLeaveBalance);

        if (!$row) {
            error_log("Error fetching leave balances: " . mysqli_error($conn));
            return false;
        }

        $leave_balance = $row[$leave_balance_column];

        // Update the leave balance based on the leave type
        if ($leave_balance >= $requested_days) {
            $leave_balance -= $requested_days;
        } else {
            return false;
        }

        // Update the leave balances in the database
        $sqlUpdateLeaveBalance = "UPDATE leave_balance_tbl SET $leave_balance_column = ? WHERE employee_id = ?";
        $stmtUpdateLeaveBalance = mysqli_prepare($conn, $sqlUpdateLeaveBalance);
        if (!$stmtUpdateLeaveBalance) {
            error_log("Error preparing statement for updating leave balance: " . mysqli_error($conn));
            return false;
        }
        mysqli_stmt_bind_param($stmtUpdateLeaveBalance, "ii", $leave_balance, $employee_id);
        $resultUpdateLeaveBalance = mysqli_stmt_execute($stmtUpdateLeaveBalance);
    } else {
        // Fetch the current leave balance for the non-balance affecting leave types
        $sqlSelectLeaveBalance = "SELECT $leave_balance_column FROM leave_balance_tbl WHERE employee_id = ?";
        $stmtSelectLeaveBalance = mysqli_prepare($conn, $sqlSelectLeaveBalance);
        if (!$stmtSelectLeaveBalance) {
            error_log("Error preparing statement for fetching leave balances: " . mysqli_error($conn));
            return false;
        }
        mysqli_stmt_bind_param($stmtSelectLeaveBalance, "i", $employee_id);
        mysqli_stmt_execute($stmtSelectLeaveBalance);
        $resultLeaveBalance = mysqli_stmt_get_result($stmtSelectLeaveBalance);
        $row = mysqli_fetch_assoc($resultLeaveBalance);

        if (!$row) {
            error_log("Error fetching leave balances: " . mysqli_error($conn));
            return false;
        }

        $current_balance = $row[$leave_balance_column];
        $new_balance = $current_balance + $requested_days;

        // Update the leave balances in the database
        $sqlUpdateLeaveBalance = "UPDATE leave_balance_tbl SET $leave_balance_column = ? WHERE employee_id = ?";
        $stmtUpdateLeaveBalance = mysqli_prepare($conn, $sqlUpdateLeaveBalance);
        if (!$stmtUpdateLeaveBalance) {
            error_log("Error preparing statement for updating leave balance: " . mysqli_error($conn));
            return false;
        }
        mysqli_stmt_bind_param($stmtUpdateLeaveBalance, "ii", $new_balance, $employee_id);
        $resultUpdateLeaveBalance = mysqli_stmt_execute($stmtUpdateLeaveBalance);
    }

    if (!$resultUpdateLeaveBalance) {
        error_log("Error executing statement for updating leave balance: " . mysqli_error($conn));
        return false;
    }

    return true;
}

?>
