<?php

global $conn;

include('includes/connection.php');
session_start();


$faculty_id = $_GET["id"];

$sql = "SELECT
  faculty_tbl.*,
  resedential_address_tbl.barangay as res_barangay,
  resedential_address_tbl.municipality_city as res_city,
  resedential_address_tbl.province as res_province,
  permanent_address_tbl.barangay as per_barangay,
  permanent_address_tbl.municipality_city as per_city,
  permanent_address_tbl.province as per_province,
  place_of_birth_tbl.barangay as pob_barangay,
  place_of_birth_tbl.municipality_city as pob_city,
  place_of_birth_tbl.province as pob_province,
  fathers_name.fname as father_fname,
  fathers_name.mname as father_mname,
  fathers_name.lname as father_lname,
  mothers_name.fname as mother_fname,
  mothers_name.mname as mother_mname,
  mothers_name.lname as mother_lname
FROM
  faculty_tbl
  INNER JOIN resedential_address_tbl ON faculty_tbl.faculty_id = resedential_address_tbl.employee_id
  INNER JOIN permanent_address_tbl ON faculty_tbl.faculty_id = permanent_address_tbl.employee_id
  INNER JOIN place_of_birth_tbl ON faculty_tbl.faculty_id = place_of_birth_tbl.employee_id
  INNER JOIN fathers_name ON faculty_tbl.faculty_id = fathers_name.employee_id
  INNER JOIN mothers_name ON faculty_tbl.faculty_id = mothers_name.employee_id
WHERE
  faculty_tbl.faculty_id = $faculty_id";

$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

