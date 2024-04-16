<?php

function hash_password($passw)
{
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($passw, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}

function staffloginAuth($username, $password)
{
    require "connection.php";

    $sql_employee = "SELECT * FROM employee_tbl WHERE email = ? AND employee_id = ?";
    $stmt_employee = $conn->prepare($sql_employee);
    $stmt_employee->bind_param("si", $username, $password);
    $stmt_employee->execute();
    $result_employee = $stmt_employee->get_result();

    $sql_faculty = "SELECT * FROM faculty_tbl WHERE email = ? AND faculty_id = ?";
    $stmt_faculty = $conn->prepare($sql_faculty);
    $stmt_faculty->bind_param("si", $username, $password);
    $stmt_faculty->execute();
    $result_faculty = $stmt_faculty->get_result();

    if ($result_employee->num_rows > 0 || $result_faculty->num_rows > 0) {
        // Login successful, set session variables and redirect to index
        $row = ($result_employee->num_rows > 0) ? $result_employee->fetch_assoc() : $result_faculty->fetch_assoc();
   
        $_SESSION['employee_id'] = $row['employee_id'] ?? $row['faculty_id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];

        $id = $_SESSION['employee_id'];
        return true;
    } else {
        return false;
    }
}
