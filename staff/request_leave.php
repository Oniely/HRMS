<?php

global $conn;

session_start();


require 'includes/connection.php';
require 'includes/query.php';

$active = "add faculty";
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
                            <div class="f-title">
                                   <h1>Personal Information</h1>
                                   <div class="hr"></div>
                            </div>
                            <div class="f-inputs px-0">
                                   <div class="relative z-0">
                                          <input type="text" name="employee_id" id="employee_id" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Employee ID</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="email" id="email" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Email</label>
                                   </div>

                                   <div class="relative z-0">
                                          <input type="date" name="startdate" id="startdate" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Start Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="date" name="enddate" id="enddate" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 End Date</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="leave" id="leave" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                                                 Type of Leave</label>
                                   </div>
                                   <div class="relative z-0">
                                          <input type="text" name="destination" id="destination" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                                          <label for="dob" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Destination</label>
                                   </div>

                                   <div class="relative z-0">
                                          <textarea name="reason" id="reason" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" ">
                           </textarea>
                                          <label for="citizenship" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Reason</label>
                                   </div>

                                   <div class="btns justify-center">
                                          <input type="submit" name="add" value="Apply Leave">
                                   </div>
              </form>
       </section>
</body>
<?php include "includes/form_reset.php" ?>

</html>