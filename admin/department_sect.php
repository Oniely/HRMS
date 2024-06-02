<?php

include('includes/connection.php');
include('includes/query.php');

session_name('adminSession');
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

$sql = "SELECT * FROM department_tbl";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css" />
    <link rel="stylesheet" href="styles/main.css">
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <script src="script/department.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-[950px]:flex-row">
    <!-- Side Bar -->
    <?php require 'partials/aside.php' ?>
    <!-- Navbar -->
    <?php require 'partials/nav.php' ?>
    <!-- Dashboard -->
    <!-- ONLY SECTION ONLY -->
    <!-- Desktop Section -->
    <section class="section">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>Department</h1>
            <div class="breadcrumbs">
                <a href="./index.php">Dashboard</a>
                <a href="./department_sect.php">Department</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <?php if ($rows != null && is_array($rows) && count($rows) > 0) : ?>
            <div class="w-full">
                <div class="py-8">
                    <button id="modal_btn" class="text-sm font-semibold uppercase tracking-tight text-white bg-[#4763ca] py-4 px-4 rounded-full hover:opacity-95">Add New Department</button>
                </div>
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left text-gray table-auto">
                        <thead class="text-[15px] text-white uppercase bg-[#4763ca]">
                            <tr>
                                <th scope="col" class="px-6 py-3">Employee</th>
                                <th scope="col" class="px-6 py-3">Position</th>
                                <th scope="col" class="px-6 py-3">Username</th>
                                <th scope="col" class="px-6 py-3">Contact Number</th>
                                <th scope="col" class="px-6 py-3">Department</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row) : ?>
                                <tr class="odd:bg-white even:bg-gray-50 border-b">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <img class="w-8 h-8 object-contain object-center aspect-square" src="/HRMS/admin/images/profile-black.svg" alt="photo">
                                            <span><?= $row['fname'] . " " .  $row['lname'] ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $row['position'] ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $row['username'] ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $row['contact'] ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $row['department'] ?>
                                    </td>
                                    <td class="actions px-6 py-4 space-x-2">
                                        <button data-department-id="<?= $row['department_id'] ?>" class="show_password_btn font-medium text-[#4f6acd]  hover:underline whitespace-nowrap">Show Password</button>
                                        <button data-department-id="<?= $row['department_id'] ?>" class="edit_department_btn font-medium text-[#4f6acd]  hover:underline whitespace-nowrap">Edit Account</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="w-full">
                <div class="flex flex-col items-center justify-center py-[10rem] gap-3">
                    <p class="text-center text-gray-600 min-[400px]:whitespace-nowrap max-sm:text-sm">There are no spare department accounts available.</p>
                    <button id="modal_btn" class="py-3 px-4 text-neutral-100 text-sm whitespace-nowrap bg-[#4763ca] rounded-full">Create Department Account</button>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <!-- Add Admin Modal -->
    <?php include_once "modals/add_department.modal.php" ?>
    <?php include_once "modals/edit_department.modal.php" ?>
    <?php include_once "modals/show_dept_password.modal.php" ?>
</body>

</html>
