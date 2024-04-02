<?php

include '../../includes/connection.php';
include '../../includes/query.php';

session_start();

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $admin_fname = $_SESSION['fname'];
    $admin_lname = $_SESSION['lname'];
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $path = saveProfileImage('photo', '../../images/profiles');
    $cleanedPath = strstr($path, 'images/');

    if ($path && $cleanedPath) {
        $sql = "UPDATE admin_tbl SET photo_path='$cleanedPath' WHERE admin_id=$admin_id";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "SUCCESS";
        } else {
            echo "FAILED";
        }
    } else {
        echo "FAILED";
    }
}
