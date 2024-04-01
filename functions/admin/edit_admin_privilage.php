<?php

require_once '../../includes/connection.php';
require_once '../../includes/query.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $admin_id =  $_POST['admin_id'];
    $privilage =  $_POST['privilage'];

    $data = [
        'privilage' =>  $privilage
    ];
    if (updateAdmin($conn, 'admin_tbl', intval($admin_id), $data)) {
        echo true;
    } else {
        echo false;
    }
}
