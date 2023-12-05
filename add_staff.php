<?php
require 'includes/connection.php'; 
// session_start();
// if (!isset($_SESSION['id']) || (trim ($_SESSION['id']) == '')) {
//     header('location:../index.php');
//     exit();
// }
if (isset($_POST['add'])) {
    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $birthplace = $_POST['birthplace'];
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
    $residential_address = $_POST['residentialaddress'];
    $permanent_address = $_POST['permanentaddress'];
    $email = $_POST['email'];
    $contact_number = $_POST['contactnumber'];
    $family_background = $_POST['familybackground'];
 
    $sql = "INSERT INTO employee_tbl VALUES (default, '$fname', '$mname', '$lname', '$birthdate', '$birthplace', 
    '$sex','$bloodtype','$civilstatus','$tin_id','$citizenship','$sss_no','$pagibig_no','$philhealth_no'
    ,'$height','$weight','$residential_address','$permanent_address','$email','$contact_number','$family_background')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("ADDED")</script>';
        echo '<script>window.open("all_staff.php")</script>';
    } else {
        echo "Error " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/faculty/addfaculty.css" />
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- Side Bar -->
    <aside class="side-bar open" id="side-bar">
        <div class="logo">
            <h2>Logo</h2>
        </div>

        <div class="side-link">
            <div class="profile" id="profile">
                <div class="profile-img-container">
                    <img src="images/1.svg" alt="icon" />
                </div>
                <div class="profile-info">
                    <h1>Alejandro Evanhilo</h1>
                    <h3>Administrator</h3>
                </div>
            </div>
            <ul class="links">
                <li>
                    <a href="index.php"><img class="icon" src="images/2.svg" alt="icon" />
                        <span class="link-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <button class="dropdown-btn" href="#">
                        <img class="icon" src="images/3.svg" alt="icon" />
                        <span class="link-name active">Staff</span>
                        <img class="arrow" src="images/arrow.svg" alt="" />
                    </button>
                    <div class="dropdown-menu">
                        <a href="all_staff.php">All Staff</a>
                        <a class="active" href="add_staff.php">Add Staff</a>
                        <a href="edit_staff.php">Edit Staff</a>
                        <a href="#">Status</a>
                        <a href="#">About Staff</a>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn" href="#">
                        <img class="icon" src="images/4.svg" alt="icon" />
                        <span class="link-name">Faculty</span>
                        <img class="arrow" src="images/arrow.svg" alt="" />
                    </button>
                    <div class="dropdown-menu">
                        <a href="add_faculty.php">Add Faculty</a>
                        <a href="all_faculty.php">All Faculty</a>
                        <a href="edit_faculty.php">Edit Faculty</a>
                        <a href="#">Status</a>
                        <a href="#">About Faculty</a>
                    </div>
                </li>
                <li>
                    <a href="#"><img class="icon" src="images/5.svg" alt="icon" />
                        <span class="link-name">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- Navbar -->
    <nav class="navbar open" id="navbar">
        <div class="left-nav">
            <button id="burger" class="burger">
                <img src="images/burger.svg" alt="" />
            </button>
            <div class="search-container">
                <input type="text" placeholder="Search..." />
                <button>
                    <img src="images/search.svg" alt="" />
                </button>
            </div>
        </div>
        <div class="right-nav">
            <button class="profile-btn">
                <div class="profile-img-container">
                    <img src="images/profile.svg" alt="" />
                </div>
                <span>Alejandro</span>
                <div class="profile-menu">
                    <a href="#">
                        <div>
                            <img src="images/profile.svg" alt="">
                            <span>Profile</span>
                        </div>
                    </a>
                    <a href="">
                        <div>
                            <img src="images/5.svg" alt="">
                            <span>Profile</span>
                        </div>
                    </a>
                    <a href="">
                        <div>
                            <img src="images/3.svg" alt="">
                            <span>Help</span>
                        </div>
                    </a>
                    <a href="">
                        <div>
                            <img src="images/arrow.svg" alt="">
                            <span>Logout</span>
                        </div>
                    </a>
                </div>
            </button>
        </div>
    </nav>
    <!-- Dashboard -->
    <section class="dashboard-container">
        <div class="content-title">
            <h3>Add Faculty</h3>
        </div>
        <div class="form-container">
            <form class="form" method="post">
                <div class="form-title">
                    <h5>Basic Information</h5>
                </div>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Firstname" name="firstname">
                    </label>
                    <label>
                        <input type="text" placeholder="Middlename" name="middlename">
                    </label>
                    <label>
                        <input type="text" placeholder="Lastname" name="lastname">
                    </label>
                </div>
                <div class="flex">

                    <label>
                        <input type="date" placeholder="Date of Birth" name="birthdate">
                    </label>
                    <label>
                        <input type="text" placeholder="Place of Birth" name="birthplace">
                    </label>
                </div>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Sex" name="sex">
                    </label>
                    <label>
                        <input type="text" placeholder="Blood Type" name="bloodtype">
                    </label>
                </div>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Civil Status" name="civilstatus">
                    </label>
                    <label>
                        <input type="number" placeholder="Tin ID" name="tinid">
                    </label>
                </div>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Citizenship" name="citizenship">
                    </label>
                    <label>
                        <input type="number" placeholder="SSS No." name="sssno">
                    </label>
                </div>
                <div class="flex">
                    <label>
                        <input type="number" placeholder="Pag-ibig No." name="pag-ibigno">
                    </label>
                    <label>
                        <input type="number" placeholder="PhilHealth No." name="philhealthno">
                    </label>
                </div>
                <div class="flex">
                    <label>
                        <input type="decimal" placeholder="Height" name="height">
                    </label>
                    <label>
                        <input type="decimal" placeholder="Weight" name="weight">
                    </label>
                </div>
                <div class="flex">
                    <label>
                        <input type="text" placeholder="Residential Address" name="residentialaddress">
                    </label>
                    <label>
                        <input type="text" placeholder="Permanent Address" name="permanentaddress">
                    </label>
                </div>
                <div class="flex">
                    <label>
                        <input type="email" placeholder="Email Address" name="email">
                    </label>
                    <label>
                        <input type="number" placeholder="Contact Number" name="contactnumber">
                    </label>
                    <label>
                        <input type="number" placeholder="Family Background" name="familybackground">
                    </label>
                </div>
                <input type="submit" name="add" value="Add Faculty">
            </form>
        </div>
    </section>
</body>
</html>