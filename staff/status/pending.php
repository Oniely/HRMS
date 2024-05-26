<?php
include "../includes/connection.php";
session_start();
?>
<div class="p-container">
    <div class="upper">
        <div class="leave-history">
            <select id="leave-history-select" onchange="updateLeaveDetails()">
                <option value="">Select Leave</option>
                <?php
                if (!isset($_SESSION['employee_id'])) {
                    echo "<option>Error: Session or employee ID not set</option>";
                } else {
                    $employee_id = $_SESSION['employee_id'];

                    $sql = "SELECT * FROM leave_tbl WHERE employee_id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    if (!$stmt) {
                        echo "<option>Error: Failed to prepare SQL statement</option>";
                    } else {
                        mysqli_stmt_bind_param($stmt, "i", $employee_id);
                        $success = mysqli_stmt_execute($stmt);
                        if (!$success) {
                            echo "<option>Error: Failed to execute SQL statement</option>";
                        } else {
                            $result = mysqli_stmt_get_result($stmt);
                            if (!$result) {
                                echo "<option>Error: Failed to get result from SQL statement</option>";
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $leaveId = $row['leave_id'];
                                    $leaveType = $row['leave_type'];
                                    $fromDate = $row['from_date'];
                                    $toDate = $row['to_date'];
                                    $status = $row['application_status'];
                                    $accompany = $row['accompany_with'];
                                    $destination = $row['destination'];
                                    $total = $row['total_days_leave'];
                                    echo "<option value='$leaveId' data-leave-type='$leaveType' data-from-date='$fromDate' data-to-date='$toDate' data-status='$status' data-accompany='$accompany' data-destination='$destination' data-total='$total'>$leaveType - $fromDate to $toDate</option>";
                                }

                                if (mysqli_num_rows($result) === 0) {
                                    echo "<option>No leave history found</option>";
                                }
                            }
                            mysqli_stmt_close($stmt);
                        }
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
        }
    }

    document.getElementById('leave-history-select').addEventListener('change', updateLeaveDetails);
</script>