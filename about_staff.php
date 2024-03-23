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
    $query = "SELECT * from employee_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_res)) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $sex = $row['sex'];
        $contact = $row['contact_number'];
        $permanent_address = $row['permanent_address'];
        $photo_path = $row['photo_path'];
    }
}

require_once './includes/query.php';
$active = "about staff";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css"/>
    <link rel="stylesheet" href="styles/about.css"/>
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
                    <?php echo "<h1>$fname $lname</h1>"; ?>
                </div>
                <hr>
                <div class="profile-info">
                    <p>Hello I am Celena Anderson a Clerk in Xyz College Surat. I love to work with all my college staff
                        and seniour professors.</p>
                </div>
                <div class="bordered-info">
                    <h3>Gender</h3>
                    <?php echo "<p>$sex</p>"; ?>
                </div>
                <div class="bordered-info">
                    <h3>Degree</h3>
                    <span>BSIT</span>
                </div>
                <div class="bordered-info">
                    <h3>Designation</h3>
                    <span>MSIT</span>
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
                <p>Completed my graduation in Commerce from the well known and renowned institution of India SARDAR
                    PATEL COMMERCE COLLEGE, BARODA in 2000-01, which was affiliated to M.S. University.

                    I ranker in University exams from the same university from 1996-01. Worked as Clerk and Head of the
                    department at Sarda Collage, Rajkot, Gujarat from 2003-2015
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
            </div>
        </div>
    </div>
</section>
</body>

</html>