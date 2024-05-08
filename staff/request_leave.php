<?php

global $conn;
session_start();


require 'includes/connection.php';
require 'includes/query.php';

$active = "application";
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
              <div class="content-title">
                     <h3>Application Form</h3>
              </div>
              <form class="f-container" method="post" enctype="multipart/form-data">
                     <div class="f-section">
        
                            <div class="f-inputs px-0">
                                   <div class="relative z-0">
                                          <input type="text" name="employee_id" id="employee_id" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$employee_id" ?>" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Employee ID</label>
                                   </div>
                                   <div class="relative z-0">
                                          <textarea name="reason" id="reason" class="block py-2.5 px-0 w-full text-sm bg-transparent border-1 border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" ">
                           </textarea>
                                          <label for="citizenship" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Reason</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " disabled value="<?php echo "$fname $lname" ?>" />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Name</label>
                                   </div>
                                   <div class="relative z-0">
                                          <textarea name="accompany" id="accompany  " class="block py-2.5 px-0 w-full text-sm bg-transparent border-1 border border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" ">
                           </textarea>
                                          <label for="citizenship" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Accompany</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="date" name="from_date" id="from_date" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Start Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="date" name="to_date" id="to_date" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 End Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <select name="status" id="status" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" ">
                                                 <option value="LEAVE">Leave</option>
                                          </select>
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Type of Leave</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="destination" id="destination" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="dob" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Destination</label>
                                   </div>
                                   <div class="btns">
                                          <button id="submit" name="submit">APPLY LEAVE</button>
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
       </section>
</body>
<?php include "includes/form_reset.php" ?>

</html>

<!-- <div class="status-modal">
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

       </form>
</div> -->