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

    $sql = "SELECT * FROM employee_tbl WHERE email='$username' AND employee_id='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $_SESSION['employee_id'] = $row['employee_id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        return true;
    } else {
        return false;
    }
}
