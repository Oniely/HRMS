<?php

global $conn;

include('includes/connection.php');


session_name('staffSession');
session_start();

if (isset($_SESSION['employee_id'])) {
    $id = $_SESSION['employee_id'];
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
                        <?php
                        echo "<h1>$fname $lname</h1>";

                        ?>

                        <?php if (isset($_GET['admin_id'])) {
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
                    <button class="status-btn">REQUEST</button>

                    <div class="status-modal">
                        <form method="POST" class="status-form">
                            <div class="status-header">
                                <h1>Status</h1>
                                <button type="button" class="close-btn">
                                    <img src="images/close.svg" alt="x">
                                </button>
                            </div>
                            <div class="request-leave">
                                <div class="column">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="<?php echo $fname . $lname; ?>" disabled>
                                </div>
                                <div class="column">
                                    <label for="">Employee ID</label>
                                    <input type="text" name="employee_id" value="<?php echo $employee_id; ?>" disabled>
                                </div>
                                <div class="column">
                                    <label for="">From</label>
                                    <input type="date" name="from_date" value="">
                                </div>
                                <div class="column">
                                    <label for="">To</label>
                                    <input type="date" name="to_date" value="">
                                </div>
                                <div class="column">
                                    <label for="">Destination</label>
                                    <input type="text" name="destination" value="">
                                </div>
                                <div class="column">
                                    <label for="">Accompany With: </label>
                                    <input type="text" name="accompany" value="">
                                </div>
                                <label for="">Reason</label>
                                <textarea rows="4" cols="50" name="reason">

                                </textarea>
                            </div>
                            <div class="status-input">
                                <select name="status" id="status">
                                    <option value="LEAVE">Leave</option>
                                </select>
                                <button id="submit" name="submit">REQUEST</button>
                            </div>
                            <?php
                            if (isset($_POST['submit'])) {

                                $numberOfDigits = 6; // Specify the number of digits you want in the random number

                                $min = pow(10, $numberOfDigits - 1); // Minimum value based on the number of digits
                                $max = pow(10, $numberOfDigits) - 1; // Maximum value based on the number of digits

                                $leave_id = rand($min, $max); // Generate a random number within the specified range
                                $name = $fname . " " . $lname;
                                $fromDate = $_POST['from_date'];
                                $toDate = $_POST['to_date'];


                                $fromDateTime = new DateTime($fromDate);
                                $toDateTime = new DateTime($toDate);

                                // Calculate the difference between the from and to dates
                                $interval = $fromDateTime->diff($toDateTime);

                                // Get the total days of leave
                                $totalDaysLeave = $interval->days + 1; // Add 1 to include both the from and to dates
                                $initialLeaveBalance = 15; // Initial leave balance for each employee

                                $balanceDays = $initialLeaveBalance - $totalDaysLeave;


                                // $newData = [
                                //     'status' => $_POST['status']
                                // ];

                                // updateDataEmployee($conn, $id, $newData);

                                $insertData = [
                                    'leave_id' => $leave_id,
                                    'employee_id' => $employee_id,
                                    'employee_name' => $name,
                                    'leave_type' => $_POST['status'],
                                    'date_applied' => date('Y-m-d'),
                                    'reason' => $_POST['reason'],
                                    'from_date' => $fromDate,
                                    'to_date' => $toDate,
                                    'total_days_leave' => $totalDaysLeave,
                                    'application_status' => 'PENDING',
                                    'destination' => $_POST['destination'],
                                    'accompany_with' => $_POST['accompany'],
                                    'balance_days' => $balanceDays

                                ];

                                insertLeaveEmployee($conn, 'leave_tbl', $insertData);
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