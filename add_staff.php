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
        <form class="f-container">
            <div class="f-section">
                <div class="f-title">
                    <h1>Basic Information</h1>
                    <div class="hr"></div>
                </div>
                <div class="f-inputs">
                    <div class="relative z-0">
                        <input type="text" id="fname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="fname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">First Name</label>
                    </div>
                    <div class="relative z-0">
                        <input type="text" id="lname" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer" placeholder=" " />
                        <label for="lname" class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Last Name</label>
                    </div>

                    <!-- <input class="input" type="text" placeholder="First Name">
                    <input class="input" type="text" placeholder="Last Name">
                    <input class="input" type="email" placeholder="Email">
                    <input class="input" type="text" placeholder="Joining Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                    <input class=" input" type="text" placeholder="Designation">
                    <input class="input" type="text" placeholder="Department">
                    <select class="input" name="gender" id="gender">
                        <option value="" disabled selected hidden>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                    <input class="input" type="number" placeholder="Mobile Number">
                    <input class="input" type="text" placeholder="Address">
                    <input class="input" type="text" placeholder="Blood Type"> -->
                </div>
            </div>
        </form>
    </section>
</body>

</html>