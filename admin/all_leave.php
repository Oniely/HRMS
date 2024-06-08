<?php

include('includes/connection.php');
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

$active = "leave";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css" />
    <link rel="stylesheet" href="styles/all.css" />
    <link rel="icon" href="images/southland-icon.png" sizes="16x16 32x32" type="image/png" />
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
    <!-- All Staff -->
    <!-- ONE SECTION ONLY -->
    <section class="section">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>All Faculty</h1>
            <div class="breadcrumbs">
                <a href="/hrms/admin/">Home</a>
                <a href="/hrms/admin/all_faculty.php">Faculty</a>
                <a href="#">All Faculty</a>
            </div>
        </div>
        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="view-buttons">
            <button type="button" class="view-btn active">List View</button>
            <button type="button" class="view-btn">Grid View</button>
        </div>

        <div class="table-container">
            <div class="table-buttons">
                <button><img src="images/refresh.svg" alt="refresh"></button>
                <button>
                    <svg id="arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="500" preserveAspectRatio="xMidYMid meet" version="1.0">
                        <path d="M 284.238281 172.824219 L 119.457031 8.042969 C 111.414062 0 98.371094 0 90.324219 8.042969 C 82.5 16.085938 82.5 28.914062 90.324219 36.957031 L 240.761719 187.390625 L 90.324219 337.824219 C 82.5 345.871094 82.5 358.914062 90.324219 366.957031 C 98.371094 375 111.414062 375 119.457031 366.957031 L 284.457031 201.957031 C 292.5 193.914062 292.5 180.871094 284.238281 172.824219 Z M 284.238281 172.824219 " fill-opacity="1" fill-rule="evenodd" />
                    </svg>
                </button>
                <button><img src="images/x.svg" alt="x"></button>
            </div>
            <hr />
            <div class="all-staff">
                <div class="filter-search-container">
                    <div class="filter">
                        <span>Show</span>
                        <!-- change name and id -->
                        <!-- change options to need -->
                        <select name="select" id="select">
                            <option value="" selected hidden>Department</option>
                            <option value="">All</option>
                            <option value="SECSA">SECSA</option>
                            <option value="SHTM">SHTM</option>
                            <option value="SEAS">SEAS</option>
                            <option value="SBA">SBA</option>
                        </select>
                    </div>
                    <!-- References to nav search -->
                    <div class="search-container">
                        <input id="search" name="search" type="text" placeholder="Search Name" autocomplete="off" />
                        <button>
                            <img src="images/search.svg" alt="" />
                        </button>
                    </div>
                </div>
                <div class="main-table-container">
                    <div class="table">
                        <table>
                            <thead>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Leave Type</th>
                                <th>Date Applied</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Day/s</th>
                            </thead>
                            <tbody id="staff-table-body">
                                <?php
                                include('includes/connection.php');
                                $query = mysqli_query($conn, "SELECT * FROM `leave_tbl` ORDER BY date_applied DESC");
                                if (!$query) {
                                    error_log("Error fetching faculty data: " . mysqli_error($conn));
                                }

                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr data-department="<?php echo $row['department']; ?>">
                                        <td><label><?php echo $row['employee_id']; ?></label></td>
                                        <td><label><?= $row['employee_name']; ?></label></td>
                                        <td><label><?php echo $row['department']; ?></label></td>
                                        <td><label><?php echo $row['leave_type']; ?></label></td>
                                        <td><label><?php echo $row['date_applied']; ?></label></td>
                                        <td><label><?php echo $row['from_date']; ?></label></td>
                                        <td><label><?php echo $row['to_date']; ?></label></td>
                                        <td><label><?php echo $row['total_days_leave']; ?></label></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('staff-table-body');
        const selectElement = document.getElementById('select');
        const tableRows = tableBody.getElementsByTagName('tr');

        selectElement.addEventListener('change', function() {
            filterTable();
        });

        searchInput.addEventListener('input', function() {
            filterTable();
        });

        function filterTable() {
            const selectedDepartment = selectElement.value.toLowerCase();
            const query = searchInput.value.toLowerCase();

            for (let i = 0; i < tableRows.length; i++) {
                const row = tableRows[i];
                const department = row.getAttribute('data-department').toLowerCase();
                const nameCell = row.getElementsByTagName('label')[1];
                const name = nameCell ? nameCell.textContent.toLowerCase() : '';

                if ((selectedDepartment === "" || department === selectedDepartment) && (query === "" || name.includes(query))) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }
    });
</script>