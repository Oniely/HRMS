<?php

include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/auth.php';

session_name('adminSession');
session_start();

if (isset($_SESSION['admin_id'])) {
    $current_admin_id = $_SESSION['admin_id'];
    $current_admin_username = $_SESSION['username'];
} else {
    echo 'NO ADMIN ID';
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $admin_id = $_GET['admin_id'];
    $password = $_GET['password'];

    if (loginAuth($current_admin_username, $password)) {

        $sql = "SELECT username, password, fname, lname, contact, photo_path FROM admin_tbl WHERE admin_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $admin_id);
        $query->execute();
        $result = $query->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $data = json_encode([$row['username'], $row['password'], $row['fname'], $row['lname'], $row['contact'], $row['photo_path']]);
            echo $data;
        } else {
            echo "FETCH FAILED";
        }
    } else {
        echo "FAILED";
    }
}
