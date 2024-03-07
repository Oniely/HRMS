<?php

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
require 'includes/connection.php';

if (isset($_POST['add'])) {
    $employee_id = $_POST['employee_id'];
    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $pob_barangay = $_POST['pob_barangay'];
    $pob_city = $_POST['pob_city'];
    $pob_province = $_POST['pob_province'];
    $birthplace = $pob_barangay . ", " . $pob_city . ", " . $pob_province;
    $sex = $_POST['sex'];
    $bloodtype = $_POST['bloodtype'];
    $civilstatus = $_POST['civilstatus'];
    $tin_id = $_POST['tinid'];
    $citizenship = $_POST['citizenship'];
    $sss_no = $_POST['sssno'];
    $pagibig_no = $_POST['pag-ibigno'];
    $philhealth_no = $_POST['philhealthno'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $pob_barangay = $_POST['pob_barangay'];
    $pob_city = $_POST['pob_city'];
    $pob_province = $_POST['pob_province'];
    $birthplace = $pob_barangay . ", " . $pob_city . ", " . $pob_province;
    $res_barangay = $_POST['res_barangay'];
    $res_city = $_POST['res_city'];
    $res_province = $_POST['res_province'];
    $residential_address = $res_barangay . ", " . $res_city . ", " . $res_province;
    $per_barangay = $_POST['per_barangay'];
    $per_city = $_POST['per_city'];
    $per_province = $_POST['per_province'];
    $permanent_address = $per_barangay . ", " . $per_city . ", " . $per_province;
    $email = $_POST['email'];
    $contact_number = $_POST['contactnumber'];
    $father_fname = $_POST['father_fname'];
    $father_mname = $_POST['father_mname'];
    $father_lname = $_POST['father_lname'];
    $father_name = $father_fname . ", " . $father_mname . ", " . $father_lname;
    $mother_fname = $_POST['mother_fname'];
    $mother_mname = $_POST['mother_mname'];
    $mother_lname = $_POST['mother_lname'];
    $mother_name = $mother_fname . ", " . $mother_mname . ", " . $mother_lname;
    $elem_school = $_POST['elem_school'];
    $elem_address = $_POST['elem_address'];
    $elem_year = $_POST['elem_year'];
    $hs_school = $_POST['hs_school'];
    $hs_address = $_POST['hs_address'];
    $hs_course = $_POST['hs_course'];
    $hs_year = $_POST['hs_year'];
    $vocational_school = $_POST['vocational_school'];
    $vocational_address = $_POST['vocational_address'];
    $vocational_course = $_POST['vocational_course'];
    $vocational_year = $_POST['vocational_year'];
    $college_school = $_POST['college_school'];
    $college_address = $_POST['college_address'];
    $college_course = $_POST['college_course'];
    $college_year = $_POST['college_year'];
    $graduate_school = $_POST['graduate_school'];
    $graduate_address = $_POST['graduate_address'];
    $graduate_course = $_POST['graduate_course'];
    $graduate_year = $_POST['graduate_year'];


    $sql_check = "SELECT * FROM employee_tbl WHERE employee_id = '$employee_id'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo '<script>alert("The employee ID already exists. Please use a different ID.")</script>';
    } else {
        $sql = "INSERT INTO employee_tbl VALUES ('$employee_id', '$fname', '$mname', '$lname', '$birthdate', '$birthplace', 
    '$sex','$bloodtype','$civilstatus','$tin_id','$citizenship','$sss_no','$pagibig_no','$philhealth_no'
    ,'$height','$weight','$residential_address','$permanent_address','$email','$contact_number')";
        $notif = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $sql_insert = "INSERT INTO resedential_address_tbl (employee_id, barangay, municipality_city, province) VALUES
    ('$employee_id','$res_barangay', '$res_city', '$res_province')";
        $notifRes = mysqli_query($conn, $sql_insert) or die(mysqli_error($conn));

        $sql_insertper = "INSERT INTO permanent_address_tbl (employee_id, barangay, municipality_city, province) VALUES
    ('$employee_id','$per_barangay', '$per_city', '$per_province')";
        $notifPer = mysqli_query($conn, $sql_insertper) or die(mysqli_error($conn));

        $sql_insertpob = "INSERT INTO place_of_birth_tbl (employee_id, barangay, municipality_city, province) VALUES
    ('$employee_id','$pob_barangay', '$pob_city', '$pob_province')";
        $notifPob = mysqli_query($conn, $sql_insertpob) or die(mysqli_error($conn));

        $sql_insert_father = "INSERT INTO fathers_name (employee_id, fname, mname, lname) VALUES
    ('$employee_id','$father_fname', '$father_mname', '$father_lname')";
        $notifFath = mysqli_query($conn, $sql_insert_father) or die(mysqli_error($conn));

        $sql_insert_mother = "INSERT INTO mothers_name (employee_id, fname, mname, lname) VALUES
    ('$employee_id','$mother_fname', '$mother_mname', '$mother_lname')";
        $notifMoth = mysqli_query($conn, $sql_insert_mother) or die(mysqli_error($conn));

        $sql_insert_elem = "INSERT INTO elementary_tbl (employee_id, schoolname, address, year_graduate) VALUES
    ('$employee_id','$elem_school', '$elem_address', '$elem_year')";
        $notifelem = mysqli_query($conn, $sql_insert_elem) or die(mysqli_error($conn));

        $sql_insert_hs = "INSERT INTO highschool_tbl (employee_id, schoolname, address, course, year_graduate) VALUES
    ('$employee_id','$hs_school', '$hs_address','$hs_course', '$hs_year')";
        $notifhs = mysqli_query($conn, $sql_insert_hs) or die(mysqli_error($conn));

        $sql_insert_vocational = "INSERT INTO vocational_tbl (employee_id, schoolname, address, course, year_graduate) VALUES
    ('$employee_id','$vocational_school', '$vocational_address','$vocational_course', '$vocational_year')";
        $notifevocational = mysqli_query($conn, $sql_insert_vocational) or die(mysqli_error($conn));

        $sql_insert_college = "INSERT INTO college_tbl (employee_id, schoolname, address, course, year_graduate) VALUES
    ('$employee_id','$college_school', '$college_address', '$college_course', '$college_year')";
        $notifecollege = mysqli_query($conn, $sql_insert_college) or die(mysqli_error($conn));

        $sql_insert_graduate = "INSERT INTO graduate_tbl (employee_id, schoolname, address, course, year_graduate) VALUES
    ('$employee_id','$graduate_school', '$graduate_address', '$graduate_course', '$graduate_year')";
        $notifegraduate = mysqli_query($conn, $sql_insert_graduate) or die(mysqli_error($conn));

        echo '<script>alert("Employee Added")</script>';
    }
    $conn->close();
}

