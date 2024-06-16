<?php

session_name('adminSession');
session_start();

include '../../includes/connection.php';

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    echo "NO_SESSION";
    exit();
}

$admin_id = $_SESSION['admin_id'];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['admin_username'];
    $password = $_POST['e-admin_password'];
    $fname = $_POST['admin_fname'];
    $lname = $_POST['admin_lname'];
    $contact = $_POST['admin_number'];
    $photo_path = "";

    if (!file_exists('../../images/profiles')) {
        mkdir('../../images/profiles', 0755, true);
    }

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $imageFile = $_FILES['photo'];
        $fileExtension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
        $filename = uniqid('photo_', true) . '.' . $fileExtension;

        $targetFilePath = '../../images/profiles/' . $filename;

        $check = getimagesize($imageFile['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($imageFile['tmp_name'], $targetFilePath)) {
                $photo_path = "/hrms/admin/images/profiles/" . $filename;
            }
        }
    }

    if ($photo_path && $photo_path !== "") {
        $sql = "UPDATE admin_tbl SET username = '$username', password = '$password', fname = '$fname', lname = '$lname', contact = '$contact', photo_path = '$photo_path' WHERE admin_id = $admin_id";

        $_SESSION['profile_photo'] = $photo_path;
    } else {
        $sql = "UPDATE admin_tbl SET username = '$username', password = '$password', fname = '$fname', lname = '$lname', contact = '$contact' WHERE admin_id = $admin_id";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $username;
        echo "SUCCESS";
    } else {
        echo "UPDATE_FAILED";
    }
} else {
    echo "INVALID_REQUEST";
}