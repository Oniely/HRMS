<?php

global $conn;

include('includes/connection.php');

session_start();

if (!isset($_SESSION['employee_id'])) {
    header('Location: staff_login.php');
}

if (isset($_SESSION['employee_id'])) {
    $id = $_SESSION['employee_id'];
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
        $department = $row['department'];
        $photo_path = !empty($row['photo_path']) ? $row['photo_path'] : "images/profile-black.svg"; // Use default image if photo path is empty

        $_SESSION['department'] = $department;

        $elem_query = "SELECT * FROM elementary_tbl WHERE employee_id = $id";
        $elem_query_res = mysqli_query($conn, $elem_query);
        if ($elem_row = mysqli_fetch_assoc($elem_query_res)) {
            $elem_school = $elem_row['schoolname'];
            $elem_address = $elem_row['address'];
            $elem_year = $elem_row['year_graduate'];
        }

        // Fetch and display high school education
        $highschool_query = "SELECT * FROM highschool_tbl WHERE employee_id = $id";
        $highschool_query_res = mysqli_query($conn, $highschool_query);
        if ($highschool_row = mysqli_fetch_assoc($highschool_query_res)) {
            $highschool_school = $highschool_row['schoolname'];
            $highschool_address = $highschool_row['address'];
            $highschool_year = $highschool_row['year_graduate'];
        }

        // Fetch and display vocational education
        $vocational_query = "SELECT * FROM vocational_tbl WHERE employee_id = $id";
        $vocational_query_res = mysqli_query($conn, $vocational_query);
        if ($vocational_row = mysqli_fetch_assoc($vocational_query_res)) {
            $vocational_school = $vocational_row['schoolname'];
            $vocational_course = $vocational_row['course'];
            $vocational_address = $vocational_row['address'];
            $vocational_year = $vocational_row['year_graduate'];
        }

        // Fetch and display college education
        $college_query = "SELECT * FROM college_tbl WHERE employee_id = $id";
        $college_query_res = mysqli_query($conn, $college_query);
        if ($college_row = mysqli_fetch_assoc($college_query_res)) {
            $college_school = $college_row['schoolname'];
            $college_course = $college_row['course'];
            $college_address = $college_row['address'];
            $college_year = $college_row['year_graduate'];
        }
    } else {
        $query = "SELECT * FROM employee_tbl WHERE employee_id = $id";
        $query_res = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($query_res)) {
            $employee_id = $row['employee_id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $sex = $row['sex'];
            $contact = $row['contact_number'];
            $permanent_address = $row['permanent_address'];
            $status = $row['status'];
            $department = $row['department'];
            $photo_path = !empty($row['photo_path']) ? $row['photo_path'] : "images/profile-black.svg"; // Use default image if photo path is empty


            $_SESSION['department'] = $department;

            // Fetch and display educational attainment for employee
            $elem_query = "SELECT * FROM elementary_tbl WHERE employee_id = $id";
            $elem_query_res = mysqli_query($conn, $elem_query);
            if ($elem_row = mysqli_fetch_assoc($elem_query_res)) {
                $elem_school = $elem_row['schoolname'];
                $elem_address = $elem_row['address'];
                $elem_year = $elem_row['year_graduate'];
            }

            // Fetch and display high school education
            $highschool_query = "SELECT * FROM highschool_tbl WHERE employee_id = $id";
            $highschool_query_res = mysqli_query($conn, $highschool_query);
            if ($highschool_row = mysqli_fetch_assoc($highschool_query_res)) {
                $highschool_school = $highschool_row['schoolname'];
                $highschool_address = $highschool_row['address'];
                $highschool_year = $highschool_row['year_graduate'];
            }

            // Fetch and display vocational education
            $vocational_query = "SELECT * FROM vocational_tbl WHERE employee_id = $id";
            $vocational_query_res = mysqli_query($conn, $vocational_query);
            if ($vocational_row = mysqli_fetch_assoc($vocational_query_res)) {
                $vocational_school = $vocational_row['schoolname'];
                $vocational_course = $vocational_row['course'];
                $vocational_address = $vocational_row['address'];
                $vocational_year = $vocational_row['year_graduate'];
            }

            // Fetch and display college education
            $college_query = "SELECT * FROM college_tbl WHERE employee_id = $id";
            $college_query_res = mysqli_query($conn, $college_query);
            if ($college_row = mysqli_fetch_assoc($college_query_res)) {
                $college_school = $college_row['schoolname'];
                $college_course = $college_row['course'];
                $college_address = $college_row['address'];
                $college_year = $college_row['year_graduate'];
            }
        }
    }
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
        $department = $row['department'];
        $photo_path = $row['photo_path'];
        if (empty($photo_path)) {
            $photo_path = "images/profile-black.svg"; // Change this to your default image path
        }

        $_SESSION['department'] = $department;
    } elseif (!$row) {
        // Data not found in faculty_tbl, handle here
        // Fetch data from employee_tbl
        $query = "SELECT * FROM employee_tbl WHERE employee_id = $id";
        $query_res = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($query_res)) {
            $faculty_id = $row['employee_id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $sex = $row['sex'];
            $contact = $row['contact_number'];
            $permanent_address = $row['permanent_address'];
            $status = $row['status'];
            $department = $row['department'];
            $photo_path = $row['photo_path'];
            if (empty($photo_path)) {
                $photo_path = "images/profile-black.svg"; // Change this to your default image path
            }
            $_SESSION['department'] = $department;
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
$active = "profile";
$breadcrumbs = [
    'Home' => '/hrms/department/',
    "Your Profile" => "#"
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
    <link rel="stylesheet" href="styles/about.css" />
    <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
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
            <h1>Your Profile</h1>
            <div class="breadcrumbs">
                <?php
                if (isset($breadcrumbs) && is_array($breadcrumbs)) {
                    foreach ($breadcrumbs as $key => $value) {
                        echo "<a href='$value'>$key</a>";
                    }
                } else {
                    echo "<a href='/HRMS/staff/'>Home</a>";
                }
                ?>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="about-container">
            <div class="about-profile">
                <div class="prof-img">
                    <img src="<?= $photo_path ?? '/hrms/admin/images/profile-black.svg' ?>" alt="profile">
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
                    <div class="bordered-info">
                        <h3>Department</h3>
                        <span><?php echo "$department" ?></span>
                    </div>
                </div>
            </div>
            <div class="about">
                <div class="about-me">
                    <button>About Me</button>
                    <button class="status-btn"><a href="request_leave.php">REQUEST</a></button>

                </div>
                <div class="info">
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>Fullname</h3>
                        <?php echo "<p>$fname $lname</p>"; ?>
                    </div>
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>Mobile</h3>
                        <?php echo "<p>$contact</p>"; ?>
                    </div>
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>Email</h3>
                        <?php echo "<p>$email</p>"; ?>
                    </div>
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>Location</h3>
                        <?php echo "<p>$permanent_address</p>"; ?>
                    </div>
                </div>
                <div class="desc">
                    <h3>Educational Attainment</h3>
                    <div class="desc-cont">
                        <table>
                            <tr>
                                <th>Level</th>
                                <th>School</th>
                                <th>Course</th>
                                <th>Year</th>
                            </tr>
                            <tr>
                                <td>Elementary</td>
                                <td><?php echo $elem_school ?></td>
                                <td></td>
                                <td><?php echo $elem_year ?></td>
                            </tr>
                            <tr>
                                <td>High School</td>
                                <td><?php echo $highschool_school ?></td>
                                <td></td>
                                <td><?php echo $highschool_year ?></td>
                            </tr>
                            <tr>
                                <td>Vocational</td>
                                <td><?php echo $vocational_school ?></td>
                                <td><?php echo $vocational_course ?></td>
                                <td><?php echo $vocational_year ?></td>
                            </tr>
                            <tr>
                                <td>College</td>
                                <td><?php echo $college_school ?></td>
                                <td><?php echo $college_course ?></td>
                                <td><?php echo $college_year ?></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>