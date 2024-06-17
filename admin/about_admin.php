<?php

global $conn;

include('includes/connection.php');

session_name('adminSession');
session_start();


if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) {
    header('location:login.php');
    exit();
}

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $query = "SELECT * from admin_tbl WHERE admin_id = '$admin_id'";
    $query_res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_res)) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $position = $row['position'];
        $contact = $row['contact'];
        $photo_path = $row['photo_path'];
        $privilege = $row['privilage'];
    }
}

$breadcrumbs = [
    'Home' => '/hrms/admin/',
    'Admin' => '#'
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
    <link rel="stylesheet" href="styles/about.css" />
    <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <script src="script/admin_profile.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- Side Bar -->
    <?php require 'partials/aside.php' ?>
    <!-- Navbar -->
    <?php require 'partials/nav.php' ?>
    <!-- All Staff -->
    <!-- ONLY SECTION ONLY -->
    <section class="section">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>Admin Profile</h1>
            <div class="breadcrumbs">
                <?php
                if (isset($breadcrumbs) && is_array($breadcrumbs)) {
                    foreach ($breadcrumbs as $key => $value) {
                        echo "<a href='$value'>$key</a>";
                    }
                } else {
                    echo "<a href='/HRMS/admin/'>Home</a>";
                }
                ?>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="about-container">
            <div class="about-profile">
                <div class="relative prof-img">
                    <img src="<?= $photo_path ?? 'images/profile-black.svg' ?>" alt="profile" class="object-contain object-center w-full h-full">
                    <!-- super_admin edit profile btn -->
                    <?php if ($privilege === 'super_admin') : ?>
                        <button class="absolute top-0 right-0 rounded-md hover:bg-white p-0.5" id="showPasswordBtn" data-admin-id="<?= $admin_id ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
                <div class="profile-desc">
                    <div class="profile-name">
                        <?php if (isset($_SESSION['admin_id'])) {
                            echo "<h1>$fname $lname</h1>";
                        } elseif (isset($_GET['faculty_id'])) {
                            echo "<h1>$fname $mname $lname</h1>";
                        }
                        ?>

                        <?php if (isset($_GET['admin_id'])) {
                            echo "<p>$position</p>";
                        } ?>
                    </div>
                    <hr>
                    <div class="profile-info">
                        <p>Hello I am <?php echo "$fname $lname" ?></p>
                    </div>
                </div>
                <div class="admin_info">
                    <div>
                        <h3>Fullname</h3>
                        <?php echo "<p>$fname $lname</p>"; ?>
                    </div>
                    <div>
                        <h3>Mobile</h3>
                        <?php echo "<p>$contact</p>"; ?>
                    </div>
                    <div>
                        <?php
                        if (isset($_GET["admin_id"])) {
                            echo "<h3>Position</h3>";
                            echo "<p>$position</p>";
                        } else {
                        ?>
                            <h3>Email</h3>
                            <p><?= $email ?></p>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($permanent_address)) {
                    ?>
                        <div>
                            <h3>Location</h3>
                            <p><?php echo $permanent_address ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- MODALs -->
    <?php include_once "modals/show_password.modal.php" ?>
    <?php include_once "modals/admin_profile_change.php" ?>
</body>

</html>