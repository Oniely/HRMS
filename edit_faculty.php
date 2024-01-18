<?php

include('includes/connection.php');
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
$faculty_id = $_GET["id"];
$query = mysqli_query($conn, "SELECT faculty_tbl.*, resedential_address_tbl.barangay as res_barangay, resedential_address_tbl.municipality_city as res_city, resedential_address_tbl.province as res_province,
 permanent_address_tbl.barangay as per_barangay, permanent_address_tbl.municipality_city as per_city, permanent_address_tbl.province as per_province, place_of_birth_tbl.barangay as pob_barangay, 
 place_of_birth_tbl.municipality_city as pob_city, place_of_birth_tbl.province as pob_province, 
 fathers_name.fname as father_fname, fathers_name.mname as father_mname, fathers_name.lname as father_lname, mothers_name.fname as mother_fname, mothers_name.mname as mother_mname, mothers_name.lname as mother_lname FROM faculty_tbl 
INNER JOIN resedential_address_tbl ON faculty_tbl.faculty_id = resedential_address_tbl.employee_id 
INNER JOIN permanent_address_tbl ON faculty_tbl.faculty_id = permanent_address_tbl.employee_id 
INNER JOIN place_of_birth_tbl ON faculty_tbl.faculty_id = place_of_birth_tbl.employee_id 
INNER JOIN fathers_name ON faculty_tbl.faculty_id = fathers_name.employee_id 
INNER JOIN mothers_name ON faculty_tbl.faculty_id = mothers_name.employee_id 
WHERE faculty_tbl.faculty_id='$faculty_id'");
$row = mysqli_fetch_array($query);

$active = "edit faculty";
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
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        <div class="form-container">
            <form class="form" method="post" action="functions/faculty/update.php?faculty_id=<?php echo $faculty_id; ?>">
                <input type="hidden" name="faculty_id" value="<?php echo $faculty_id; ?>">
                <div class="form-title">
                    <h5>Basic Information</h5>
                </div>
                <div class="flex">
                    <label for="Firstname">Firstname
                        <input type="text" placeholder="Firstname" name="firstname" value="<?php echo $row['fname'] ?>">
                    </label>
                    <label>Middlename
                        <input type="text" placeholder="Middlename" name="middlename" value="<?php echo $row['mname'] ?>">
                    </label>
                    <label>Lastname
                        <input type="text" placeholder="Lastname" name="lastname" value="<?php echo $row['lname'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Email Address
                        <input type="email" placeholder="Email Address" name="email" value="<?php echo $row['email'] ?>">
                    </label>
                    <label>Employee ID
                        <input type="text" placeholder="faculty ID" name="faculty_id" value="<?php echo $row['faculty_id'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Joining Date
                        <input type="date" placeholder="Date of Birth" name="birthdate" value="<?php echo $row['date_of_birth'] ?>">
                    </label>
                    <label>Sex
                        <input type="text" placeholder="Sex" name="sex" value="<?php echo $row['sex'] ?>">
                    </label>
                    <label>Blood type
                        <input type="text" placeholder="Blood Type" name="bloodtype" value="<?php echo $row['blood_type'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Civil Status
                        <input type="text" placeholder="Civil Status" name="civilstatus" value="<?php echo $row['civil_status'] ?>">
                    </label>
                    <label>Citizenship
                        <input type="text" placeholder="Citizenship" name="citizenship" value="<?php echo $row['citizenship'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Height
                        <input type="float" placeholder="Height" name="height" value="<?php echo $row['height'] ?>">
                    </label>
                    <label>Weight
                        <input type="float" placeholder="Weight" name="weight" value="<?php echo $row['weight'] ?>">
                    </label>
                </div>
                <label for="birthplace" id="birthplace">Place of Birth</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Barangay" name="pob_barangay" value="<?php echo $row['pob_barangay']; ?>">
                    </label>
                    <label>
                        <input type="text" placeholder="Municipality/City" name="pob_city" value="<?php echo $row['pob_city']; ?>">
                    </label>
                    <label>
                        <input type="text" placeholder="Province" name="pob_province" value="<?php echo $row['pob_province']; ?>">
                    </label>
                </div>
                <label for="residentialaddress" id="residentialaddress">Residential Address</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Barangay" name="res_barangay" value="<?php echo $row['res_barangay']; ?>">
                    </label>
                    <label>
                        <input type="text" placeholder="Municipality/City" name="res_city" value="<?php echo $row['res_city']; ?>">
                    </label>
                    <label>
                        <input type="text" placeholder="Province" name="res_province" value="<?php echo $row['res_province']; ?>">
                    </label>
                </div>
                <label>Permanent Address</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Barangay" name="per_barangay" value="<?php echo $row['per_barangay']; ?>">
                    </label>
                    <label>
                        <input type="text" placeholder="Municipality/City" name="per_city" value="<?php echo $row['per_city']; ?>">
                    </label>
                    <label>
                        <input type="text" placeholder="Province" name="per_province" value="<?php echo $row['per_province']; ?>">
                    </label>
                </div>
                <label for="residentialaddress" id="residentialaddress
                ">Father's Name</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Firstname" name="father_fname" value="<?php echo $row['father_fname']; ?>">
                    </label>
                    <label>
                        <input type="text" placeholder="Middlename" name="father_mname" value="<?php echo $row['father_mname']; ?>">
                    </label>
                    <label>
                        <input type=" text" placeholder="Lastname" name="father_lname" value="<?php echo $row['father_lname']; ?>">
                    </label>
                </div>
                <label for=" residentialaddress" id="residentialaddress
                ">Mother's Name</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Firstname" name="mother_fname" value="<?php echo $row['mother_fname']; ?>">
                    </label>
                    <label>
                        <input type=" text" placeholder="Middlename" name="mother_mname" value="<?php echo $row['mother_mname']; ?>">
                    </label>
                    <label>
                        <input type=" text" placeholder="Lastname" name="mother_lname" value="<?php echo $row['mother_lname']; ?>">
                    </label>
                </div>
                <div class=" flex">
                    <label>Contact Number
                        <input type="text" placeholder="Contact Number" name="contactnumber" value="<?php echo $row['contact_number'] ?>">
                    </label>
                    <label>Family Background
                        <input type="number" placeholder="Family Background" name="familybackground" value="<?php echo $row['family_background'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Tin ID
                        <input type="text" placeholder="Tin ID" name="tinid" value="<?php echo $row['tin_id'] ?>">
                    </label>
                    <label>SSS No.
                        <input type="text" placeholder="SSS No." name="sssno" value="<?php echo $row['sss_no'] ?>">
                    </label>
                </div>

                <div class="flex">
                    <label>Pag-ibig No.
                        <input type="text" placeholder="Pag-ibig No." name="pag-ibigno" value="<?php echo $row['pag-ibig_no'] ?>">
                    </label>
                    <label>PhilHealth No.
                        <input type="text" placeholder="PhilHealth No." name="philhealthno" value="<?php echo $row['philhealth_no'] ?>">
                    </label>
                </div>
                <div class="btns">
                    <input type="submit" name="add" value="Update">
                    <a href="javascript:history.back()">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</body>

</html>