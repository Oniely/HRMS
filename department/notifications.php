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
$breadcrumbs = [
    'Home' => '/hrms/department/',
    "Dashboard" => '/hrms/department/',
    "Notifications" => '#',
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
    <link rel="stylesheet" href="styles/index.css" />
    <link rel="stylesheet" href="styles/notification.css" />
    <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
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
            <div class="breadcrumbs">
                <?php
                if (isset($breadcrumbs) && is_array($breadcrumbs)) {
                    foreach ($breadcrumbs as $key => $value) {
                        echo "<a href='$value'>$key</a>";
                    }
                } else {
                    echo "<a href='/HRMS/admin/'>Home</a>";
                }
                ?>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="leaveDetailsModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-title">
                    <h2>Leave Request Details</h2>
                </div>
                <div class="modal-desc">
                    <p id="modalLeaveId"></p>
                    <p id="modalEmployeeId"></p>
                    <p id="modalEmployeeName"></p>
                    <p id="modalLeaveType"></p>
                    <p id="modalReason"></p>
                    <p id="modalAccompany"></p>
                    <p id="modalStartDate"></p>
                    <p id="modalEndDate"></p>
                    <p id="modalTotalDays"></p>
                </div>
                <div class="modal-footer">
                    <button id="confirmBtn" class="confirm-btn btn">Confirm</button>
                    <button id="rejectBtn" class="reject-btn btn">Reject</button>
                </div>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="notification-container">
            <div class="notification-content">
                <div class="notification-content-desc">
                    <?php
                    $sql = "SELECT * FROM leave_tbl WHERE department = '$department' ORDER BY date_applied DESC";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $leave_id = $row['leave_id'];
                            $employee_id = $row['employee_id'];
                            $employee_name = $row['employee_name'];
                            $date_applied = $row['date_applied'];
                            $reason = $row['reason'];
                            $leave_type = $row['leave_type'];
                            $start_date = $row['from_date'];
                            $end_date = $row['to_date'];
                            $accompany = $row['accompany_with'];
                            $total_days = $row['total_days_leave'];
                            $application_status = $row['application_status'];
                            $department_read_status = $row['department_read_status'];
                            $admin_read_status = $row['admin_read_status'];

                            $unreadClass = $department_read_status ? '' : 'unread';

                            if ($department_read_status == 1) {
                                $read_status = 'Read';
                            } else {
                                $read_status = 'Unread';
                            }

                            echo "<div class='notification-items $unreadClass' data-leave-id='$leave_id' data-employee-id='$employee_id' data-employee-name='$employee_name' data-reason='$reason' data-leave-type='$leave_type' data-accompany='$accompany' data-start='$start_date' data-end='$end_date' data-total='$total_days' data-status='$application_status'>";
                            echo "<div class='notification-content-text'>";
                            echo "<h2>Request for $leave_type</h2>";
                            echo "<h5><i>$read_status</i></h5>";
                            echo "<div class='notification-text'>";
                            echo "<p>$employee_name request for $leave_type from $start_date to $end_date</p>";
                            echo "<span>$date_applied</span>";

                            echo "<button type='button' class='view-details-btn' 
                            data-leave-id='$leave_id' data-employee-id='$employee_id' data-employee-name='$employee_name' data-reason='$reason' data-leave-type='$leave_type' data-accompany='$accompany' data-start='$start_date' data-end='$end_date' data-total='$total_days' data-status='$application_status'>
                       
                        </button>";
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
        const modal = document.getElementById("leaveDetailsModal");
        const span = document.getElementsByClassName("close")[0];

        document.querySelectorAll('.notification-items').forEach(notification => {
            notification.addEventListener('click', function(event) {
                const leaveId = this.getAttribute('data-leave-id');
                const employeeId = this.getAttribute('data-employee-id');
                const employeeName = this.getAttribute('data-employee-name');
                const reason = this.getAttribute('data-reason');
                const accompany = this.getAttribute('data-accompany');
                const leaveType = this.getAttribute('data-leave-type');
                const startDate = this.getAttribute('data-start');
                const endDate = this.getAttribute('data-end');
                const totalDays = this.getAttribute('data-total');
                const applicationStatus = this.getAttribute('data-status');

                // Mark the notification as read and open the modal
                markAsRead(leaveId, this);

                modal.classList.add("open");

                document.getElementById('modalLeaveId').innerText = 'Leave ID: ' + leaveId;
                document.getElementById('modalEmployeeId').innerText = 'Employee ID: ' + employeeId;
                document.getElementById('modalEmployeeName').innerText = 'Employee Name: ' + employeeName;
                document.getElementById('modalLeaveType').innerText = 'Leave Type: ' + leaveType;
                document.getElementById('modalReason').innerText = 'Reason: ' + reason;
                document.getElementById('modalAccompany').innerText = 'Accompany: ' + accompany;
                document.getElementById('modalStartDate').innerText = 'Start Date: ' + startDate;
                document.getElementById('modalEndDate').innerText = 'End Date: ' + endDate;
                document.getElementById('modalTotalDays').innerText = 'Total Days: ' + totalDays;

                // Update the buttons' data attributes
                document.getElementById('confirmBtn').setAttribute('data-leave-id', leaveId);
                document.getElementById('confirmBtn').setAttribute('data-employee-id', employeeId);
                document.getElementById('confirmBtn').setAttribute('data-leave', leaveType);
                document.getElementById('confirmBtn').setAttribute('data-total', totalDays);

                document.getElementById('rejectBtn').setAttribute('data-leave-id', leaveId);
                document.getElementById('rejectBtn').setAttribute('data-employee-id', employeeId);

                if (applicationStatus === 'DEPARTMENT APPROVED' || applicationStatus === 'REJECTED' || applicationStatus === 'APPROVED') {
                    document.getElementById('confirmBtn').disabled = true;
                    document.getElementById('rejectBtn').disabled = true;
                } else {
                    document.getElementById('confirmBtn').disabled = false;
                    document.getElementById('rejectBtn').disabled = false;
                }
            });
        });

        span.onclick = function() {
            modal.classList.remove("open");
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.remove("open");
            }
        }

        function markAsRead(leaveId, notificationElement) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/mark_as_read.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    notificationElement.classList.remove('unread');
                }
            };
            xhr.send('leave_id=' + leaveId);
        }

        $(document).on('click', '.confirm-btn', function() {
            var leave_id = $(this).data('leave-id');
            var employee_id = $(this).data('employee-id');
            var leave_type = $(this).data('leave');
            var requested_days = $(this).data('total');
            console.log("Leave ID:", leave_id, "Employee ID:", employee_id, "Leave Type:", leave_type, "Requested Days:", requested_days);
            if (confirm("Are you sure you want to approve this leave request?")) {
                updateLeaveStatus(leave_id, employee_id, 'DEPARTMENT APPROVED', leave_type, requested_days);
            }
        });

        $(document).on('click', '.reject-btn', function() {
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
                        updateLeaveBalance(employee_id, leave_type, requested_days);
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
    });
</script>