$active = "edit faculty";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css"/>
    <link rel="stylesheet" href="styles/add.css"/>
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
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
        <h3>Edit Faculty Details</h3>
    </div>
    <form class="f-container" method="post" action="functions/faculty/update.php?faculty_id=<?php echo $faculty_id; ?>">
        <div class="f-section">
            <div class="f-title">
                <h1>Personal Information</h1>
                <div class="hr"></div>
            </div>
            <div class="f-inputs px-0">
                <div class="relative z-0">
                    <input type="text" name="faculty_id" id="faculty_id"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $faculty_id ?>"/>
                    <label for="employee_id"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Employee
                        ID</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="firstname" id="fname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['fname'] ?>"/>
                    <label for="fname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">First
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="middlename" id="mname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['mname'] ?>"/>
                    <label for="mname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Middle
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="lastname" id="lname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['lname'] ?>"/>
                    <label for="lname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Last
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="email" name="email" id="email"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['email'] ?>"/>
                    <label for="email"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email
                        Address</label>
                </div>
                <div class="relative z-0">
                    <input type="number" name="contactnumber" id="phoneNum"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['contact_number'] ?>"/>
                    <label for="phoneNum"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Phone
                        Number</label>
                </div>
                <div class="relative z-0">
                    <input type="date" name="birthdate" id="dob"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['date_of_birth'] ?>"/>
                    <label for="dob"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Date
                        of Birth</label>
                </div>
                <div class="relative z-0">
                    <select type="text" name="sex" id="sex"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] text-black focus:outline-none focus:ring-0 peer"
                            placeholder=" " value="<?php echo $row['sex'] ?>">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                    <label for="sex"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Sex</label>
                </div>
                <div class="relative z-0">
                    <select type="text" name="civilstatus" id="civilStatus"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] text-black focus:outline-none focus:ring-0 peer"
                            placeholder=" " value="<?php echo $row['civil_status'] ?>">
                        <option value="Male">Single</option>
                        <option value="Female">Married</option>
                        <option value="Seperated">Seperated</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                    <label for="civilStatus"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Civil
                        Status</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="citizenship" id="citizenship"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['citizenship'] ?>"/>
                    <label for="citizenship"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Citizenship</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="height" id="height"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['height'] ?>"/>
                    <label for="height"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Height
                        (cm)</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="weight" id="weight"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['weight'] ?>"/>
                    <label for="weight"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Weight
                        (kg)</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="bloodtype" id="bloodtype"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['blood_type'] ?>"/>
                    <label for="bloodtype"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Bloodtype</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="tinid" id="tinid"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['tin_id'] ?>"/>
                    <label for="tinid"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Tin
                        ID</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="sssno" id="sssno"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['sss_no'] ?>"/>
                    <label for="sssno"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">SSS
                        No.</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="philhealthno" id="philhealthno"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['philhealth_no'] ?>"/>
                    <label for="philhealthno"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">PhilHealth
                        No.</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="pag-ibigno" id="pag-ibigno"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['pagibig_no'] ?>"/>
                    <label for="pag-ibigno"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Pag-ibig
                        No.</label>
                </div>
                <div class="relative z-0 -mt-1">
                    <input type="file" name="photo" id="photo"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="photo"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Photo</label>
                </div>
                <div class="text-xl col-span-2">
                    Place of Birth :
                </div>
                <div class="relative z-0">
                    <input type="text" name="pob_barangay" id="pob_brgy"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['pob_barangay'] ?>"/>
                    <label for="pob_brgy"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Barangay</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="pob_city" id="pob_city"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['pob_city'] ?>"/>
                    <label for="pob_city"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">City</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="pob_province" id="pob_province"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['pob_province'] ?>"/>
                    <label for="pob_province"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                </div>

                <div class="text-xl col-span-2">
                    Residential Address :
                </div>
                <div class="relative z-0">
                    <input type="text" name="res_barangay" id="res_brgy"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['res_barangay'] ?>"/>
                    <label for="res_brgy"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Street/Barangay</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="res_city" id="res_city"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['res_city'] ?>"/>
                    <label for="res_city"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Municipality/City</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="res_province" id="res_province"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['res_province'] ?>"/>
                    <label for="res_province"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                </div>

                <div class="text-xl col-span-2">
                    Permanent Address :
                </div>
                <div class="relative z-0">
                    <input type="text" name="per_barangay" id="perma_brgy"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['per_barangay'] ?>"/>
                    <label for="perma_brgy"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Street/Barangay</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="per_city" id="perma_city"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['per_city'] ?>"/>
                    <label for="perma_city"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Municipality/City</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="per_province" id="perma_province"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['per_province'] ?>"/>
                    <label for="perma_province"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                </div>
            </div>
        </div>
        <div class="f-section mt-20">
            <div class="f-title">
                <h1>Family Background</h1>
                <div class="hr"></div>
            </div>
            <div class="f-inputs px-0">
                <div class="text-xl col-span-2">
                    Spouse Information :
                </div>
                <div class="relative z-0">
                    <input type="text" name="father_fname" id="spouse_fname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['father_fname'] ?>"/>
                    <label for="spouse_fname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's
                        First Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="father_mname" id="spouse_mname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['father_mname'] ?>"/>
                    <label for="spouse_mname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's
                        Middle Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="father_lname" id="spouse_lname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['father_lname'] ?>"/>
                    <label for="spouse_lname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's
                        Last Name</label>
                </div>
            </div>
            <hr class="mb-2 mt-14 border-t border-[#9d9d9d]">

            <div class="f-inputs px-0">
                <div class="relative z-0">
                    <input type="text" name="mother_fname" id="spouse_fname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['mother_fname'] ?>"/>
                    <label for="spouse_fname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's
                        First Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="mother_mname" id="spouse_mname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['mother_mname'] ?>"/>
                    <label for="spouse_mname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's
                        Middle Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="mother_lname" id="spouse_lname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " value="<?php echo $row['mother_lname'] ?>"/>
                    <label for="spouse_lname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's
                        Last Name</label>
                </div>
            </div>
        </div>
        <div class="btns">
            <input type="submit" name="add" value="Add">
            <a href="javascript:history.back()">Cancel</a>
        </div>
    </form>
</section>
</body>

</html>