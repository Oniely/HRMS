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

$active = "all staff";
$breadcrumbs = [
    'Home' => '/hrms/admin/',
    'Staff' => '#',
    'All Staff' => '#'
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
    <!-- ONLY SECTION ONLY -->
    <section class="section">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>All Staff</h1>
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
                <div class="add-btn">
                    <a href="add_staff.php">Add New</a>
                </div>
                <div class="filter-search-container">
                    <div class="filter">
                        <span>Show</span>
                        <!-- change name and id -->
                        <!-- change options to need -->
                        <select name="select" id="select">
                            <option value="" selected hidden>0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <!-- References to nav search -->
                    <div class="search-container">
                        <input id="search" name="search" type="text" placeholder="Search" autocomplete="off" />
                        <button>
                            <img src="images/search.svg" alt="" />
                        </button>
                        <div id="suggestions" class="suggestions"></div>
                    </div>
                </div>
                <div class="main-table-container">
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Staff ID</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="staff-table-body">
                                <?php
                                include('includes/connection.php');
                                include('includes/update_status.php');

                                if (updateEmployeeStatus($conn)) {
                                    // echo "Employee statuses updated successfully.";
                                } else {
                                    // echo "Failed to update employee statuses.";
                                }

                                $query = mysqli_query($conn, "SELECT * FROM `employee_tbl`");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><label><?php echo $row['employee_id']; ?></label></td>
                                        <td><label><?= $row['status'] ?></label></td>
                                        <td><label><?php echo $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']; ?></label></td>
                                        <td><label><?php echo $row['department']; ?></label></td>
                                        <td><label><?php echo $row['email']; ?></label></td>
                                        <td><label><?php echo $row['permanent_address']; ?></label></td>
                                        <td><label><?php echo $row['date_of_birth']; ?></label></td>
                                        <td class='action'>
                                            <a class="view-btn" href="about_staff.php?id=<?php echo $row['employee_id'] ?>">
                                                <div>
                                                    <img src="images/eyes.svg" alt="View">
                                                </div>
                                            </a>
                                            <a class='update-btn' href='edit_staff.php?id=<?php echo $row['employee_id']; ?>'>
                                                <div>
                                                    <img src="images/update-btn.svg" alt="update">
                                                </div>
                                            </a>
                                            <a class="delete-btn" href="functions/staff/delete.php?id=<?php echo $row['employee_id']; ?>">
                                                <div>
                                                    <img src="images/delete-btn.svg" alt="update">
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
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
        const suggestionsContainer = document.getElementById('suggestions');
        const tableBody = document.getElementById('staff-table-body');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            filterTable(query);
            showSuggestions(query);
        });

        function filterTable(query) {
            const rows = tableBody.getElementsByTagName('tr');
            for (let row of rows) {
                const nameCell = row.getElementsByTagName('label')[2];
                if (nameCell) {
                    const name = nameCell.textContent.toLowerCase();
                    if (name.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }
        }

        function showSuggestions(query) {
            suggestionsContainer.innerHTML = '';
            if (query.length < 1) {
                suggestionsContainer.style.display = 'none';
                return;
            }

            const rows = tableBody.getElementsByTagName('tr');
            const suggestions = new Set();
            for (let row of rows) {
                const nameCell = row.getElementsByTagName('label')[2];
                if (nameCell) {
                    const name = nameCell.textContent;
                    if (name.toLowerCase().includes(query)) {
                        suggestions.add(name);
                    }
                }
            }

            if (suggestions.size > 0) {
                    suggestions.forEach(name => {
                        const suggestionItem = document.createElement('div');
                        suggestionItem.classList.add('suggestion-item');
                        suggestionItem.textContent = name;
                        suggestionItem.addEventListener('click', function() {
                            searchInput.value = name;
                            filterTable(name.toLowerCase());
                            suggestionsContainer.innerHTML = '';
                            suggestionsContainer.style.display = 'none';
                        });
                        suggestionsContainer.appendChild(suggestionItem);
                    });
                    suggestionsContainer.style.display = 'flex';
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            }

        document.addEventListener('click', function(event) {
            if (!suggestionsContainer.contains(event.target) && event.target !== searchInput) {
                suggestionsContainer.innerHTML = '';
                suggestionsContainer.style.display = 'none';
            }
        });
    });
</script>