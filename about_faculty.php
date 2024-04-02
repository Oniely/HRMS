<?php

global $conn;

include('includes/connection.php');
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

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $query = "SELECT * from admin_tbl WHERE admin_id = '$admin_id'";
    $query_res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_res)) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $position = $row['position'];
        $contact = $row['contact'];
        $photo_path = $row['photo_path'];
    }
}
if (isset($_GET['faculty_id'])) {
    $id = $_GET['faculty_id'];
    $query = "SELECT * from faculty_tbl WHERE faculty_id = '$id'";
    $query_res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_res)) {
        $fname = $row['fname'];
        $mname = $row['mname'];
        $lname = $row['lname'];
        $sex = $row['sex'];
        $contact = $row['contact_number'];
        $email = $row['email'];
        $permanent_address = $row['permanent_address'];
    }
}

$active = "about faculty";
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
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h1>About Employee</h1>
            <div class="breadcrumbs">
                <a href="#">Home</a>
                <a href="#">Other Faculty</a>
                <a href="#">Faculty</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="about-container">
            <div class="about-profile">
                <form id="photoForm" class="prof-img transition-all relative group">
                    <img src="<?= !@$photo_path ? "images/profile-black.svg" : $photo_path ?>" alt="profile" class="object-cover">
                    <div class="absolute top-0 right-0 max-[950px]:visible invisible group group-hover:visible transition">
                        <label for="photo" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#121212" class="w-5 h-5 bg-white rounded-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </label>
                        <input type="file" id="photo" class="hidden max-h-0" accept="image/*">
                        <input type="submit" class="hidden" id="submit">
                    </div>
                </form>
                <div class="profile-desc">
                    <div class="profile-name">
                        <?php echo "<h1>$fname $lname</h1>"; ?>
                        <?php echo "<p>$position</p>"; ?>
                    </div>
                    <hr>
                    <div class="profile-info">
                        <p>Hello I am Celena Anderson a Clerk in Xyz College Surat. I love to work with all my college staff
                            and seniour professors.</p>
                    </div>
                    <div class="bordered-info">
                        <h3>Gender</h3>
                        <span>Male</span>
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

                                updateDataFaculty($conn, $id, $newData);
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
                        <?php
                        if (isset($_GET["admin_id"])) {
                            echo "<h3>Position</h3>";
                            echo "<p>$position</p>";
                        } else {
                        ?>
                            <h3>Email</h3>
                            <p><?= $email ?></p>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($permanent_address)) {
                    ?>
                        <div>
                            <h3>Location</h3>
                            <p><?php echo $permanent_address ?></p>
                        </div>
                    <?php
                    }
                    ?>
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