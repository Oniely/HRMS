<?php

include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/connection.php';
include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/auth.php';
include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/query.php';

session_name('adminSession');
session_start();

if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$department_id = $_GET['department_id'];
$password = $_GET['password'];

$admin_id = $_SESSION['admin_id'];
$sql = "SELECT username,password FROM admin_tbl WHERE admin_id = $admin_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Database query failed']);
    exit();
}

$row = mysqli_fetch_assoc($result);

if (loginAuth($row['username'], $password)) {
    $sql = "SELECT username, password FROM department_tbl WHERE department_id = '$department_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo json_encode(['status' => 'error', 'message' => 'Database query failed']);
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    echo json_encode(['status' => 'success', 'username' => $row['username'], 'password' => $row['password']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Password verification failed']);
}
