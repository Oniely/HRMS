<?php
// Replace 'username', 'password', and 'database_name' with the correct values
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hr";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die('Error' . $conn->connect_error);
}

$sql = "SELECT COUNT(*) AS count FROM leave_tbl WHERE application_status = 'DEPARTMENT APPROVED'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $notificationCount = $row['count'];
} else {
    echo "Error: " . $conn->error;
}

?>