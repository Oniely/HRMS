<?php
include('includes/connection.php');

session_start();


if (!isset($_SESSION['employee_id'])) {
    header('location: staff_login.php');
    exit();
}


if (isset($_SESSION['employee_id'])) {
    $id = $_SESSION['employee_id'];
    $elem_school = $elem_year = $highschool_school = $highschool_year = $vocational_school = $vocational_course = $vocational_year = $college_school = $college_course = $college_year = $faculty_id = $fname = $lname = $sex = $contact = $email = $permanent_address = $status = $photo_path = "";
    $query = "SELECT * FROM faculty_tbl WHERE faculty_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        $faculty_id = $row['faculty_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $sex = $row['sex'];
        $contact = $row['contact_number'];
        $email = $row['email'];
        $permanent_address = $row['permanent_address'];
        $status = $row['status'];
        $photo_path = $row['photo_path'] ?? "images/profile-black.svg";
    } elseif (!$row) {
        // Data not found in faculty_tbl, handle here
        // Fetch data from employee_tbl
        $query = "SELECT * FROM employee_tbl WHERE employee_id = $id";
        $query_res = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($query_res)) {
            // Assign values from employee_tbl
            $faculty_id = $row['employee_id'];
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
        }
    }
    $query = "SELECT * FROM elementary_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        $elem_school = $row['schoolname'];
        $elem_address = $row['address'];
        $elem_year = $row['year_graduate'];
    }
    $query = "SELECT * FROM highschool_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        // Display information for high school
        $highschool_school = $row['schoolname'];
        $highschool_address = $row['address'];
        $highschool_year = $row['year_graduate'];
    }

    $query = "SELECT * FROM vocational_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        // Display information for vocational school
        $vocational_school = $row['schoolname'];
        $vocational_course = $row['course'];
        $vocational_address = $row['address'];
        $vocational_year = $row['year_graduate'];
    }

    // Check if the employee's data exists in college_tbl
    $query = "SELECT * FROM college_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        // Display information for college
        $college_school = $row['schoolname'];
        $college_course = $row['course'];
        $college_address = $row['address'];
        $college_year = $row['year_graduate'];
    }
}

require_once './includes/query.php';

$active = "profile"
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
    <link rel="stylesheet" href="styles/about.css" />
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
    <section class="section container">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>Personal Information</h1>
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
                        <?php
                        echo "<h1>$fname $lname</h1>";

                        ?>
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
                    <div class="about-me">
                        <button>About Me</button>
                        <button class="status-btn"><a href="request_leave.php">REQUEST</a></button>
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
    <!-- Mobile Section -->
    <main class="m-main">
        <div class="m-top">
            <button class="m-profile-btn">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="500" preserveAspectRatio="xMidYMid meet" version="1.0">
                    <path d="M 187.496094 242.777344 C 139.324219 242.777344 100.132812 203.585938 100.132812 155.410156 C 100.132812 107.238281 139.324219 68.046875 187.496094 68.046875 C 235.667969 68.046875 274.863281 107.238281 274.863281 155.410156 C 274.863281 203.585938 235.667969 242.777344 187.496094 242.777344 Z M 187.496094 80.078125 C 145.957031 80.078125 112.164062 113.871094 112.164062 155.410156 C 112.164062 196.949219 145.957031 230.746094 187.496094 230.746094 C 229.035156 230.746094 262.828125 196.949219 262.828125 155.410156 C 262.828125 113.871094 229.035156 80.078125 187.496094 80.078125 Z M 320.078125 54.917969 C 284.664062 19.503906 237.578125 0 187.496094 0 C 137.414062 0 90.328125 19.503906 54.917969 54.917969 C 19.503906 90.328125 0 137.414062 0 187.496094 C 0 237.578125 19.503906 284.664062 54.917969 320.078125 C 90.328125 355.492188 137.414062 374.992188 187.496094 374.992188 C 237.578125 374.992188 284.664062 355.492188 320.078125 320.078125 C 355.492188 284.664062 374.992188 237.578125 374.992188 187.496094 C 374.992188 137.414062 355.492188 90.328125 320.078125 54.917969 Z M 63.425781 63.425781 C 96.566406 30.285156 140.628906 12.03125 187.496094 12.03125 C 234.363281 12.03125 278.429688 30.285156 311.570312 63.425781 C 344.710938 96.566406 362.960938 140.628906 362.960938 187.496094 C 362.960938 226.457031 350.335938 263.476562 327.042969 293.894531 C 308.503906 267.976562 278.902344 252.660156 246.753906 252.660156 L 128.238281 252.660156 C 96.089844 252.660156 66.488281 267.976562 47.949219 293.894531 C 24.65625 263.472656 12.03125 226.457031 12.03125 187.496094 C 12.03125 140.628906 30.285156 96.566406 63.425781 63.425781 Z M 187.496094 362.960938 C 140.628906 362.960938 96.566406 344.710938 63.425781 311.570312 C 60.824219 308.96875 58.324219 306.289062 55.90625 303.558594 C 72.027344 279.191406 98.925781 264.691406 128.238281 264.691406 L 246.753906 264.691406 C 276.066406 264.691406 302.964844 279.191406 319.085938 303.558594 C 316.671875 306.289062 314.171875 308.96875 311.570312 311.570312 C 278.429688 344.710938 234.363281 362.960938 187.496094 362.960938 Z M 187.496094 362.960938 " fill-opacity="1" fill-rule="nonzero" />
                </svg>
                <div class="m-profile-menu">
                    <a href="about_faculty.php?employee_id">
                        <div>
                            <img src="images/1.svg" alt="" />
                            <span>Profile</span>
                        </div>
                    </a>
                    <a href="about_faculty.php?employee_id">
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
                    <a href="/HRMS/staff/includes/logout.php">
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
    </main>
</body>

</html>