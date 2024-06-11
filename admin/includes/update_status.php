<?php
function updateEmployeeStatus($conn) {
    // Get the current date
    $currentDate = date('Y-m-d');
    error_log("Current Date: $currentDate");

    // Query to select all employees and faculty with leave end date less than the current date
    $sql = "
        SELECT l.employee_id, 'employee' AS table_type
        FROM leave_tbl l
        INNER JOIN employee_tbl e ON l.employee_id = e.employee_id
        WHERE DATE(l.to_date) < ? AND e.status != 'ACTIVE'
        
        UNION
        
        SELECT l.employee_id, 'faculty' AS table_type
        FROM leave_tbl l
        INNER JOIN faculty_tbl f ON l.employee_id = f.faculty_id
        WHERE DATE(l.to_date) < ? AND f.status != 'ACTIVE'
    ";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        error_log("Error preparing statement: " . mysqli_error($conn));
        return false;
    }

    // Bind the current date to the placeholder
    mysqli_stmt_bind_param($stmt, "ss", $currentDate, $currentDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        error_log("Error fetching employees and faculty with past leave end date: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        return false;
    }

    // Update the status to 'ACTIVE' for each employee or faculty found
    while ($row = mysqli_fetch_assoc($result)) {
        $employee_id = $row['employee_id'];
        $table_type = $row['table_type'];
        error_log("Updating $table_type with ID $employee_id to ACTIVE");

        if ($table_type == 'employee') {
            $updateSql = "UPDATE employee_tbl SET status = 'ACTIVE' WHERE employee_id = ?";
        } else {
            $updateSql = "UPDATE faculty_tbl SET status = 'ACTIVE' WHERE faculty_id = ?";
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
            error_log("Error updating status to ACTIVE in $table_type: " . mysqli_error($conn));
            mysqli_stmt_close($updateStmt);
            mysqli_stmt_close($stmt);
            return false;
        }

        mysqli_stmt_close($updateStmt);
    }

    mysqli_stmt_close($stmt);
    return true;
}
?>
