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
    $family_background = $_POST['familybackground'];
    $father_fname = $_POST['father_fname'];
    $father_mname = $_POST['father_mname'];
    $father_lname = $_POST['father_lname'];
    $father_name = $father_fname . ", " . $father_mname . ", " . $father_lname;
    $mother_fname = $_POST['mother_fname'];
    $mother_mname = $_POST['mother_mname'];
    $mother_lname = $_POST['mother_lname'];
    $mother_name = $mother_fname . ", " . $mother_mname . ", " . $mother_lname;


    $sql_check = "SELECT * FROM employee_tbl WHERE employee_id = '$employee_id'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo '<script>alert("The employee ID already exists. Please use a different ID.")</script>';
    } else {
        $sql = "INSERT INTO employee_tbl VALUES ('$employee_id', '$fname', '$mname', '$lname', '$birthdate', '$birthplace', 
    '$sex','$bloodtype','$civilstatus','$tin_id','$citizenship','$sss_no','$pagibig_no','$philhealth_no'
    ,'$height','$weight','$residential_address','$permanent_address','$email','$contact_number','$family_background', '$father_name', '$mother_name')";
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
            <h3>Add Staff</h3>
        </div>
        <div class="form-container">
            <form class="form" method="post">
                <div class="form-title">
                    <h5>Basic Information</h5>
                </div>
                <div class="flex">
                    <label>First name
                        <input type="text" placeholder="Firstname" name="firstname">
                    </label>
                    <label>Middle name
                        <input type="text" placeholder="Middlename" name="middlename">
                    </label>
                    <label>Last name
                        <input type="text" placeholder="Lastname" name="lastname">
                    </label>
                </div>
                <div class="flex">
                    <label>Email Address
                        <input type="email" placeholder="Email Address" name="email">
                    </label>
                    <label>Employee ID
                        <input type="text" placeholder="Employee ID" name="employee_id">
                    </label>
                </div>
                <div class="flex">
                    <label>Joining Date
                        <input type="date" placeholder="Joining Date" name="birthdate">
                    </label>
                    <label>Sex
                        <input type="text" placeholder="Sex" name="sex">
                    </label>
                    <label>Bloodtype
                        <input type="text" placeholder="Blood Type" name="bloodtype">
                    </label>
                </div>
                <div class="flex">
                    <label>Civil status
                        <input type="text" placeholder="Civil Status" name="civilstatus">
                    </label>
                    <label>Citizenship
                        <input type="text" placeholder="Citizenship" name="citizenship">
                    </label>
                </div>
                <div class="flex">
                    <label>Height
                        <input type="float" placeholder="Height" name="height">
                    </label>
                    <label>Weight
                        <input type="float" placeholder="Weight" name="weight">
                    </label>
                </div>
                <label for="birthplace" id="birthplace">Place of Birth</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Barangay" name="pob_barangay">
                    </label>
                    <label>
                        <input type="text" placeholder="City" name="pob_city">
                    </label>
                    <label>
                        <input type="text" placeholder="Province" name="pob_province">
                    </label>
                </div>
                <label for="residentialaddress" id="residentialaddress
                ">Residential Address</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Barangay" name="res_barangay">
                    </label>
                    <label>
                        <input type="text" placeholder="City" name="res_city">
                    </label>
                    <label>
                        <input type="text" placeholder="Province" name="res_province">
                    </label>
                </div>
                <label for="permanentaddress">Permanent Address</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Barangay" name="per_barangay">
                    </label>
                    <label>
                        <input type="text" placeholder="City" name="per_city">
                    </label>
                    <label>
                        <input type="text" placeholder="Province" name="per_province">
                    </label>
                </div>
                <label for="residentialaddress" id="residentialaddress
                ">Father's Name</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Firstname" name="father_fname">
                    </label>
                    <label>
                        <input type="text" placeholder="Middlename" name="father_mname">
                    </label>
                    <label>
                        <input type="text" placeholder="Lastname" name="father_lname">
                    </label>
                </div>
                <label for="residentialaddress" id="residentialaddress
                ">Mother's Name</label>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Firstname" name="mother_fname">
                    </label>
                    <label>
                        <input type="text" placeholder="Middlename" name="mother_mname">
                    </label>
                    <label>
                        <input type="text" placeholder="Lastname" name="mother_lname">
                    </label>
                </div>
                <div class="flex">
                    <label>Contact Number
                        <input type="text" placeholder="Contact Number" name="contactnumber">
                    </label>
                    <label>Family Background
                        <input type="number" placeholder="Family Background" name="familybackground">
                    </label>
                </div>
                <div class="flex">
                    <label>Tin ID
                        <input type="text" placeholder="Tin ID" name="tinid">
                    </label>
                    <label>SSS no.
                        <input type="text" placeholder="SSS No." name="sssno">
                    </label>
                </div>
                <div class="flex">
                    <label>Pag-ibig no.
                        <input type="text" placeholder="Pag-ibig No." name="pag-ibigno">
                    </label>
                    <label>PhilHealth no.
                        <input type="text" placeholder="PhilHealth No." name="philhealthno">
                    </label>
                </div>
                <div class="btns">
                    <input type="submit" name="add" value="Add">
                    <a href="javascript:history.back()">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</body>

</html>