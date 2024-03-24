<?php

global $conn;

include('includes/connection.php');
session_start();
if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) {
    header('location:login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM employee_tbl
              LEFT JOIN elementary_tbl ON employee_tbl.employee_id = elementary_tbl.employee_id
              LEFT JOIN highschool_tbl ON employee_tbl.employee_id = highschool_tbl.employee_id
              LEFT JOIN vocational_tbl ON employee_tbl.employee_id = vocational_tbl.employee_id
              LEFT JOIN college_tbl ON employee_tbl.employee_id = college_tbl.employee_id
              WHERE employee_tbl.employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $sex = $row['sex'];
        $contact = $row['contact_number'];
        $permanent_address = $row['permanent_address'];
        $status = $row['status'];
        $photo_path = $row['photo_path'];
        if (empty($photo_path)) {
            $photo_path = "images/profile-black.svg"; // Change this to your default image path
        }
        $elem_school = $row['schoolname'];
        $elem_year = $row['year_graduate'];

        $highschool_school = $row['schoolname'];
        $highschool_year = $row['year_graduate'];

        $vocational_school = $row['schoolname'];
        $vocational_course = $row['course'];
        $vocational_year = $row['year_graduate'];

        $college_school = $row['schoolname'];
        $college_course = $row['course'];
        $college_year = $row['year_graduate'];
    } else {
        // Handle case where employee with given ID is not found
        echo "Employee not found!";
    }
}

require_once './includes/query.php';
$active = "about staff";
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
    <section class="section container">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>About Employee</h1>
            <div class="breadcrumbs">
                <a href="#">Home</a>
                <a href="#">Other Staff</a>
                <a href="#">Staff</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="about-container">
            <div class="about-profile">
                <div class="prof-img">
                    <img src="<?= $photo_path ?? './images/profile-black.svg' ?>" alt="profile">
                </div>
                <div class="profile-desc">
                <div class="profile-name">
                    <?php if(isset($_SESSION['admin_id'])){
                        echo "<h1>$fname $lname</h1>"; }
                        elseif(isset($_GET['faculty_id'])){
                            echo "<h1>$fname $mname $lname</h1>"; 
                        }
                        ?>

                    <?php if(isset($_GET['admin_id'])){
                       echo "<p>$position</p>";
                       } ?> 
                </div>
                <hr>
                <div class="profile-info">
                    <p>Hello I am <?php echo "$fname $lname" ?>, an Employee in Southland College.</p>
                </div>
                <div class="bordered-info">
                    <h3>Gender</h3>
                    <span><?php echo "$sex" ?></span>
                </div>
                <div class="bordered-info">
                    <h3>Degree</h3>
                    <span><?php echo "$college_course" ?></span>
                </div>
                <div class="bordered-info">
                    <h3>Status</h3>
                    <span><?php echo "$status" ?></span>
                </div>
            </div>
            </div>
            <div class="about">
                <div class="about-me">
                    <button>About Me</button>
                    <button class="status-btn">Status</button>

                    <div class="status-modal">
                        <form method="POST" class="status-form">
                            <div class="status-header">
                                <h1>Status:</h1>
                                <button type="button" class="close-btn">
                                    <img src="images/close.svg" alt="x">
                                </button>
                            </div>
                            <div class="status-input">
                                <select name="status" id="status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="NON_ACTIVE">Non-active</option>
                                </select>
                                <button id="submit" name="submit">Update</button>
                            </div>
                            <?php
                            if (isset($_POST['submit'])) {
                                $newData = [
                                    'status' => $_POST['status']
                                ];

                                updateDataEmployee($conn, $id, $newData);
                            }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="info">
                    <div>
                        <h3>Fullname</h3>
                        <?php echo "<p>$fname $lname</p>"; ?>
                    </div>
                    <div>
                        <h3>Mobile</h3>
                        <?php echo "<p>$contact</p>"; ?>
                    </div>
                    <div>
                        <h3>Email</h3>
                        <?php echo "<p>$email</p>"; ?>
                    </div>
                    <div>
                        <h3>Location</h3>
                        <?php echo "<p>$permanent_address</p>"; ?>
                    </div>
                </div>
                <div class="desc">
                    <!-- prettier-ignore -->
                    <h3>Educational Attainment</h3>
                    <p>
                        <strong>Elementary:</strong> <?php echo "$elem_school - $elem_year"; ?> <br>
                        <strong>High School:</strong> <?php echo "$highschool_school - $highschool_year"; ?> <br>
                        <strong>Vocational:</strong> <?php echo "$vocational_school - $vocational_course - $vocational_year"; ?> <br>
                        <strong>College:</strong> <?php echo "$college_school - $college_course - $college_year"; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>