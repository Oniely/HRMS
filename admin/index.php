<?php

include('includes/connection.php');
include('includes/update_status.php');
session_name('adminSession');
session_start();

$currentDate = date('Y-m-d');

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
} elseif (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $admin_fname = $_SESSION['fname'];
    $admin_lname = $_SESSION['lname'];
}
$active = "dashboard";
$breadcrumbs = [
    'Home' => '/hrms/admin/',
    'Dashboard' => '#'
];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css" />
    <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
    <link rel="stylesheet" href="styles/index.css" />
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- Side Bar -->
    <?php require 'partials/aside.php' ?>
    <!-- Navbar -->
    <?php require 'partials/nav.php' ?>
    <!-- Dashboard -->
    <!-- ONLY SECTION ONLY -->
    <!-- Desktop Section -->
    <section class="section">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>Dashboard</h1>
            <div class="breadcrumbs">
                <?php
                if (isset($breadcrumbs) && is_array($breadcrumbs)) {
                    foreach ($breadcrumbs as $key => $value) {
                        echo "<a href='$value'>$key</a>";
                    }
                } else {
                    echo "<a href='/HRMS/admin/'>Home</a>";
                }
                ?>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="dashboard-table">
            <div class="table-title">
                <h1>On Leave List (As of Today <?php echo $currentDate ?>)</h1>
            </div>
            <div class="table-container">
                <table>
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

                        $query = mysqli_query($conn, "SELECT * FROM `leave_tbl` WHERE application_status = 'APPROVED' AND '$currentDate' BETWEEN `from_date` AND `to_date`");
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
        </div>
        <div class="m-content">
            <div class="dashboard-boxes">

                <a href="#" class="box-link">
                    <div class="box employee">
                        <div class="box-img">
                            <img src="images/box (1).svg" alt="" />
                        </div>
                        <div class="box-info">
                            <h1>Total Employee</h1>
                            <?php
                            $sql1 = "SELECT COUNT(*) as count FROM employee_tbl";
                            $sql2 = "SELECT COUNT(*) as count FROM faculty_tbl";
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
                </a>

                <a href="all_staff.php" class="box-link">
                    <div class="box staff">
                        <div class="box-img">
                            <img src="images/box (2).svg" alt="" />
                        </div>
                        <div class="box-info">
                            <h1>Total Staff</h1>
                            <?php
                            $sql = "SELECT COUNT(*) as count FROM employee_tbl";
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
                </a>

                <a href="all_faculty.php" class="box-link">
                    <div class="box faculty">
                        <div class="box-img">
                            <img src="images/box (3).svg" alt="" />
                        </div>
                        <div class="box-info">
                            <h1>Total Faculty</h1>
                            <?php
                            $sql = "SELECT COUNT(*) as count FROM faculty_tbl";
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
                </a>

                <a href="all_leave.php" class="box-link">
                    <div class="box fulltime">
                        <div class="box-img">
                            <img src="images/box (4).svg" alt="" />
                        </div>
                        <div class="box-info">
                            <h1>Total Leave</h1>
                            <?php
                            $sql = "SELECT COUNT(*) as count FROM leave_tbl WHERE application_status = 'APPROVED' and to_date >= ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "s", $currentDate);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if ($row = mysqli_fetch_assoc($result)) {
                                    echo '<h2>' . $row['count'] . '</h2>';
                                } else {
                                    echo '<h2>0</h2>';
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                echo "Error in SQL statement: " . mysqli_error($conn);
                            }
                            ?>
                            <div class="percentage">
                                <div></div>
                            </div>
                            <h3>20% Increase in 1 Year</h3>
                        </div>
                    </div>
                </a>
                
            </div>
        </div>
    </section>
</body>

</html>