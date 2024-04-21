<?php

include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/auth.php';

session_start();

if (isset($_SESSION['admin_id'])) {
    $current_admin_id = $_SESSION['admin_id'];
    $current_admin_username = $_SESSION['username'];
} else {
    echo 'FAILED';
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $admin_id = $_GET['admin_id'];
    $password = $_GET['password'];

    if (loginAuth($current_admin_username, $password)) {

        $sql = "SELECT username, password FROM admin_tbl WHERE admin_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $admin_id);
        $query->execute();
        $result = $query->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $data = json_encode([$row['username'], $row['password']]);
            echo $data;
        } else {
            echo "FAILED";
        }
    } else {
        echo "FAILED";
    }
}
