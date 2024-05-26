<?php
include "../includes/connection.php";
session_start();

$employee_id = $_SESSION['employee_id'];
$sql = "SELECT * FROM leave_tbl WHERE employee_id = '$employee_id'";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $employee_id = $row['employee_id'];
        $employee_name = $row['employee_name'];
        $reason = $row['reason'];
        $leave_type = $row['leave_type'];
        $start_date = $row['from_date'];
        $end_date = $row['to_date'];
        $date = date('Y-m-d');
        $status = $row['application_status'];
        $leave_id = $row['leave_id'];


        if ($status == 'APPROVED' || $status == 'DEPARTMENT APPROVED') {
            $statusBackground = '#48cfae';
        } elseif ($status == 'REJECTED') {
            $statusBackground = '#fa5858';
        } elseif ($status == 'PENDING') {
            $statusBackground = '#f6c06e';
        }

        echo "<div class='status-items' id='notification_$leave_id' style='background-color: $statusBackground'>";
        echo "<table>";
        echo "<tr'>";
        echo "<th>Application No. </th>";
        echo "<th>Type of Leave </th>";
        echo "<th>Date of Application</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>$leave_id</td>";
        echo "<td>$leave_type</td>";
        echo "<td>$start_date</td>";
        echo "<td>$status</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
    }
}
