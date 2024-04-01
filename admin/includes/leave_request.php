<?php 

include('connection.php');

function updateDataEmployee($conn, $leave_id, $employee_id, $newData, $application_status)
{
    $setClause = "";
    foreach ($newData as $column => $value) {
        $setClause .= "$column = '$value', ";
    }
    $setClause = rtrim($setClause, ', ');

    $sqlUpdate = "UPDATE employee_tbl SET $setClause WHERE employee_id = '$employee_id'";
    $resultUpdate = mysqli_query($conn, $sqlUpdate) or die(mysqli_error($conn));


    if ($resultUpdate) {
        $sqlUpdateLeave = "UPDATE leave_tbl SET application_status = '$application_status' WHERE leave_id = '$leave_id'";
        $resultUpdateLeave = mysqli_query($conn, $sqlUpdateLeave) or die(mysqli_error($conn));

        if ($resultUpdateLeave) {
            return $resultUpdateLeave;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$leave_id = $_POST['arguments'][0];
$employee_id = $_POST['arguments'][1];
$newData = $_POST['arguments'][2];
$application_status = $_POST['arguments'][3];

$updateResult = updateDataEmployee($conn, $leave_id, $employee_id, $newData, $application_status);

if ($updateResult !== false) {
    echo "Request Approved Successfully";
    header("Location: ../index.php");
} else {
    echo "Error updating employee data: " . mysqli_error($conn);
}

?>