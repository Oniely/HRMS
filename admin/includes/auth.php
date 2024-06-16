<?php

function hash_password($passw)
{
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($passw, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}

function loginAuth($username, $password)
{
    require "connection.php";


    $sql = "SELECT * FROM admin_tbl WHERE username='$username'";
    $result = $conn->query($sql);

  
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['admin_privilage'] = $row['privilage'];
            $_SESSION['profile_photo'] = $row['photo_path'];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}



function signUpAuth($fname, $lname, $contact, $username, $password)
{
    require "connection.php";

    $sql = "SELECT * FROM admin_tbl WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return false;
    }

    $insertSql = "INSERT INTO site_user VALUES (DEFAULT, ?, ?, ?, ?, ?)";
    $query = $conn->prepare($insertSql);
    $query->bind_param("sssss", $fname, $lname, $contact, $username, $password);
    $query->execute();

    if ($query->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}
