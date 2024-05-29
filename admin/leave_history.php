<?php
global $conn;
include "includes/connection.php";
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
    <link rel="stylesheet" href="styles/index.css" />
    <link rel="stylesheet" href="styles/history.css" />
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <script src="script/status-modal.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>

    <?php require 'partials/aside.php' ?>
    <!-- Navbar -->
    <?php require 'partials/nav.php' ?>
    <section class="section">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>Leave History</h1>
        </div>
        <div class="status-container">
            <div class="p-container">
                <div class="p-name">
                    <h1><?php echo $fname . " " . $lname; ?></h1>
                </div>
                <div class="upper">
                    <div class="leave-history">
                        <select id="leave-history-select" class="leave-history-select" onchange="updateLeaveDetails()">
                            <option value="">Select Leave</option>
                            <?php
                            $sql = "SELECT * FROM leave_tbl WHERE employee_id = $id";
                            $result = mysqli_query($conn, $sql);

                            if (!$result) {
                                echo "<option>Error: Failed to fetch leave history</option>";
                            } else {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $leaveId = $row['leave_id'];
                                        $leaveType = $row['leave_type'];
                                        $fromDate = $row['from_date'];
                                        $toDate = $row['to_date'];
                                        $accompany = $row['accompany_with'];
                                        $status = $row['application_status'];
                                        $destination = $row['destination'];
                                        $total_days = $row['total_days_leave'];
                                        echo "<option value='$leaveId' data-leave-type='$leaveType' data-from-date='$fromDate' data-to-date='$toDate' data-status='$status' data-accompany='$accompany' data-destination='$destination' data-total='$total_days'>$leaveType - $fromDate to $toDate</option>";
                                    }
                                } else {
                                    echo "<option>No leave history found</option>";
                                }
                            }
                            ?>
                        </select>
                        <div class="print-btn">
                            <button>Print</button>
                        </div>
                    </div>
                </div>



                <div class="p-top">
                    <div class="p-info">
                        <h2>Leave No.</h2>
                        <p id="leaveId">-</p>
                    </div>
                    <div class="p-info">
                        <h2>Start Date</h2>
                        <p id="fromDate">-</p>
                    </div>
                    <div class="p-info">
                        <h2>End Date</h2>
                        <p id="toDate">-</p>
                    </div>
                    <div class="p-info">
                        <h2>Type of Leave</h2>
                        <p id="leaveType">-</p>
                    </div>
                    <div class="p-info">
                        <h2>Accompany</h2>
                        <p id="accompany">-</p>
                    </div>
                    <div class="p-info">
                        <h2>Destination</h2>
                        <p id="destination">-</p>
                    </div>
                    <div class="p-info">
                        <h2>Total Days of Leave</h2>
                        <p id="total">-</p>
                    </div>
                </div>
                <div class="p-bottom">
                    <div class="status-cont">
                        <div class="status">
                            <div class="stat stat-1" id="stat-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="#fff" class="">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            <p>Application Submitted</p>
                        </div>
                        <div class="status-separator stat-1" id="separator-1"></div>
                        <!-- KI -->
                        <div class="status">
                            <div class="stat stat-2" id="stat-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="#fff">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            <p>Department Confirmed</p>
                        </div>
                        <div class="status-separator stat-2" id="separator-2"></div>
                        <!-- KI -->
                        <div class="status">
                            <div class="stat stat-3" id="stat-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="#fff">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            <p>HR Confirmed</p>
                        </div>
                        <div class="status-separator stat-3" id="separator-3"></div>
                        <!-- KI -->
                        <div class="status">
                            <div class="stat stat-4" id="stat-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="4" stroke="#fff">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            <p>Rejected</p>
                        </div>
                        <!-- KI -->
                        <!-- AY -->
                    </div>

                </div>
            </div>

        </div>
    </section>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        clearAllActiveClasses();
        clearLeaveDetails();
    });

    function updateLeaveDetails() {
        const select = document.getElementById('leave-history-select');
        const selectedOption = select.options[select.selectedIndex];

        if (!selectedOption.value) {
            clearAllActiveClasses();
            clearLeaveDetails();
        } else {
            const leaveId = selectedOption.value;
            const leaveType = selectedOption.getAttribute('data-leave-type');
            const fromDate = selectedOption.getAttribute('data-from-date');
            const toDate = selectedOption.getAttribute('data-to-date');
            const status = selectedOption.getAttribute('data-status');
            const accompany = selectedOption.getAttribute('data-accompany');
            const destination = selectedOption.getAttribute('data-destination');
            const total = selectedOption.getAttribute('data-total');

            document.getElementById('leaveId').textContent = leaveId || '-';
            document.getElementById('fromDate').textContent = fromDate || '-';
            document.getElementById('toDate').textContent = toDate || '-';
            document.getElementById('leaveType').textContent = leaveType || '-';
            document.getElementById('accompany').textContent = accompany || '-';
            document.getElementById('destination').textContent = destination || '-';
            document.getElementById('total').textContent = total || '-';

            updateProgressStatus(status);
        }
    }

    function clearAllActiveClasses() {
        const statusSteps = [{
                id: 'stat-1',
                separator: 'separator-1'
            },
            {
                id: 'stat-2',
                separator: 'separator-2'
            },
            {
                id: 'stat-3',
                separator: 'separator-3'
            },
            {
                id: 'stat-4',
                separator: null
            }
        ];

        statusSteps.forEach(step => {
            const statElement = document.getElementById(step.id);
            const separatorElement = document.getElementById(step.separator);
            statElement.classList.remove('active');
            if (separatorElement) {
                separatorElement.classList.remove('active');
                separatorElement.style.backgroundColor = '';
            }
        });
    }

    function clearLeaveDetails() {
        document.getElementById('leaveId').textContent = '-';
        document.getElementById('fromDate').textContent = '-';
        document.getElementById('toDate').textContent = '-';
        document.getElementById('leaveType').textContent = '-';
        document.getElementById('accompany').textContent = '-';
        document.getElementById('destination').textContent = '-';
        document.getElementById('total').textContent = '-';
    }

    function updateProgressStatus(applicationStatus) {
        clearAllActiveClasses();

        const statusSteps = [{
                id: 'stat-1',
                separator: 'separator-1',
                status: 'PENDING'
            },
            {
                id: 'stat-2',
                separator: 'separator-2',
                status: 'DEPARTMENT APPROVED'
            },
            {
                id: 'stat-3',
                separator: 'separator-3',
                status: 'APPROVED'
            },
            {
                id: 'stat-4',
                separator: null,
                status: 'REJECTED'
            }
        ];

        let statusReached = false;

        statusSteps.forEach((step, index) => {
            const statElement = document.getElementById(step.id);
            const separatorElement = document.getElementById(step.separator);

            if (!statusReached) {
                statElement.classList.add('active');
                if (separatorElement) separatorElement.classList.add('active');
            }

            if (applicationStatus === step.status) {
                statusReached = true;
                if (applicationStatus === 'REJECTED' && index === 3) {
                    if (separatorElement) separatorElement.style.backgroundColor = 'red';
                }
            }
        });
        if (applicationStatus === 'DEPARTMENT APPROVED') {
            document.getElementById('stat-2').classList.add('active');
            document.getElementById('separator-2').classList.remove('active');
        }
        if (applicationStatus === 'APPROVED') {
            document.getElementById('stat-3').classList.add('active');
            document.getElementById('separator-3').classList.remove('active');

        }
    }

    document.getElementById('leave-history-select').addEventListener('change', updateLeaveDetails);
</script>