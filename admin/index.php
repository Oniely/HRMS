<?php

include('includes/connection.php');


session_name('adminSession');
session_start();


if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) {
    header('location:login.php');
    exit();
}
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $admin_fname = $_SESSION['fname'];
    $admin_lname = $_SESSION['lname'];
}


$active = "dashboard"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css" />
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
                <a href="#">Home</a>
                <a href="#">Dashboard</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="dashboard-boxes">
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
            <div class="box fulltime">
                <div class="box-img">
                    <img src="images/box (4).svg" alt="" />
                </div>
                <div class="box-info">
                    <h1>Total Fulltime</h1>
                    <h2>250</h2>
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
                    <h1>Faculty List</h1>
                </div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Contact no.</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Joining Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "select * from `faculty_tbl`");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><label><?php echo $row['faculty_id']; ?></label></td>
                            <td><label><?php echo $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']; ?></label></td>
                            <td><label><?php echo $row['lname']; ?></label></td>
                            <td><label><?php echo $row['contact_number']; ?></label></td>
                            <td><label><?php echo $row['email']; ?></label></td>
                            <td><label><?php echo $row['permanent_address']; ?></label></td>
                            <td><label><?php echo $row['date_of_birth']; ?></label></td>

                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
        </div>
    </section>
    <!-- Mobile Section -->
    <main class="m-main">
        <div class="m-top">
            <button class="m-profile-btn">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="500" preserveAspectRatio="xMidYMid meet" version="1.0">
                    <path d="M 187.496094 242.777344 C 139.324219 242.777344 100.132812 203.585938 100.132812 155.410156 C 100.132812 107.238281 139.324219 68.046875 187.496094 68.046875 C 235.667969 68.046875 274.863281 107.238281 274.863281 155.410156 C 274.863281 203.585938 235.667969 242.777344 187.496094 242.777344 Z M 187.496094 80.078125 C 145.957031 80.078125 112.164062 113.871094 112.164062 155.410156 C 112.164062 196.949219 145.957031 230.746094 187.496094 230.746094 C 229.035156 230.746094 262.828125 196.949219 262.828125 155.410156 C 262.828125 113.871094 229.035156 80.078125 187.496094 80.078125 Z M 320.078125 54.917969 C 284.664062 19.503906 237.578125 0 187.496094 0 C 137.414062 0 90.328125 19.503906 54.917969 54.917969 C 19.503906 90.328125 0 137.414062 0 187.496094 C 0 237.578125 19.503906 284.664062 54.917969 320.078125 C 90.328125 355.492188 137.414062 374.992188 187.496094 374.992188 C 237.578125 374.992188 284.664062 355.492188 320.078125 320.078125 C 355.492188 284.664062 374.992188 237.578125 374.992188 187.496094 C 374.992188 137.414062 355.492188 90.328125 320.078125 54.917969 Z M 63.425781 63.425781 C 96.566406 30.285156 140.628906 12.03125 187.496094 12.03125 C 234.363281 12.03125 278.429688 30.285156 311.570312 63.425781 C 344.710938 96.566406 362.960938 140.628906 362.960938 187.496094 C 362.960938 226.457031 350.335938 263.476562 327.042969 293.894531 C 308.503906 267.976562 278.902344 252.660156 246.753906 252.660156 L 128.238281 252.660156 C 96.089844 252.660156 66.488281 267.976562 47.949219 293.894531 C 24.65625 263.472656 12.03125 226.457031 12.03125 187.496094 C 12.03125 140.628906 30.285156 96.566406 63.425781 63.425781 Z M 187.496094 362.960938 C 140.628906 362.960938 96.566406 344.710938 63.425781 311.570312 C 60.824219 308.96875 58.324219 306.289062 55.90625 303.558594 C 72.027344 279.191406 98.925781 264.691406 128.238281 264.691406 L 246.753906 264.691406 C 276.066406 264.691406 302.964844 279.191406 319.085938 303.558594 C 316.671875 306.289062 314.171875 308.96875 311.570312 311.570312 C 278.429688 344.710938 234.363281 362.960938 187.496094 362.960938 Z M 187.496094 362.960938 " fill-opacity="1" fill-rule="nonzero" />
                </svg>
                <div class="m-profile-menu">
                    <a href="about_faculty.php?admin_id">
                        <div>
                            <img src="images/1.svg" alt="" />
                            <span>Profile</span>
                        </div>
                    </a>
                    <a href="about_faculty.php?admin_id">
                        <div>
                            <img src="images/5.svg" alt="" />
                            <span>Setting</span>
                        </div>
                    </a>
                    <a href="">
                        <div>
                            <img src="images/3.svg" alt="" />
                            <span>Help</span>
                        </div>
                    </a>
                    <a href="/HRMS/includes/logout.php">
                        <div>
                            <img src="images/arrow.svg" alt="" />
                            <span>Logout</span>
                        </div>
                    </a>
                </div>
            </button>

            <div class="breadcrumbs">
                <a href="#">Home</a>
                <a href="#">Dashboard</a>
            </div>
        </div>
        <!-- ONLY CHANGE THIS -->
        <div class="m-content">
            <h1>Dashboard</h1>

            <div class="dashboard-boxes">
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
                <div class="box fulltime">
                    <div class="box-img">
                        <img src="images/box (4).svg" alt="" />
                    </div>
                    <div class="box-info">
                        <h1>Total Fulltime</h1>
                        <h2>250</h2>
                        <div class="percentage">
                            <div></div>
                        </div>
                        <h3>20% Increase in 1 Year</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Table -->
        <div class="dashboard-table">
            <div class="table-title">
                <h1>Faculty List</h1>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Contact no.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Joining Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "select * from `faculty_tbl`");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><label>
                                        <?php echo $row['faculty_id']; ?>
                                    </label></td>
                                <td><label>
                                        <?php echo $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']; ?>
                                    </label></td>
                                <td><label>
                                        <?php echo $row['lname']; ?>
                                    </label></td>
                                <td><label>
                                        <?php echo $row['contact_number']; ?>
                                    </label></td>
                                <td><label>
                                        <?php echo $row['email']; ?>
                                    </label></td>
                                <td><label>
                                        <?php echo $row['permanent_address']; ?>
                                    </label></td>
                                <td><label>
                                        <?php echo $row['date_of_birth']; ?>
                                    </label></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>