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
            <h1>Admin Privilages</h1>
            <div class="breadcrumbs">
                <a href="#">Dashboard</a>
                <a href="#">Admin Privilages</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="w-full">
            <div class="py-8">
                <button class="text-sm font-semibold uppercase tracking-tight text-white bg-[#4763ca] py-4 px-4 rounded-full hover:opacity-95">Add New Admin</button>
            </div>
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left text-gray table-auto">
                    <thead class=" text-[15px] text-white uppercase bg-[#4763ca] min-[950px]:bg-[#6d85db]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Employee
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Position
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Contact Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Privilage
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center gap-2">
                                <img class="w-8 h-8 object-contain object-center aspect-square" src="/hr/images/profile-black.svg" alt="photo">
                                and Friends
                            </td>
                            <td class="px-6 py-4">
                                Secretary
                            </td>
                            <td class="px-6 py-4">
                                andFriend69@gmail.com
                            </td>
                            <td class="px-6 py-4">
                                09123456789
                            </td>
                            <td class="px-6 py-4">
                                Admin
                            </td>
                            <td class="px-6 py-4">
                                <button class="font-medium text-blue-600  hover:underline">Edit Privilage</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>

</html>