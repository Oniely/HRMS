<?php
include('includes/connection.php');
require_once './includes/query.php';
global $fname;
global $conn;

session_name('departmentSession');
session_start();

if (isset($_SESSION['department_id'])) {
    $id = $_SESSION['department_id'];
    $query = "SELECT * FROM department_tbl WHERE department_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($query_res && mysqli_num_rows($query_res) > 0) {
        $row = mysqli_fetch_assoc($query_res);
        $department_id = $row['department_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $position = $row['position'];
        $contact = $row['contact'];
        $department = $row['department'];
    } else {
        echo "Department not found.";
    }
} else {

    header("Location: department_login.php");
    exit();
}


$active = "data leave notification";
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
    <section class="section">
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
                    $sql = "SELECT * FROM leave_tbl WHERE department = '$department'";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $leave_id = $row['leave_id'];
                            $employee_id = $row['employee_id'];
                            $employee_name = $row['employee_name'];
                            $reason = $row['reason'];
                            $leave_type = $row['leave_type'];
                            $start_date = $row['from_date'];
                            $end_date = $row['to_date'];
                            $accompany = $row['accompany_with'];
                            $total_days = $row['total_days_leave'];
                            $application_status = $row['application_status'];
                            $date = date('Y-m-d');

                            echo "<div class='notification-items' id='notification_$leave_id'>";
                            echo "<div class='notification-content-text'>";
                            echo "<h2>Request for $leave_type</h2>";
                            echo "<span>$date</span>";
                            echo "<div class='notification-text'>";
                            echo "<p>$employee_name request for $leave_type from $start_date to $end_date</p>";

                            echo "<button type='button' class='btn btn-primary' data-employee_id='$employee_id' data-employee='$employee_name' data-reason='$reason' data-leave='$leave_type' data-start='$start_date' data-end='$end_date' data-total='$total_days'></button>";
                            echo "<a>Delete</a>";
                            echo "<div class='additional-container' data-leave-id='$leave_id'>";
                            echo "<div class='additional-content' data-employee-id='$employee_id'>";
                            echo "<p>Employee ID: $leave_id</p>";
                            echo "<p>Employee ID: $employee_id</p>";
                            echo "<p>Employee Name: $employee_name</p>";
                            echo "<p>Employee Leave Type: $leave_type</p>";
                            echo "<p>Reason: $reason</p>";
                            echo "<p>Accompany: $accompany</p>";
                            echo "<p>Start Date: $start_date</p>";
                            echo "<p>End Date: $end_date</p>";
                            echo "<p>Total days : $total_days</p>";
                            echo '<div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">';

                            $buttonsDisabled = ($application_status === 'DEPARTMENT APPROVED' || $application_status === 'REJECTED' || $application_status === 'APPROVED') ? 'disabled' : '';

                            echo "<button type='button' id='confirmBtn' class='confirm-btn w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm' data-leave-id='$leave_id' data-employee-id='$employee_id' data-leave='$leave_type' data-total='$total_days' $buttonsDisabled>
                                                Confirm
                                            </button>";
                            echo "<button type='button' id='confirmBtn' class='reject-btn w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm' data-leave-id='$leave_id' data-employee-id='$employee_id' data-leave='$leave_type' data-total='$total_days' $buttonsDisabled>
                                                Reject
                                            </button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var notifications = document.querySelectorAll('.notification-items');

        notifications.forEach(function(notification) {
            notification.addEventListener('click', function(event) {
                var leaveId = this.id.split('_')[1];

                console.log("leaveId:", leaveId);

                this.classList.toggle('expanded');

                var additionalContainer = this.parentElement.querySelector('.additional-container[data-leave-id="' + leaveId + '"]');

                console.log("additionalContainer:", additionalContainer);

                if (additionalContainer) {
                    additionalContainer.classList.toggle('expanded');
                }

                event.stopPropagation();
            });
        });

        $('.confirm-btn').click(function() {
            var leave_id = $(this).data('leave-id');
            var employee_id = $(this).data('employee-id');
            var leave_type = $(this).data('leave');
            var requested_days = $(this).data('total');
            if (confirm("Are you sure you want to approve this leave request?")) {
                updateLeaveStatus(leave_id, employee_id, 'DEPARTMENT APPROVED', leave_type, requested_days);
            }
        });

        $('.reject-btn').click(function() {
            var leave_id = $(this).data('leave-id');
            var employee_id = $(this).data('employee-id');
            if (confirm("Are you sure you want to reject this leave request?")) {
                updateLeaveStatus(leave_id, employee_id, 'REJECTED');
            }
        });

        function updateLeaveStatus(leave_id, employee_id, status, leave_type = null, requested_days = null) {
            $.ajax({
                url: "includes/leave_request.php",
                type: "post",
                data: {
                    functionname: 'updateApplicationStatus',
                    leave_id: leave_id,
                    employee_id: employee_id,
                    status: status,
                    leave_type: leave_type,
                    requested_days: requested_days
                },
                success: function(result) {
                    if (status === 'DEPARTMENT APPROVED') {
                        alert("Request Approved Successfully");
                        window.location.href = './notifications.php';
                    } else if (status === 'REJECTED') {
                        alert("Request Rejected Successfully");
                        window.location.href = './notifications.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    console.log("Response: " + xhr.responseText);
                }
            });
        }

      
        var clickedNotifications = sessionStorage.getItem('clicked_notifications');
        if (clickedNotifications) {
            clickedNotifications = JSON.parse(clickedNotifications);
        } else {
            clickedNotifications = [];
        }
        clickedNotifications.push(leave_id);
        sessionStorage.setItem('clicked_notifications', JSON.stringify(clickedNotifications));

        console.log(clickedNotifications);

        var notification = $(this).closest('.notification-item');
        notification.removeClass("unread");

        localStorage.setItem("notificationRead", "true");

        $('#leaveModal').removeClass('hidden');
    });





    // function updateNotificationCount() {
    //     var xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             document.getElementById("notificationCount").textContent = this.responseText;
    //         }
    //     };
    //     xhr.open('GET', 'notifications_count.php', true);
    //     xhr.send();
    // }

    // function displayNotifications(notifications) {
    //     var notificationCount = document.getElementById('notificationCount');
    //     notificationCount.textContent = notifications.length;
    // }

    // updateNotificationCount();
    // setInterval(fetchNotifications, 5000); 
</script>