$active = "add staff";
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
            <h3>Add Staff</h3>
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
                        <label for="employee_id" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Employee ID</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="firstname" id="fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">First Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="middlename" id="mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Middle Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="lastname" id="lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Last Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="email" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="number" name="contactnumber" id="phoneNum" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="phoneNum" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Phone Number</label>
                    </div>
                    <div class="relative z-0">
                        <input type="date" name="birthdate" id="dob" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="dob" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Date of Birth</label>
                    </div>
                    <div class="relative z-0">
                        <select type="text" name="sex" id="sex" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] text-black focus:outline-none focus:ring-0 peer" placeholder=" ">
                            <option value="" selected hidden>Select sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                        <label for="sex" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Sex</label>
                    </div>
                    <div class="relative z-0">
                        <select type="text" name="civilstatus" id="civilStatus" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] text-black focus:outline-none focus:ring-0 peer" placeholder=" ">
                            <option value="" selected hidden>Select status</option>
                            <option value="Male">Single</option>
                            <option value="Female">Married</option>
                            <option value="Seperated">Seperated</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                        <label for="civilStatus" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Civil Status</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="citizenship" id="citizenship" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="citizenship" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Citizenship</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="height" id="height" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="height" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Height (cm)</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="weight" id="weight" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="weight" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Weight (kg)</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="bloodtype" id="bloodtype" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="bloodtype" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Bloodtype</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="tinid" id="tinid" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="tinid" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Tin ID</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="sssno" id="sssno" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="sssno" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">SSS No.</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="philhealthno" id="philhealthno" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="philhealthno" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">PhilHealth No.</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="pag-ibigno" id="pag-ibigno" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="pag-ibigno" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Pag-ibig No.</label>
                    </div>
                    <div class="relative z-0 -mt-1">
                        <input type="file" name="photo" id="photo" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " required />
                        <label for="photo" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Photo</label>
                    </div>
                    <div class="text-xl col-span-2">
                        Place of Birth :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="pob_barangay" id="pob_brgy" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="pob_brgy" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Barangay</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="pob_city" id="pob_city" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="pob_city" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">City</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="pob_province" id="pob_province" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="pob_province" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                    </div>

                    <div class="text-xl col-span-2">
                        Residential Address :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="res_barangay" id="res_brgy" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="res_brgy" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Street/Barangay</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="res_city" id="res_city" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="res_city" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Municipality/City</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="res_province" id="res_province" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="res_province" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                    </div>

                    <div class="text-xl col-span-2">
                        Permanent Address :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="per_barangay" id="perma_brgy" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="perma_brgy" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Street/Barangay</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="per_city" id="perma_city" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="perma_city" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Municipality/City</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="per_province" id="perma_province" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="perma_province" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                    </div>
                </div>
            </div>
            <div class="f-section mt-20">
                <div class="f-title">
                    <h1>Family Background</h1>
                    <div class="hr"></div>
                </div>
                <div class="f-inputs px-0">
                    <div class="ml-1 text-lg col-span-2">Father:</div>
                    <div class="relative z-0">
                        <input type="text" name="father_fname" id="spouse_fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's First Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="father_mname" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's Middle Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="father_lname" id="spouse_lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's Last Name</label>
                    </div>
                </div>
                <div class="f-inputs px-0">
                    <div class="ml-1 text-lg col-span-2">Mother:</div>
                    <div class="relative z-0">
                        <input type="text" name="mother_fname" id="spouse_fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's First Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="mother_mname" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's Middle Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="mother_lname" id="spouse_lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's Last Name</label>
                    </div>
                </div>
            </div>
            <div class="f-section mt-20">
                <div class="f-title">
                    <h1>Educational Background</h1>
                    <div class="hr"></div>
                </div>
                <div class="f-inputs px-0">
                    <div class="text-xl col-span-2">
                        Elementary :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="elem_school" id="spouse_fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="elem_address" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="date" name="elem_year" id="spouse_lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year Graduate</label>
                    </div>
                </div>
                <div class="f-inputs px-0">
                    <div class="text-xl col-span-2">
                        High School :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="hs_school" id="spouse_fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="hs_address" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="hs_course" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="date" name="hs_year" id="spouse_lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year Graduate</label>
                    </div>
                </div>
                <div class="f-inputs px-0">
                    <div class="text-xl col-span-2">
                        Vocational :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="vocational_school" id="spouse_fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="vocational_address" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="vocational_course" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="date" name="vocational_year" id="spouse_lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year Graduate</label>
                    </div>
                </div>
                <div class="f-inputs px-0">
                    <div class="text-xl col-span-2">
                        College :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="college_school" id="spouse_fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="college_address" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="college_course" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="date" name="college_year" id="spouse_lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year Graduate</label>
                    </div>
                </div>
                <div class="f-inputs px-0">
                    <div class="text-xl col-span-2">
                        Graduate School :
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="graduate_school" id="spouse_fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="graduate_address" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" name="graduate_course" id="spouse_mname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_mname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                    </div>
                    <div class="relative z-0">
                        <input type="date" name="graduate_year" id="spouse_lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="spouse_lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year Graduate</label>
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
<?php include "includes/form_reset.php" ?>

</html>