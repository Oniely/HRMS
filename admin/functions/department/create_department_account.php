<?php

require_once '../../includes/connection.php';
require_once '../../includes/query.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" &&  isset($_POST['createAccount'])) {
    // add check if the username exists already
    $data = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'contact' => $_POST['contact'],
        'position' => $_POST['position'],
        'department' => $_POST['department']
    ];

    if (insertDataColumns($conn, 'department_tbl', $data)) {
        header('Location: ' . "/hrms/admin/department_sect.php");
    } else {
        return false;
    }
}