<?php

include $_SERVER['DOCUMENT_ROOT'] . '/HRMS/admin/includes/connection.php';

session_name('adminSession');
session_start();

if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) {
    echo "FAILED";
    exit();
}

$department_id = $_POST['department_id'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM department_tbl WHERE username = '$username' AND department_id != '$department_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "EXIST";
    exit();
}

$sqlQuery = "UPDATE department_tbl SET username='$username', password='$password' WHERE department_id = '$department_id'";
$result = mysqli_query($conn, $sqlQuery);

if ($result) {
    echo "SUCCESS";
} else {
    echo "FAILED";
}
