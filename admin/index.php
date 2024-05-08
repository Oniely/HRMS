<?php

include('includes/connection.php');
session_start();
// Check if admin_id session variable is not set or empty
if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    // Redirect to login page
    header('Location: login.php');
    exit(); // Stop further execution of the script
} elseif (isset($_SESSION['admin_id'])) {
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