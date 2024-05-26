<?php

function hash_password($passw)
{
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($passw, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}

function deptloginAuth($username, $password)
{
    require "connection.php";

    $sql_department = "SELECT * FROM department_tbl WHERE username = ? AND password = ?";
    $stmt_department = $conn->prepare($sql_department);
    $stmt_department->bind_param("ss", $username, $password); 
    $stmt_department->execute();

    $result_department = $stmt_department->get_result();
    if ($result_department->num_rows > 0) {
        $row = $result_department->fetch_assoc();
        $_SESSION['department_id'] = $row['department_id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['department'] = $row['department'];
        return true;
    } else {
        return false;
    }
}
