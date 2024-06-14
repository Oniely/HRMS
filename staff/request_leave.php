<?php

global $conn;
session_start();

if (!isset($_SESSION['employee_id'])) {
       header('Location: staff_login.php');
}

require 'includes/connection.php';
require 'includes/query.php';

$active = "leave application";
$breadcrumbs = [
       'Home' => '/hrms/department/',
       "Leave" => "#",
       "Application" => "#"
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
       <link rel="stylesheet" href="styles/add.css" />
       <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
       <!-- Scripts -->
       <script src="script/burger.js" defer></script>
       <script src="script/dropdown.js" defer></script>
       <script src="script/form_autosave.js" defer></script>
       <!-- CDN's -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
       <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
       <!-- Side Bar -->
       <?php require 'partials/aside.php' ?>
       <!-- Navbar -->
       <?php require 'partials/nav.php' ?>
       <!-- Dashboard -->
       <section class="dashboard-container">
              <div class="section-title">
                     <h1>Request Leave</h1>
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
              <?php
              // Function to check for pending leave requests
              function checkPendingLeaveRequest($conn, $employee_id)
              {
                     $sql = "SELECT COUNT(*) AS pending_count FROM leave_tbl WHERE employee_id = ? AND application_status = 'PENDING'";
                     $stmt = mysqli_prepare($conn, $sql);
                     if (!$stmt) {
                            error_log("Error preparing statement: " . mysqli_error($conn));
                            return false;
                     }

                     mysqli_stmt_bind_param($stmt, "i", $employee_id);
                     mysqli_stmt_execute($stmt);
                     $result = mysqli_stmt_get_result($stmt);

                     if (!$result) {
                            error_log("Error executing statement: " . mysqli_error($conn));
                            mysqli_stmt_close($stmt);
                            return false;
                     }

                     $row = mysqli_fetch_assoc($result);
                     $pendingCount = $row['pending_count'];
                     mysqli_stmt_close($stmt);

                     return $pendingCount > 0;
              }

              // Check if there are any pending leave requests
              $employee_id = $employee_id; // Assuming $employee_id is defined earlier
              $hasPendingRequest = checkPendingLeaveRequest($conn, $employee_id);

              // Set a variable to control input disabling
              $inputsDisabled = $hasPendingRequest ? 'disabled' : '';

              ?>
              <form class="f-container" method="post" enctype="multipart/form-data">
                     <div class="f-section">
                            <?php
                            if ($hasPendingRequest) {
                                   echo "<div id='pendingMessage' style='color: red;'>Your last request is still pending.</div>";
                            } else {
                            }
                            ?>



                            <div class="f-inputs px-0">
                                   <div class="relative z-0">
                                          <input type="text" name="employee_id" id="employee_id" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$employee_id" ?>" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Employee ID</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$fname $lname" ?>" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Name</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="date" name="from_date" id="from_date" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " require <?php echo $inputsDisabled ?> />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Start Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="date" name="to_date" id="to_date" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " require <?php echo $inputsDisabled ?> />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 End Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <select name="status" id="status" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder="Type of Laeve" <?php echo $inputsDisabled ?>>
                                                 <option value="Sick Leave">Sick Leave</option>
                                                 <option value="Vacational Leave">Vacational Leave</option>
                                                 <option value="Bereavement Leave">Bereavement Leave</option>
                                                 <option value="Marriage Leave">Marriage Leave</option>
                                                 <option value="Other Leave">Others</option>
                                          </select>
                                          <div class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 appearance-none text-black focus:outline-none focus:ring-0 peer">
                                                 <input type="text" id="other-text" name="otherText" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" Please specify" disabled>
                                          </div>
                                          <label for="status" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Type of Leave</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="destination" id="destination" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " <?php echo $inputsDisabled ?> />
                                          <label for="dob" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Destination</label>
                                   </div>
                                   <div class="relative z-0">
                                          <textarea name="accompany" id="accompany" class="block py-2.5 px-0 w-full text-sm bg-transparent border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer h-[45px]" placeholder=" " <?php echo $inputsDisabled ?>></textarea>
                                          <label for="accompany" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-7 scale-75 -top-3 -left-3 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-7 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Accompany</label>
                                   </div>
                                   <div class="relative z-0">
                                          <textarea name="reason" id="reason" class="block py-2.5 px-0 w-full text-sm bg-transparent border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer h-[45px]" placeholder=" " <?php echo $inputsDisabled ?>></textarea>
                                          <label for="reason" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-7 scale-75 -top-3 -left-3 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-7 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Reason</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="total_days" id="total_days" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="" />
                                          <label for="total_days" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Total Days</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="leave_balance" id="leave_balance" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Balance</label>
                                          <div id="warningMessage" style="color: red; display: none;">You cannot request this leave type as your balance is 0.</div>

                                   </div>
                                   <div class="print-btn">
                                          <button type="button" onclick="submitPrintForm()">Print</button>
                                   </div>
                                   <div class="btns bg-[#6d85db] text-white px-4 py-3 w-1/3 flex items-center justify-center rounded-md col-span-2 place-self-end cursor-pointer">
                                          <button id="submit" name="submit" class="font-bold" <?php echo $inputsDisabled ?>>APPLY LEAVE</button>
                                   </div>
                                   <?php
                                   if (isset($_POST['submit'])) {
                                          if (!$hasPendingRequest) {
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

                                                 $initialLeaveBalanceQuery = "SELECT * FROM leave_balance_tbl WHERE employee_id = $employee_id";
                                                 $initialLeaveBalanceResult = mysqli_query($conn, $initialLeaveBalanceQuery);

                                                 if ($initialLeaveBalanceResult && mysqli_num_rows($initialLeaveBalanceResult) > 0) {
                                                        $row = mysqli_fetch_assoc($initialLeaveBalanceResult);
                                                        $initialAnnualLeaveBalance = $row['annual_leave'];
                                                        $initialVacationalLeaveBalance = $row['vacational_leave'];
                                                        $initialBalance = $row['unpaid_leave'];
                                                 }

                                                 $balanceDays = $initialBalance - $totalDaysLeave;
                                                 $insertData = [
                                                        'leave_id' => $leave_id,
                                                        'employee_id' => $employee_id,
                                                        'employee_name' => $name,
                                                        'department' => $department,
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
                                   }
                                   ?>
              </form>
       </section>
</body>
<?php include "includes/form_reset.php" ?>

</html>
<script>
       document.addEventListener('DOMContentLoaded', function() {
              var leaveTypeInput = document.getElementById('status');
              var leaveBalanceInput = document.getElementById('leave_balance');
              var department = document.getElementById('department');
              var startDateInput = document.getElementById('from_date');
              var endDateInput = document.getElementById('to_date');
              var totalDaysInput = document.getElementById('total_days');
              var warningMessage = document.getElementById('warningMessage');
              var pendingMessage = document.getElementById('pendingMessage');
              var submitBtn = document.getElementById('submitBtn');
              const otherTextInput = document.getElementById('other-text');

              leaveTypeInput.addEventListener('change', function() {
                     if (leaveTypeInput.value === 'Other Leave') {
                            otherTextInput.disabled = false;
                            otherTextInput.focus();
                     } else {
                            otherTextInput.disabled = true;
                            otherTextInput.value = '';
                     }

                     var leaveType = this.value;
                     if (leaveType) {
                            fetchLeaveBalance(leaveType);
<?php

global $conn;
session_start();

if (!isset($_SESSION['employee_id'])) {
       header('Location: staff_login.php');
}

require 'includes/connection.php';
require 'includes/query.php';

$active = "leave application";
$breadcrumbs = [
       'Home' => '/hrms/department/',
       "Leave" => "#",
       "Application" => "#"
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
       <link rel="stylesheet" href="styles/add.css" />
       <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
       <!-- Scripts -->
       <script src="script/burger.js" defer></script>
       <script src="script/dropdown.js" defer></script>
       <script src="script/form_autosave.js" defer></script>
       <!-- CDN's -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
       <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
       <!-- Side Bar -->
       <?php require 'partials/aside.php' ?>
       <!-- Navbar -->
       <?php require 'partials/nav.php' ?>
       <!-- Dashboard -->
       <section class="dashboard-container">
              <div class="section-title">
                     <h1>Request Leave</h1>
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
              <?php
              // Function to check for pending leave requests
              function checkPendingLeaveRequest($conn, $employee_id)
              {
                     $sql = "SELECT COUNT(*) AS pending_count FROM leave_tbl WHERE employee_id = ? AND application_status = 'PENDING'";
                     $stmt = mysqli_prepare($conn, $sql);
                     if (!$stmt) {
                            error_log("Error preparing statement: " . mysqli_error($conn));
                            return false;
                     }

                     mysqli_stmt_bind_param($stmt, "i", $employee_id);
                     mysqli_stmt_execute($stmt);
                     $result = mysqli_stmt_get_result($stmt);

                     if (!$result) {
                            error_log("Error executing statement: " . mysqli_error($conn));
                            mysqli_stmt_close($stmt);
                            return false;
                     }

                     $row = mysqli_fetch_assoc($result);
                     $pendingCount = $row['pending_count'];
                     mysqli_stmt_close($stmt);

                     return $pendingCount > 0;
              }

              // Check if there are any pending leave requests
              $employee_id = $employee_id; // Assuming $employee_id is defined earlier
              $hasPendingRequest = checkPendingLeaveRequest($conn, $employee_id);

              // Set a variable to control input disabling
              $inputsDisabled = $hasPendingRequest ? 'disabled' : '';

              ?>
              <form class="f-container" method="post" enctype="multipart/form-data">
                     <div class="f-section">
                            <?php
                            if ($hasPendingRequest) {
                                   echo "<div id='pendingMessage' style='color: red;'>Your last request is still pending.</div>";
                            } else {
                            }
                            ?>



                            <div class="f-inputs px-0">
                                   <div class="relative z-0">
                                          <input type="text" name="employee_id" id="employee_id" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$employee_id" ?>" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Employee ID</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$fname $lname" ?>" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Name</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="date" name="from_date" id="from_date" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " require <?php echo $inputsDisabled ?> />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Start Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="date" name="to_date" id="to_date" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " require <?php echo $inputsDisabled ?> />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 End Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <select name="status" id="status" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder="Type of Laeve" <?php echo $inputsDisabled ?>>
                                                 <option value="Sick Leave">Sick Leave</option>
                                                 <option value="Vacational Leave">Vacational Leave</option>
                                                 <option value="Bereavement Leave">Bereavement Leave</option>
                                                 <option value="Marriage Leave">Marriage Leave</option>
                                                 <option value="Others">Others</option>
                                          </select>
                                          <div class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 appearance-none text-black focus:outline-none focus:ring-0 peer">
                                                 <input type="text" id="other-text" name="otherText" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" Please specify" disabled>
                                          </div>
                                          <label for="status" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Type of Leave</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="destination" id="destination" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " <?php echo $inputsDisabled ?> />
                                          <label for="dob" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Destination</label>
                                   </div>
                                   <div class="relative z-0">
                                          <textarea name="accompany" id="accompany" class="block py-2.5 px-0 w-full text-sm bg-transparent border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer h-[45px]" placeholder=" " <?php echo $inputsDisabled ?>></textarea>
                                          <label for="accompany" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-7 scale-75 -top-3 -left-3 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-7 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Accompany</label>
                                   </div>
                                   <div class="relative z-0">
                                          <textarea name="reason" id="reason" class="block py-2.5 px-0 w-full text-sm bg-transparent border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer h-[45px]" placeholder=" " <?php echo $inputsDisabled ?>></textarea>
                                          <label for="reason" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-7 scale-75 -top-3 -left-3 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-7 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Reason</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="total_days" id="total_days" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="" />
                                          <label for="total_days" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Total Days</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="leave_balance" id="leave_balance" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Balance</label>
                                          <div id="warningMessage" style="color: red; display: none;">You cannot request this leave type as your balance is 0.</div>

                                   </div>
                                   <div class="print-btn">
                                          <button type="button" onclick="submitPrintForm()">Print</button>
                                   </div>
                                   <div class="btns bg-[#6d85db] text-white px-4 py-3 w-1/3 flex items-center justify-center rounded-md col-span-2 place-self-end cursor-pointer">
                                          <button id="submit" name="submit" class="font-bold" <?php echo $inputsDisabled ?>>APPLY LEAVE</button>
                                   </div>
                                   <?php
                                   if (isset($_POST['submit'])) {
                                          if (!$hasPendingRequest) {
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

                                                 $initialLeaveBalanceQuery = "SELECT * FROM leave_balance_tbl WHERE employee_id = $employee_id";
                                                 $initialLeaveBalanceResult = mysqli_query($conn, $initialLeaveBalanceQuery);

                                                 if ($initialLeaveBalanceResult && mysqli_num_rows($initialLeaveBalanceResult) > 0) {
                                                        $row = mysqli_fetch_assoc($initialLeaveBalanceResult);
                                                        $initialAnnualLeaveBalance = $row['annual_leave'];
                                                        $initialVacationalLeaveBalance = $row['vacational_leave'];
                                                        $initialBalance = $row['unpaid_leave'];
                                                 }

                                                 $balanceDays = $initialBalance - $totalDaysLeave;
                                                 $insertData = [
                                                        'leave_id' => $leave_id,
                                                        'employee_id' => $employee_id,
                                                        'employee_name' => $name,
                                                        'department' => $department,
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
                                   }
                                   ?>
              </form>
       </section>
</body>
<?php include "includes/form_reset.php" ?>

</html>
<script>
       document.addEventListener('DOMContentLoaded', function() {
              var leaveTypeInput = document.getElementById('status');
              var leaveBalanceInput = document.getElementById('leave_balance');
              var department = document.getElementById('department');
              var startDateInput = document.getElementById('from_date');
              var endDateInput = document.getElementById('to_date');
              var totalDaysInput = document.getElementById('total_days');
              var warningMessage = document.getElementById('warningMessage');
              var pendingMessage = document.getElementById('pendingMessage');
              var submitBtn = document.getElementById('submitBtn');
              const otherTextInput = document.getElementById('other-text');

              leaveTypeInput.addEventListener('change', function() {
                     if (leaveTypeInput.value === 'Others') {
                            otherTextInput.disabled = false;
                            otherTextInput.focus();
                     } else {
                            otherTextInput.disabled = true;
                            otherTextInput.value = '';
                     }

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
                     var employeeId = <?php echo $employee_id; ?>;
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
       });


       function submitPrintForm() {
              const printForm = document.createElement('form');
              printForm.method = 'post';
              printForm.action = 'print.php';
              printForm.target = '_blank';

              const inputFields = [
                     'employee_id', 'name', 'from_date', 'to_date', 'status',
                     'destination', 'accompany', 'reason', 'total_days', 'leave_balance'
              ];

              inputFields.forEach(field => {
                     const input = document.createElement('input');
                     input.type = 'hidden';
                     input.name = field;
                     input.value = document.getElementById(field).value;
                     printForm.appendChild(input);
              });

              // Append and submit the form
              document.body.appendChild(printForm);
              printForm.submit();
       }
</script>

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
                     var employeeId = <?php echo $employee_id; ?>;
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
       });


       function submitPrintForm() {
              const printForm = document.createElement('form');
              printForm.method = 'post';
              printForm.action = 'print.php';
              printForm.target = '_blank';

              const inputFields = [
                     'employee_id', 'name', 'from_date', 'to_date', 'status',
                     'destination', 'accompany', 'reason', 'total_days', 'leave_balance'
              ];

              inputFields.forEach(field => {
                     const input = document.createElement('input');
                     input.type = 'hidden';
                     input.name = field;
                     input.value = document.getElementById(field).value;
                     printForm.appendChild(input);
              });

              // Append and submit the form
              document.body.appendChild(printForm);
              printForm.submit();
       }
</script>