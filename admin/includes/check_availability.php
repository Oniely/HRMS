<?php

include('connection.php');

if (isset($_POST['check_dates'])) {
    $employee_id = $_POST['employee_id'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $currentDate = date('Y-m-d');

    $sql = "SELECT from_date, to_date FROM leave_tbl WHERE employee_id = ? AND (from_date <= ? AND to_date >= ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $employee_id, $to_date, $from_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $dates = [];
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode($dates);
    exit;
}
?>
