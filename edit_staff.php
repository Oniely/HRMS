<?php

include('includes/connection.php');
// session_start();
// if (!isset($_SESSION['id']) || (trim ($_SESSION['id']) == '')) {
//     header('location:../index.php');
//     exit();
// }
$employee_id = $_GET["id"];
$query = mysqli_query($conn, "select * from `employee_tbl` where employee_id='$employee_id'");
$row = mysqli_fetch_array($query);
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
            <form class="form" method="post" action="functions/staff/update.php?id=<?php echo $employee_id; ?>">
                <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
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

                    <label>Date of Birth
                        <input type="date" placeholder="Date of Birth" name="birthdate" value="<?php echo $row['date_of_birth'] ?>">
                    </label>
                    <label>Place of Birth
                        <input type="text" placeholder="Place of Birth" name="birthplace" value="<?php echo $row['place_of_birth'] ?>">
                    </label>
                </div>
                <div class="flex">
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
                    <label>Tin ID
                        <input type="number" placeholder="Tin ID" name="tinid" value="<?php echo $row['tin_id'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Citizenship
                        <input type="text" placeholder="Citizenship" name="citizenship" value="<?php echo $row['citizenship'] ?>">
                    </label>
                    <label>SSS No.
                        <input type="number" placeholder="SSS No." name="sssno" value="<?php echo $row['sss_no'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Pag-ibig No.
                        <input type="number" placeholder="Pag-ibig No." name="pag-ibigno" value="<?php echo $row['pag-ibig_no'] ?>">
                    </label>
                    <label>PhilHealth No.
                        <input type="number" placeholder="PhilHealth No." name="philhealthno" value="<?php echo $row['philhealth_no'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Height
                        <input type="decimal" placeholder="Height" name="height" value="<?php echo $row['height'] ?>">
                    </label>
                    <label>Weight
                        <input type="decimal" placeholder="Weight" name="weight" value="<?php echo $row['weight'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Residential Address
                        <input type="text" placeholder="Residential Address" name="residentialaddress" value="<?php echo $row['residential_address'] ?>">
                    </label>
                    <label>Permanent Address
                        <input type="text" placeholder="Permanent Address" name="permanentaddress" value="<?php echo $row['permanent_address'] ?>">
                    </label>
                </div>
                <div class="flex">
                    <label>Email Address
                        <input type="email" placeholder="Email Address" name="email" value="<?php echo $row['email'] ?>">
                    </label>
                    <label>Contact Number
                        <input type="number" placeholder="Contact Number" name="contactnumber" value="<?php echo $row['contact_number'] ?>">
                    </label>
                    <label>Family Background
                        <input type="number" placeholder="Family Background" name="familybackground" value="<?php echo $row['family_background'] ?>">
                    </label>
                </div>
                <input type="submit" name="update" value="Update Faculty">
            </form>
        </div>
    </section>
</body>

</html>