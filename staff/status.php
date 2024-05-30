<?php
global $conn;
include('includes/connection.php');
session_start();

if (!isset($_SESSION['employee_id'])) {
    header('Location: staff_login.php');
}

if (isset($_SESSION['employee_id'])) {
    $id = $_SESSION['employee_id'];
    $elem_school = $elem_year = $highschool_school = $highschool_year = $vocational_school = $vocational_course = $vocational_year = $college_school = $college_course = $college_year = $faculty_id = $fname = $lname = $sex = $contact = $email = $permanent_address = $status = $photo_path = "";
    $query = "SELECT * FROM faculty_tbl WHERE faculty_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        $faculty_id = $row['faculty_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $sex = $row['sex'];
        $contact = $row['contact_number'];
        $email = $row['email'];
        $permanent_address = $row['permanent_address'];
        $status = $row['status'];
        $photo_path = $row['photo_path'];
        if (empty($photo_path)) {
            $photo_path = "images/profile-black.svg";
        }
    } elseif (!$row) {
        $query = "SELECT * FROM employee_tbl WHERE employee_id = $id";
        $query_res = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($query_res)) {
            // Assign values from employee_tbl
            $faculty_id = $row['employee_id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $sex = $row['sex'];
            $contact = $row['contact_number'];
            $permanent_address = $row['permanent_address'];
            $status = $row['status'];
            $photo_path = $row['photo_path'];
            if (empty($photo_path)) {
                $photo_path = "images/profile-black.svg"; // Change this to your default image path
            }
        }
    }
    $query = "SELECT * FROM elementary_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        $elem_school = $row['schoolname'];
        $elem_address = $row['address'];
        $elem_year = $row['year_graduate'];
    }
    $query = "SELECT * FROM highschool_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        // Display information for high school
        $highschool_school = $row['schoolname'];
        $highschool_address = $row['address'];
        $highschool_year = $row['year_graduate'];
    }

    $query = "SELECT * FROM vocational_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        // Display information for vocational school
        $vocational_school = $row['schoolname'];
        $vocational_course = $row['course'];
        $vocational_address = $row['address'];
        $vocational_year = $row['year_graduate'];
    }

    // Check if the employee's data exists in college_tbl
    $query = "SELECT * FROM college_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        // Display information for college
        $college_school = $row['schoolname'];
        $college_course = $row['course'];
        $college_address = $row['address'];
        $college_year = $row['year_graduate'];
    }
    $query = "SELECT * from leave_balance_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        $annual_leave = $row['annual_leave'];
        $sick_leave = $row['sick_leave'];
        $unpaid_leave = $row['unpaid_leave'];
        $balance = $row['balance'];
    }

    $query = "SELECT * from leave_balance_tbl WHERE employee_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($query_res)) {
        $annual_leave = $row['annual_leave'];
        $sick_leave = $row['sick_leave'];
        $unpaid_leave = $row['unpaid_leave'];
        $balance = $row['balance'];
    }
}



require_once './includes/query.php';
$active = "leave status";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css" />
    <link rel="stylesheet" href="styles/index.css" />
    <link rel="stylesheet" href="styles/status.css" />
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <script src="script/status-modal.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
            <h1>Leave Status</h1>
        </div>

        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="status-container">
            <div class="status-nav">
                <button id="pending-link">Pending</button>
                <button id="balance-link">Leave Balance</button>
                <button id="history-link">Leave Usage History</button>
            </div>
            <div class="status-content" id="status-content">

            </div>
        </div>

    </section>
</body>

</html>

<script>
    const pendingLink = document.getElementById('pending-link');
    const balanceLink = document.getElementById('balance-link');
    const historyLink = document.getElementById('history-link');
    const statusContent = document.getElementById('status-content');

    pendingLink.addEventListener('click', () => showContent('pending'));
    balanceLink.addEventListener('click', () => showContent('balance'));
    historyLink.addEventListener('click', () => showContent('history'));

    window.addEventListener('load', () => {
        showContent('pending');
    });

    function getContent(path) {
        $.ajax({
            url: path,
            type: 'GET',
            success: (res) => {
                $('#status-content').html(res)
            },
            error: () => {
                $('#status-content').html("<p>Error loading content</p>")
            }
        })
    }

    function showContent(type) {
        let content;
        switch (type) {
            case 'pending':
                getContent('status/pending.php');
                break;
            case 'balance':
                getContent('status/leave_balance.php');
                break;
            case 'history':
                getContent('status/status.php');
                break;
            default:
                content = "<p>Content not available</p>";
        }

        pendingLink.classList.remove('active-tab');
        balanceLink.classList.remove('active-tab');
        historyLink.classList.remove('active-tab');

        switch (type) {
            case 'pending':
                pendingLink.classList.add('active-tab');
                break;
            case 'balance':
                balanceLink.classList.add('active-tab');
                break;
            case 'history':
                historyLink.classList.add('active-tab');
                break;
        }
    }
</script>