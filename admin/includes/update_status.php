<?php
function updateEmployeeStatus($conn) {
    // Get the current date
    $currentDate = date('Y-m-d');

    // Query to select all employee and faculty IDs with leave end date less than the current date
    $sql = "
        SELECT l.employee_id, 'employee' AS table_type
        FROM leave_tbl l
        INNER JOIN employee_tbl e ON l.employee_id = e.employee_id
        WHERE l.to_date < ? AND e.status != 'ACTIVE'
        
        UNION
        
        SELECT l.employee_id, 'faculty' AS table_type
        FROM leave_tbl l
        INNER JOIN faculty_tbl f ON l.employee_id = f.faculty_id
        WHERE l.to_date < ? AND f.status != 'ACTIVE'
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $currentDate, $currentDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        error_log("Error fetching employees and faculty with past leave end date: " . mysqli_error($conn));
        return false;
    }

    // Update the status to 'ACTIVE' for each employee or faculty found
    while ($row = mysqli_fetch_assoc($result)) {
        $employee_id = $row['employee_id'];
        $table_type = $row['table_type'];

        if ($table_type == 'employee') {
            $updateSql = "UPDATE employee_tbl SET status = 'ACTIVE' WHERE employee_id = ?";
        } else {
            $updateSql = "UPDATE faculty_tbl SET status = 'ACTIVE' WHERE faculty_id = ?";
        }

        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "i", $employee_id);
        $updateResult = mysqli_stmt_execute($updateStmt);

        if (!$updateResult) {
            error_log("Error updating status to ACTIVE in $table_type: " . mysqli_error($conn));
            return false;
        }

        mysqli_stmt_close($updateStmt);
    }

    mysqli_stmt_close($stmt);
    return true;
}
?>
