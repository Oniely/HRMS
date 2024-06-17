
<?php

global $conn;

include('includes/connection.php');
include('includes/query.php');
session_name('adminSession');
session_start();
if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) {
    header('location:login.php');
    exit();
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
        $f_photo_path = $row['photo_path'];
        $status = $row['status'];
        $department = $row['department'];
        $tin_id = $row['tin_id'];
        $sss_no = $row['sss_no'];
        $pagibig_no = $row['pagibig_no'];
        $philhealth_no = $row['philhealth_no'];
        $designation = 'Faculty';
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

$active = "about faculty";
$breadcrumbs = [
    'Home' => '/hrms/admin/',
    'Faculty' => '/hrms/admin/all_faculty.php',
    'Faculty Profile' => '#'
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
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="about-container">
            <div class="about-profile">
                <form id="photoForm" class="prof-img transition-all relative group">

                    <?php if (isset($_GET['faculty_id'])) : ?>
                        <img src="<?= !@$f_photo_path ? "images/profile-black.svg" : $f_photo_path ?>" alt="profile" class="object-cover">
                    <?php else : ?>
                        <img src="<?= !@$photo_path ? "images/profile-black.svg" : $photo_path ?>" alt="profile" class="object-cover">
                    <?php endif; ?>

                    <?php if (!isset($_GET['faculty_id'])) : ?>
                        <div class="absolute top-0 right-0 max-[950px]:visible invisible group group-hover:visible transition">
                            <label for="photo" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#121212" class="w-5 h-5 bg-white rounded-sm">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </label>
                            <input type="file" id="photo" class="hidden max-h-0" accept="image/*">
                        </div>
                    <?php endif; ?>
                </form>
                <div class="profile-desc">
                    <div class="profile-name">
                        <?php echo "<h1>$fname $lname</h1>"; ?>
                        <?= @$_GET['faculty_id'] === "" ? $position : "" ?>
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
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="PENDING">PENDING</option>
                                    <option value="NON_ACTIVE">NON_ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                                <div class="expand-status" id="expandStatus">
                                    <form class="f-container" id="leaveForm" method="post" enctype="multipart/form-data">
                                        <div class="f-inputs grid-container">
                                            <div class="relative z-0">
                                                <label for="employee_id" class="text-[#9d9d9d] font-medium ">
                                                    Employee ID
                                                </label>
                                                <input type="text" name="employee_id" id="employee_id" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$id" ?>" />
                                            </div>
                                            <div class="relative z-0">
                                                <label for="name" class="text-[#9d9d9d] font-medium">
                                                    Name
                                                </label>
                                                <input type="text" name="name" id="name" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$fname $lname" ?>" />
                                            </div>
                                            <div class="relative z-0">
                                                <label for="name" class="text-[#9d9d9d] font-medium">
                                                    Type of Leave
                                                </label>
                                                <select name="leave_type" id="leave_type" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder="Type of Leave">
                                                    <option value="Sick Leave">Sick Leave</option>
                                                    <option value="Vacational Leave">Vacational Leave</option>
                                                    <option value="Bereavement Leave">Bereavement Leave</option>
                                                    <option value="Marriage Leave">Marriage Leave</option>
                                                    <option value="Other Leave">Others</option>
                                                </select>
                                            </div>
                                            <div class="relative z-0">
                                                <label for="date" class="text-[#9d9d9d] font-medium">
                                                    Start Date
                                                </label>
                                                <input type="date" name="from_date" id="from_date" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                                <div id="dateWarningMessage" style="display:none; color: red;"></div>
                                            </div>
                                            <div class="relative z-0">
                                                <label for="date" class="text-[#9d9d9d] font-medium">
                                                    End Date
                                                </label>
                                                <input type="date" name="to_date" id="to_date" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />

                                                <div id="dateWarningMessage" style="display:none; color: red;"></div>
                                            </div>

                                            <div class="relative z-0">

                                                <label for="destination" class="text-[#9d9d9d] font-medium">
                                                    Destination
                                                </label>
                                                <input type="text" name="destination" id="destination" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                            </div>
                                            <div class="relative z-0">
                                                <label for="accompany" class="text-[#9d9d9d] font-medium">
                                                    Accompany
                                                </label>

                                                <textarea name="accompany" id="accompany" class="block py-1 px-0 w-full text-sm bg-transparent border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer h-[45px]" placeholder=" "></textarea>
                                            </div>
                                            <div class="relative z-0">
                                                <label for="reason" class="text-[#9d9d9d] font-medium">
                                                    Reason
                                                </label>

                                                <textarea name="reason" id="reason" class="block py-1 px-0 w-full text-sm bg-transparent border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer h-[45px]" placeholder=" "></textarea>
                                            </div>
                                            <div class="relative z-0">
                                                <label for="total_days" class="text-[#9d9d9d] font-medium">
                                                    Total Days
                                                </label>
                                                <input type="text" name="total_days" id="total_days" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="" />

                                            </div>

                                            <div class="relative z-0">
                                                <label for="balace" class="text-[#9d9d9d] font-medium">
                                                    Balance
                                                </label>
                                                <input type="text" name="leave_balance" id="leave_balance" class="block py-1 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="" />
                                                <div id="warningMessage" style="color: red; display: none;">You cannot request this leave type as your balance is 0.</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <button id="submit" name="submit">Update</button>
                            </div>
                            <?php
                            if (isset($_POST['submit'])) {
                                $status = $_POST['status'];

                                $newData = ['status' => $status];
                                updateDataFaculty($conn, $id, $newData);

                                if ($status === 'INACTIVE' && isset($_POST['from_date']) && isset($_POST['to_date'])) {
                                    // Proceed with leave application logic
                                    $numberOfDigits = 6;
                                    $min = pow(10, $numberOfDigits - 1);
                                    $max = pow(10, $numberOfDigits) - 1;

                                    $leave_id = rand($min, $max);
                                    $name = $fname . " " . $lname;

                                    $fromDate = $_POST['from_date'];
                                    $toDate = $_POST['to_date'];

                                    $fromDateTime = new DateTime($fromDate);
                                    $toDateTime = new DateTime($toDate);

                                    $interval = $fromDateTime->diff($toDateTime);
                                    $totalDaysLeave = $interval->days + 1;

                                    $initialLeaveBalanceQuery = "SELECT * FROM leave_balance_tbl WHERE employee_id = $id";
                                    $initialLeaveBalanceResult = mysqli_query($conn, $initialLeaveBalanceQuery);

                                    if ($initialLeaveBalanceResult && mysqli_num_rows($initialLeaveBalanceResult) > 0) {
                                        $row = mysqli_fetch_assoc($initialLeaveBalanceResult);
                                        $initialSickLeaveBalance = $row['sick_leave'];
                                        $initialVacationalLeaveBalance = $row['vacational_leave'];
                                        $initialBereavementLeaveBalance = $row['bereavement_leave'];
                                        $initialMarriageLeaveBalance = $row['marriage_leave'];
                                        $initialOtherLeaveBalance = $row['other_leave'];
                                    }

                                    $leaveType = $_POST['leave_type'];
                                    $newBalance = 0;

                                    switch ($leaveType) {
                                        case 'Sick Leave':
                                            $newBalance = $initialSickLeaveBalance - $totalDaysLeave;
                                            break;
                                        case 'Vacational Leave':
                                            $newBalance = $initialVacationalLeaveBalance - $totalDaysLeave;
                                            break;
                                        case 'Bereavement Leave':
                                            $newBalance = $initialBereavementLeaveBalance += $totalDaysLeave;
                                            break;
                                        case 'Marriage Leave':
                                            $newBalance = $initialMarriageLeaveBalance += $totalDaysLeave;
                                            break;
                                        case 'Other Leave':
                                            $newBalance = $initialOtherLeaveBalance += $totalDaysLeave;
                                            break;
                                        default:
                                            break;
                                    }

                                    $insertData = [
                                        'leave_id' => $leave_id,
                                        'employee_id' => $id,
                                        'employee_name' => $name,
                                        'department' => $department,
                                        'leave_type' => $leaveType,
                                        'date_applied' => date('Y-m-d'),
                                        'reason' => $_POST['reason'],
                                        'from_date' => $fromDate,
                                        'to_date' => $toDate,
                                        'total_days_leave' => $totalDaysLeave,
                                        'application_status' => 'APPROVED',
                                        'destination' => $_POST['destination'],
                                        'accompany_with' => $_POST['accompany'],
                                        'balance_days' => $newBalance
                                    ];

                                    insertLeaveEmployee($conn, 'leave_tbl', $insertData);

                                    // Update leave balance in the leave_balance_tbl
                                    $updateLeaveBalanceQuery = "UPDATE leave_balance_tbl SET 
                                    sick_leave = CASE WHEN '$leaveType' = 'Sick Leave' THEN sick_leave - $totalDaysLeave ELSE sick_leave END,
                                    vacational_leave = CASE WHEN '$leaveType' = 'Vacational Leave' THEN vacational_leave - $totalDaysLeave ELSE vacational_leave END,
                                    bereavement_leave = CASE WHEN '$leaveType' = 'Bereavement Leave' THEN bereavement_leave + $totalDaysLeave ELSE bereavement_leave END,
                                    marriage_leave = CASE WHEN '$leaveType' = 'Marriage Leave' THEN marriage_leave + $totalDaysLeave ELSE marriage_leave END,
                                    other_leave = CASE WHEN '$leaveType' = 'Other Leave' THEN other_leave + $totalDaysLeave ELSE other_leave END
                                    WHERE employee_id = $id";

                                    mysqli_query($conn, $updateLeaveBalanceQuery);

                                } else {
                                    echo  '<script>alert("Status updated successfully")</script>';
                                    echo '<script>window.location.href = window.location.href;</script>';

                                }
                            } else {
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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var leaveTypeInput = document.getElementById('leave_type');
        var leaveBalanceInput = document.getElementById('leave_balance');
        var department = document.getElementById('department');
        var startDateInput = document.getElementById('from_date');
        var endDateInput = document.getElementById('to_date');
        var totalDaysInput = document.getElementById('total_days');
        var warningMessage = document.getElementById('warningMessage');
        var dateWarningMessage = document.getElementById('dateWarningMessage');
        var pendingMessage = document.getElementById('pendingMessage');
        var submitBtn = document.getElementById('submitBtn');

        function checkAvailability() {
            var employee_id = $('#employee_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date && to_date) {
                $.ajax({
                    url: 'includes/check_availability.php',
                    method: 'POST',
                    data: {
                        check_dates: true,
                        employee_id: employee_id,
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function(response) {
                        try {
                            var data = JSON.parse(response);
                            if (Array.isArray(data)) {
                                var overlap = data.some(function(leave) {
                                    var leaveFrom = new Date(leave.from_date);
                                    var leaveTo = new Date(leave.to_date);
                                    var selectedFrom = new Date(from_date);
                                    var selectedTo = new Date(to_date);
                                    return (selectedFrom >= leaveFrom && selectedFrom <= leaveTo) ||
                                        (selectedTo >= leaveFrom && selectedTo <= leaveTo) ||
                                        (selectedFrom <= leaveFrom && selectedTo >= leaveTo);
                                });

                                if (overlap) {
                                    $('#dateWarningMessage').text('Selected dates overlap with a previous leave request.').show();
                                    document.getElementById('submit').disabled = true;
                                } else {
                                    $('#dateWarningMessage').hide();
                                    document.getElementById('submit').disabled = false;
                                }
                            } else {
                                $('#dateWarningMessage').hide();
                            }
                        } catch (e) {
                            console.error("Error parsing response:", e);
                            $('#dateWarningMessage').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });
            }
        }

        $('#from_date, #to_date').change(checkAvailability);


        leaveTypeInput.addEventListener('change', function() {
            var leaveType = this.value;
            if (leaveType) {
                fetchLeaveBalance(leaveType);
            } else {
                leaveBalanceInput.value = '';
                startDateInput.disabled = false;
                endDateInput.disabled = false;
                warningMessage.style.display = 'none';
            }
            if (leaveType === 'Vacational Leave') {
                setMinStartDate(3);
            } else {
                setMinStartDate(0);
            }

        });

        function setMinStartDate(daysToAdd) {
            var today = new Date();
            today.setDate(today.getDate() + daysToAdd);
            var minDate = today.toISOString().split('T')[0];
            startDateInput.setAttribute('min', minDate);
        }

        var today = new Date().toISOString().split('T')[0];
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);


        startDateInput.addEventListener('change', function() {
            endDateInput.setAttribute('min', this.value);
            calculateTotalDays();
        });

        endDateInput.addEventListener('change', function() {
            calculateTotalDays();
        });

        function fetchLeaveBalance(leaveType) {
            var employeeId = <?php echo $id; ?>;
            console.log(employeeId);
            $.ajax({
                url: "partials/fetch_leave_balance.php",
                type: "post",
                data: {
                    employee_id: employeeId,
                    leave_type: leaveType
                },
                dataType: "json",
                success: function(response) {
                    if (response && response.balance !== undefined) {
                        if (response.balance === null) {
                            leaveBalanceInput.value = '';
                            leaveBalanceInput.style.display = 'none';
                            warningMessage.style.display = 'none';
                            startDateInput.disabled = false;
                            endDateInput.disabled = false;
                        } else {
                            leaveBalanceInput.value = response.balance;
                            leaveBalanceInput.style.display = 'block';
                            if (response.balance == 0) {
                                startDateInput.disabled = true;
                                endDateInput.disabled = true;
                                warningMessage.style.display = 'block';
                            } else {
                                startDateInput.disabled = false;
                                endDateInput.disabled = false;
                                warningMessage.style.display = 'none';
                            }
                        }
                    } else {
                        console.error("Error: Invalid response from server.", response);
                        alert("Error: Invalid response from server.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching leave balance:", status, error);
                    console.log("Response:", xhr.responseText);
                    alert("Error fetching leave balance.");
                }
            });
        }

        function calculateTotalDays() {
            var startDateValue = startDateInput.value;
            var endDateValue = endDateInput.value;

            if (startDateValue && endDateValue) {
                var startDate = new Date(startDateValue);
                var endDate = new Date(endDateValue);

                if (endDate >= startDate) {
                    var timeDiff = endDate.getTime() - startDate.getTime();
                    var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
                    totalDaysInput.value = dayDiff;
                } else {
                    totalDaysInput.value = 0;
                }
            } else {
                totalDaysInput.value = 0;
            }
        }

        const statusSelect = document.getElementById('status');
        const expandStatus = document.getElementById('expandStatus');

        const toggleExpandStatus = () => {
            if (statusSelect.value === 'INACTIVE') {
                expandStatus.style.display = 'block';

            } else {
                expandStatus.style.display = 'none';

            }
        };

        // Initial check
        toggleExpandStatus();

        // Add event listener to toggle visibility on change
        statusSelect.addEventListener('change', toggleExpandStatus);
        
    });
</script>