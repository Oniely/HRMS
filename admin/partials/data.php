<?php 
include("../includes/connection.php");

$sql = "SELECT COUNT(*) as unread_count FROM leave_tbl WHERE application_status = 'DEPARTMENT APPROVED' || application_status = 'APPROVED' || application_status = 'REJECTED'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["unread_count"];
} else {
    echo "0";
}
?>
