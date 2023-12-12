<?php

include('includes/connection.php');
// session_start();
// if (!isset($_SESSION['id']) || (trim ($_SESSION['id']) == '')) {
//     header('location:../index.php');
//     exit();
// }
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
    <section class="section container">
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
        <div class="dashboard-boxes container">
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
        <div class="dashboard-table container">
            <table>
                <div class="table-title">
                    <h1>Faculty List</h1>
                </div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Class Name</th>
                        <th>Subject</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Al Horfor Garote</td>
                        <td>SECSA</td>
                        <td>libraryman.com</td>
                        <td>Computer LAB A</td>
                        <td>Artificial Intelligence</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Al Horfor Garote</td>
                        <td>SECSA</td>
                        <td>libraryman.com</td>
                        <td>Computer LAB A</td>
                        <td>Artificial Intelligence</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Al Horfor Garote</td>
                        <td>SECSA</td>
                        <td>libraryman.com</td>
                        <td>Computer LAB A</td>
                        <td>Artificial Intelligence</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Al Horfor Garote</td>
                        <td>SECSA</td>
                        <td>libraryman.com</td>
                        <td>Computer LAB A</td>
                        <td>Artificial Intelligence</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Al Horfor Garote</td>
                        <td>SECSA</td>
                        <td>libraryman.com</td>
                        <td>Computer LAB A</td>
                        <td>Artificial Intelligence</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Al Horfor Garote</td>
                        <td>SECSA</td>
                        <td>libraryman.com</td>
                        <td>Computer LAB A</td>
                        <td>Artificial Intelligence</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Al Horfor Garote</td>
                        <td>SECSA</td>
                        <td>libraryman.com</td>
                        <td>Computer LAB A</td>
                        <td>Artificial Intelligence</td>
                        <td>60%</td>
                    </tr>
                </tbody>
            </table>
    </section>
</body>

</html>