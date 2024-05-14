<?php

global $fname;
global $conn;

session_start();


include('includes/connection.php');
require_once './includes/query.php';

$active = "leave notification";
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
    <link rel="stylesheet" href="styles/notification.css" />
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
    <section class="section container">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>Notifications</h1>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="notification-container">
            <div class="notification-content">

                <div class="notification-content-desc">
                    <?php
                    $sql = "SELECT * FROM leave_tbl WHERE employee_id = '$employee_id'";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $employee_id = $row['employee_id'];
                            $employee_name = $row['employee_name'];
                            $reason = $row['reason'];
                            $leave_type = $row['leave_type'];
                            $start_date = $row['from_date'];
                            $end_date = $row['to_date'];
                            $date = date('Y-m-d');

                            // Unique identifier for each notification
                            $leave_id = $row['leave_id'];


                            $image = '';
                            if ($row['application_status'] == 'APPROVED') {
                                $image = 'approved.svg';
                            } elseif ($row['application_status'] == 'REJECTED') {
                                $image = 'declined.svg';
                            } else {
                                $image = 'pending.svg';
                            }

                            // Set the title based on the application status
                            $title = $row['application_status'] == 'PENDING' ? "Leave Request Pending" : "Request Leave Accepted";
                            echo "<div class='notification-items' id='notification_$leave_id'>";
                            echo "<div class='notification-content-img'>";
                            echo "<img src='images/$image' alt='$row[application_status]'>";
                            echo "</div>";
                            echo "<div class='notification-content-text'>";
                            echo "<h2>$row[application_status]</h2>";
                            echo "<div class='notification-text'>"; // Add the missing single quote here
                            echo "<p>Your requested $leave_type from $start_date to $end_date</p>";
                            echo "<button type='button' class='btn btn-primary' 
                                    data-employee_id='$employee_id' data-employee='$employee_name' data-reason='$reason' data-leave='$leave_type' data-start='$start_date' data-end='$end_date'></button>";
                            echo "<span>$date</span>";
                            echo "</div>"; // Close the notification-text div
                            echo "</div>"; // Close the notification-content-text div
                            echo "</div>"; // Close the notification-items div

                        }
                    } else {
                        echo "<div class='notification-items'>";
                        echo "No notification messages";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>


    </section>
</body>

</html>