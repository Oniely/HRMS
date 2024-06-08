<?php

global $conn;

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
        $status = $row['status'];
        $department = $row['department'];
        $tin_id = $row['tin_id'];
        $sss_no = $row['sss_no'];
        $pagibig_no = $row['pagibig_no'];
        $philhealth_no = $row['philhealth_no'];
        $designation = 'Staff';
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
    <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <script src="script/status-modal.js" defer></script>
    <!-- <script src="script/history-modal.js" defer></script> -->
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
            <h1>About Staff</h1>
            <div class="breadcrumbs">
                <a href="/hrms/admin/">Home</a>
                <a href="/hrms/admin/all_staff.php">All Staff</a>
                <a href="#">Staff</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="about-container">
            <div class="about-profile">
                <div class="prof-img">
                    <img src="<?= $photo_path ? $photo_path : "images/profile-black.svg" ?>" alt="profile">
                </div>
                <div class="profile-desc">
                    <div class="profile-name">
                        <?php echo "<h1>$fname $lname</h1>"; ?>
                    </div>
                    <hr>
                    <div class="profile-info">
                        <p>Hello I am <?php echo "$fname $lname" ?> an Employee in Southland College.</p>
                    </div>
                    <div class="bordered-info">
                        <h3>Gender</h3>
                        <?php echo "<p>$sex</p>"; ?>
                    </div>
                    <div class="bordered-info">
                        <h3>Degree</h3>
                        <span><?php echo "$college_course" ?></span>
                    </div>
                    <div class="bordered-info">
                        <h3>Status</h3>
                        <span><?php echo $status ?></span>
                    </div>
                    <div class="bordered-info">
                        <h3>Department</h3>
                        <span><?php echo $department ?></span>
                    </div>
                    <div class="bordered-info">
                        <h3>Designation</h3>
                        <span><?php echo $designation ?></span>
                    </div>
                </div>
            </div>
            <div class="about">
                <div class="about-me">
                    <button>About Me</button>
                    <a href="leave_history.php?id=<?php echo $id; ?>">
                        <button class="history-btn">Leave History</button>
                    </a>
                    <button class="status-btn">Status</button>
                    <!-- <div class="history-modal">
                        <form method="POST" class="history-form">
                            <div class="history-header">
                                <h1>Leave History</h1>
                                <button type="button" class="close-btn">
                                    <img src="images/close.svg" alt="x">
                                </button>
                            </div>
                            <div class="history-input">
                                <select id="leave-history-select" name="leave_id" onchange="updateLeaveDetails()">
                                    <option value="">Select Leave</option>
                                    <?php
                                    $sql = "SELECT * FROM leave_tbl WHERE employee_id = $id";
                                    $result = mysqli_query($conn, $sql);

                                    if (!$result) {
                                        echo "<option>Error: Failed to fetch leave history</option>";
                                    } else {
                                        // Check if there are leave records
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $leaveId = $row['leave_id'];
                                                $leaveType = $row['leave_type'];
                                                $fromDate = $row['from_date'];
                                                $toDate = $row['to_date'];
                                                // Output leave history as dropdown options
                                                echo "<option value='$leaveId' data-leave-type='$leaveType' data-from-date='$fromDate' data-to-date='$toDate'>$leaveType - $fromDate to $toDate</option>";
                                            }
                                        } else {
                                            echo "<option>No leave history found</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div> -->


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
                <div class="info">
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>Pag-ibig</h3>
                        <?php echo "<p>$pagibig_no</p>"; ?>
                    </div>
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>SSS</h3>
                        <?php echo "<p>$sss_no</p>"; ?>
                    </div>
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>PhilHealth</h3>
                        <?php echo "<p>$philhealth_no</p>"; ?>
                    </div>
                    <div class="flex-1 w-1/4 overflow-hidden text-ellipsis">
                        <h3>Tin ID</h3>
                        <?php echo "<p>$tin_id</p>"; ?>
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