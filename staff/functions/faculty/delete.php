<?php
include('../../includes/connection.php');

if (isset($_GET["id"])) {
    $faculty_id = $_GET["id"];
    echo '<script>
            var confirmation = confirm("Are you sure you want to delete the data?");
            if (confirmation) {
                window.location.href = "delete_employee.php?id=' . $faculty_id . '";
            } else {
                window.location.href = "../../all_faculty.php";
            }
          </script>';
}
?>