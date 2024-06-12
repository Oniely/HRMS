<?php
function updateEmployeeStatus($conn)
{
    // Get the current date
    $currentDate = date('Y-m-d');
    error_log("Current Date: $currentDate");

    // Query to select all employees and faculty with leave end date less than or equal to the current date
    $sql = "
        SELECT l.employee_id, l.from_date, l.to_date, l.application_status, 'employee' AS table_type
        FROM leave_tbl l
        INNER JOIN employee_tbl e ON l.employee_id = e.employee_id
        
        UNION
        
        SELECT l.employee_id, l.from_date, l.to_date,  l.application_status, 'faculty' AS table_type
        FROM leave_tbl l
        INNER JOIN faculty_tbl f ON l.employee_id = f.faculty_id
    ";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        error_log("Error preparing statement: " . mysqli_error($conn));
        return false;
    }

    // Execute the query
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        error_log("Error fetching employees and faculty with leave data: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        return false;
    }

    // Update the status based on the leave dates
    while ($row = mysqli_fetch_assoc($result)) {
        $employee_id = $row['employee_id'];
        $table_type = $row['table_type'];
        $from_date = $row['from_date'];
        $to_date = $row['to_date'];
        $application_status = $row['application_status'];

        if ($currentDate == $from_date && $application_status === 'APPROVED') {
            // If the current date is the same as the from_date, set status to INACTIVE
            if ($table_type == 'employee') {
                $updateSql = "UPDATE employee_tbl SET status = 'INACTIVE' WHERE employee_id = ?";
            } else {
                $updateSql = "UPDATE faculty_tbl SET status = 'INACTIVE' WHERE faculty_id = ?";
            }
        } elseif ($currentDate > $to_date ) {
            // If the current date is after the to_date, set status to ACTIVE
            if ($table_type == 'employee') {
                $updateSql = "UPDATE employee_tbl SET status = 'ACTIVE' WHERE employee_id = ?";
            } else {
                $updateSql = "UPDATE faculty_tbl SET status = 'ACTIVE' WHERE faculty_id = ?";
            }
        } else {
         
        }
        $updateStmt = mysqli_prepare($conn, $updateSql);
        if (!$updateStmt) {
            error_log("Error preparing update statement for $table_type: " . mysqli_error($conn));
            mysqli_stmt_close($stmt);
            return false;
        }

        mysqli_stmt_bind_param($updateStmt, "i", $employee_id);
        $updateResult = mysqli_stmt_execute($updateStmt);

        if (!$updateResult) {
            error_log("Error updating status in $table_type: " . mysqli_error($conn));
            mysqli_stmt_close($updateStmt);
            mysqli_stmt_close($stmt);
            return false;
        }

        mysqli_stmt_close($updateStmt);
    }

    mysqli_stmt_close($stmt);
    return true;
}
