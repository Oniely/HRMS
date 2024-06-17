<?php
include 'query.php'; // Include your database connection and query functions
include 'connection.php'; // Include your database connection and query functions

header('Content-Type: application/json'); // Ensure JSON response

try {
    if (isset($_POST['submit'])) {
        $employee_id = $_POST['employee_id']; // You need to pass employee_id from the form
        $status = $_POST['status'];

        // Update employee status
        $newData = ['status' => $status];
        updateDataEmployee($conn, $id, $newData);

        if ($status === 'INACTIVE' && isset($_POST['from_date']) && isset($_POST['to_date'])) {
            // Proceed with leave application logic
            $numberOfDigits = 6;
            $min = pow(10, $numberOfDigits - 1);
            $max = pow(10, $numberOfDigits) - 1;

            $leave_id = rand($min, $max);
            $name = $_POST['name'];

            $fromDate = $_POST['from_date'];
            $toDate = $_POST['to_date'];

            $fromDateTime = new DateTime($fromDate);
            $toDateTime = new DateTime($toDate);

            $interval = $fromDateTime->diff($toDateTime);
            $totalDaysLeave = $interval->days + 1;

            $initialLeaveBalanceQuery = "SELECT * FROM leave_balance_tbl WHERE employee_id = $employee_id";
            $initialLeaveBalanceResult = mysqli_query($conn, $initialLeaveBalanceQuery);

            if ($initialLeaveBalanceResult && mysqli_num_rows($initialLeaveBalanceResult) > 0) {
                $row = mysqli_fetch_assoc($initialLeaveBalanceResult);
                $initialSickLeaveBalance = $row['sick_leave'];
                $initialVacationalLeaveBalance = $row['vacational_leave'];
                $initialBereavementLeaveBalance = $row['bereavement_leave'];
                $initialMarriageLeaveBalance = $row['marriage_leave'];
                $initialOtherLeaveBalance = $row['other_leave'];
            }

            $leaveType = $_POST['leave_type'];
            $newBalance = 0;

            switch ($leaveType) {
                case 'Sick Leave':
                    $newBalance = $initialSickLeaveBalance - $totalDaysLeave;
                    break;
                case 'Vacational Leave':
                    $newBalance = $initialVacationalLeaveBalance - $totalDaysLeave;
                    break;
                case 'Bereavement Leave':
                    $newBalance = $initialBereavementLeaveBalance - $totalDaysLeave;
                    break;
                case 'Marriage Leave':
                    $newBalance = $initialMarriageLeaveBalance - $totalDaysLeave;
                    break;
                case 'Other Leave':
                    $newBalance = $initialOtherLeaveBalance - $totalDaysLeave;
                    break;
                default:
                    throw new Exception('Invalid leave type');
            }

            $insertData = [
                'leave_id' => $leave_id,
                'employee_id' => $employee_id,
                'employee_name' => $name,
                'department' => $_POST['department'],
                'leave_type' => $leaveType,
                'date_applied' => date('Y-m-d'),
                'reason' => $_POST['reason'],
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'total_days_leave' => $totalDaysLeave,
                'application_status' => 'APPROVED',
                'destination' => $_POST['destination'],
                'accompany_with' => $_POST['accompany'],
                'balance_days' => $newBalance
            ];

            insertLeaveEmployee($conn, 'leave_tbl', $insertData);

            // Update leave balance in the leave_balance_tbl
            $updateLeaveBalanceQuery = "UPDATE leave_balance_tbl SET 
                sick_leave = CASE WHEN '$leaveType' = 'Sick Leave' THEN sick_leave - $totalDaysLeave ELSE sick_leave END,
                vacational_leave = CASE WHEN '$leaveType' = 'Vacational Leave' THEN vacational_leave - $totalDaysLeave ELSE vacational_leave END,
                bereavement_leave = CASE WHEN '$leaveType' = 'Bereavement Leave' THEN bereavement_leave - $totalDaysLeave ELSE bereavement_leave END,
                marriage_leave = CASE WHEN '$leaveType' = 'Marriage Leave' THEN marriage_leave - $totalDaysLeave ELSE marriage_leave END,
                other_leave = CASE WHEN '$leaveType' = 'Other Leave' THEN other_leave - $totalDaysLeave ELSE other_leave END
                WHERE employee_id = $employee_id";

            mysqli_query($conn, $updateLeaveBalanceQuery);
        }

        echo json_encode(['status' => 'success', 'message' => 'Employee status updated successfully.']);
    } else {
        throw new Exception('Invalid request method');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
