<?php
session_name('departmentSession');
session_start();
global $conn;

include('includes/connection.php');



if (isset($_SESSION['department_id'])) {
    $id = $_SESSION['department_id'];
    $query = "SELECT * FROM department_tbl WHERE department_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($query_res && mysqli_num_rows($query_res) > 0) {
        $row = mysqli_fetch_assoc($query_res);
        $department_id = $row['department_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $position = $row['position'];
        $contact = $row['contact'];
        $department = $row['department'];

        $_SESSION['department'] = $department;
    } else {
        echo "Department not found.";
    }
} else {

    header("Location: department_login.php");
    exit();
}

if ($department == 'SECSA') {
    $statusBackground = '#fe5000';
} elseif ($department == 'SEAS') {
    $statusBackground = '#f6c06e';
} elseif ($department == 'SHTM') {
    $statusBackground = '#ff369b';
} elseif ($department == 'SBA') {
    $statusBackground = '#80d4c2';
}

require_once './includes/query.php';
$active = "dashboard";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css" />
    <link rel="stylesheet" href="styles/about.css" />
    <link rel="stylesheet" href="styles/index.css" />
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <script src="script/status-modal.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- Side Bar -->
    <?php require 'partials/aside.php' ?>
    <!-- Navbar -->
    <?php require 'partials/nav.php' ?>
    <!-- All Staff -->
    <!-- ONLY SECTION ONLY -->
    <section class="section">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1><?php echo $department . " Dashboard" ?></h1>
            <div class="addbreadcrumbs">
                <a href="#">Home</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="dashboard-boxes">
            <div class="box employee" style='background-color: <?php echo $statusBackground ?>'>
                <div class="box-img">
                    <img src="images/box (1).svg" alt="" />
                </div>
                <div class="box-info">
                    <h1>Total Employee</h1>
                    <?php
                    $sql1 = "SELECT COUNT(*) as count FROM employee_tbl WHERE department = '$department'";
                    $sql2 = "SELECT COUNT(*) as count FROM faculty_tbl WHERE department = '$department'";
                    $result1 = mysqli_query($conn, $sql1);
                    $result2 = mysqli_query($conn, $sql2);
                    $row1 = mysqli_fetch_assoc($result1);
                    $row2 = mysqli_fetch_assoc($result2);
                    $total = $row1['count'] + $row2['count'];
                    echo '<h2>' . $total . '</h2>';
                    ?>
                    <div class="percentage">
                        <div></div>
                    </div>
                    <h3>20% Increase in 1 Year</h3>
                </div>
            </div>
            <div class="box staff" style='background-color: <?php echo $statusBackground ?>'>
                <div class="box-img">
                    <img src="images/box (2).svg" alt="" />
                </div>
                <div class="box-info">
                    <h1>Total Staff</h1>
                    <?php
                    $sql = "SELECT COUNT(*) as count FROM employee_tbl WHERE department = '$department'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo '<h2>' . $row['count'] . '</h2>';
                    ?>
                    <div class="percentage">
                        <div></div>
                    </div>
                    <h3>20% Increase in 1 Year</h3>
                </div>
            </div>
            <div class="box faculty" style='background-color: <?php echo $statusBackground ?>'>
                <div class="box-img">
                    <img src="images/box (3).svg" alt="" />
                </div>
                <div class="box-info">
                    <h1>Total Faculty</h1>
                    <?php
                    $sql = "SELECT COUNT(*) as count FROM faculty_tbl WHERE department = '$department'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo '<h2>' . $row['count'] . '</h2>';
                    ?>
                    <div class="percentage">
                        <div></div>
                    </div>
                    <h3>20% Increase in 1 Year</h3>
                </div>
            </div>
            <div class="box fulltime" style='background-color: <?php echo $statusBackground ?>'>
                <div class="box-img">
                    <img src="images/box (4).svg" alt="" />
                </div>
                <div class="box-info">
                    <h1>Total Leave</h1>

                    <?php 
                    $sql = "SELECT COUNT(*) as count FROM leave_tbl WHERE department = '$department' AND application_status = 'APPROVED'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo '<h2>' . $row['count'] . '</h2>';
                    ?>
                    <div class="percentage">
                        <div></div>
                    </div>
                    <h3>20% Increase in 1 Year</h3>
                </div>
            </div>
        </div>

        <div class="dashboard-table">
            <table>
                <div class="table-title">
                    <h1>On Leave List</h1>
                </div>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Days</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "select * from `leave_tbl` WHERE department = '$department' and application_status = 'APPROVED'");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><label><?php echo $row['employee_id']; ?></label></td>
                            <td><label><?php echo $row['employee_name']; ?></label></td>
                            <td><label><?php echo $row['department']; ?></label></td>
                            <td><label><?php echo $row['leave_type']; ?></label></td>
                            <td><label><?php echo $row['from_date']; ?></label></td>
                            <td><label><?php echo $row['to_date']; ?></label></td>
                            <td><label><?php echo $row['total_days_leave']; ?></label></td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
        </div>
    </section>
</body>

</html>