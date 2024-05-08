<?php

global $conn;

include('includes/connection.php');



session_start();
// if (isset($_SESSION['employee_id'])) {
//     $id = $_SESSION['employee_id'];
//     $query = "SELECT * FROM faculty_tbl WHERE faculty_id = $id";
//     $query_res = mysqli_query($conn, $query);

//     if ($row = mysqli_fetch_assoc($query_res)) {
//         // Fetch and display basic personal information for faculty
//         $faculty_id = $row['faculty_id'];
//         $fname = $row['fname'];
//         $lname = $row['lname'];
//         $sex = $row['sex'];
//         $contact = $row['contact_number'];
//         $email = $row['email'];
//         $permanent_address = $row['permanent_address'];
//         $status = $row['status'];
//         $photo_path = !empty($row['photo_path']) ? $row['photo_path'] : "images/profile-black.svg"; // Use default image if photo path is empty

//         // Fetch and display educational attainment for faculty
//         $elem_query = "SELECT * FROM elementary_tbl WHERE employee_id = $id";
//         $elem_query_res = mysqli_query($conn, $elem_query);
//         if ($elem_row = mysqli_fetch_assoc($elem_query_res)) {
//             $elem_school = $elem_row['schoolname'];
//             $elem_address = $elem_row['address'];
//             $elem_year = $elem_row['year_graduate'];
//         }

//         // Fetch and display high school education
//         $highschool_query = "SELECT * FROM highschool_tbl WHERE employee_id = $id";
//         $highschool_query_res = mysqli_query($conn, $highschool_query);
//         if ($highschool_row = mysqli_fetch_assoc($highschool_query_res)) {
//             $highschool_school = $highschool_row['schoolname'];
//             $highschool_address = $highschool_row['address'];
//             $highschool_year = $highschool_row['year_graduate'];
//         }

//         // Fetch and display vocational education
//         $vocational_query = "SELECT * FROM vocational_tbl WHERE employee_id = $id";
//         $vocational_query_res = mysqli_query($conn, $vocational_query);
//         if ($vocational_row = mysqli_fetch_assoc($vocational_query_res)) {
//             $vocational_school = $vocational_row['schoolname'];
//             $vocational_course = $vocational_row['course'];
//             $vocational_address = $vocational_row['address'];
//             $vocational_year = $vocational_row['year_graduate'];
//         }

//         // Fetch and display college education
//         $college_query = "SELECT * FROM college_tbl WHERE employee_id = $id";
//         $college_query_res = mysqli_query($conn, $college_query);
//         if ($college_row = mysqli_fetch_assoc($college_query_res)) {
//             $college_school = $college_row['schoolname'];
//             $college_course = $college_row['course'];
//             $college_address = $college_row['address'];
//             $college_year = $college_row['year_graduate'];
//         }
//     } else {
//         // If user is not in faculty_tbl, assume they are an employee
//         $query = "SELECT * FROM employee_tbl WHERE employee_id = $id";
//         $query_res = mysqli_query($conn, $query);

//         if ($row = mysqli_fetch_assoc($query_res)) {
//             // Fetch and display basic personal information for employee
//             $employee_id = $row['employee_id'];
//             $fname = $row['fname'];
//             $lname = $row['lname'];
//             $email = $row['email'];
//             $sex = $row['sex'];
//             $contact = $row['contact_number'];
//             $permanent_address = $row['permanent_address'];
//             $status = $row['status'];
//             $photo_path = !empty($row['photo_path']) ? $row['photo_path'] : "images/profile-black.svg"; // Use default image if photo path is empty

//             // Fetch and display educational attainment for employee
//             $elem_query = "SELECT * FROM elementary_tbl WHERE employee_id = $id";
//             $elem_query_res = mysqli_query($conn, $elem_query);
//             if ($elem_row = mysqli_fetch_assoc($elem_query_res)) {
//                 $elem_school = $elem_row['schoolname'];
//                 $elem_address = $elem_row['address'];
//                 $elem_year = $elem_row['year_graduate'];
//             }

//             // Fetch and display high school education
//             $highschool_query = "SELECT * FROM highschool_tbl WHERE employee_id = $id";
//             $highschool_query_res = mysqli_query($conn, $highschool_query);
//             if ($highschool_row = mysqli_fetch_assoc($highschool_query_res)) {
//                 $highschool_school = $highschool_row['schoolname'];
//                 $highschool_address = $highschool_row['address'];
//                 $highschool_year = $highschool_row['year_graduate'];
//             }

//             // Fetch and display vocational education
//             $vocational_query = "SELECT * FROM vocational_tbl WHERE employee_id = $id";
//             $vocational_query_res = mysqli_query($conn, $vocational_query);
//             if ($vocational_row = mysqli_fetch_assoc($vocational_query_res)) {
//                 $vocational_school = $vocational_row['schoolname'];
//                 $vocational_course = $vocational_row['course'];
//                 $vocational_address = $vocational_row['address'];
//                 $vocational_year = $vocational_row['year_graduate'];
//             }

//             // Fetch and display college education
//             $college_query = "SELECT * FROM college_tbl WHERE employee_id = $id";
//             $college_query_res = mysqli_query($conn, $college_query);
//             if ($college_row = mysqli_fetch_assoc($college_query_res)) {
//                 $college_school = $college_row['schoolname'];
//                 $college_course = $college_row['course'];
//                 $college_address = $college_row['address'];
//                 $college_year = $college_row['year_graduate'];
//             }
//         }
//     }
// }

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
            $photo_path = "images/profile-black.svg"; // Change this to your default image path
        }
    } elseif (!$row) {
        // Data not found in faculty_tbl, handle here
        // Fetch data from employee_tbl
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
}


require_once './includes/query.php';
$active = "about staff";
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
</head>

<body>
    <!-- Side Bar -->
    <?php require 'partials/aside.php' ?>
    <!-- Navbar -->
    <?php require 'partials/nav.php' ?>
    <!-- All Staff -->
    <!-- ONLY SECTION ONLY -->
    <section class="section container">
        <!-- DEFAULT TITLE -->
        <div class="section-title">
            <h1>Leave Status</h1>
        </div>

        <!-- END DEFAULT -->
        <!-- NEW THINGS -->
        <div class="status-container">
            <div class="status-nav">
                <a href="#" id="pending-link">Pending</a>
                <a href="#" id="balance-link">Leave Balance</a>
                <a href="#" id="history-link">Leave Usage History</a>
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

    function showContent(type) {
        let content;
        switch (type) {
            case 'pending':
                content = "<p>This is pending content</p>";
                break;
            case 'balance':
                content = "<p>This is leave balance content</p>";
                break;
            case 'history':
                content = "<?php
                            $sql = "SELECT * FROM leave_tbl WHERE employee_id = '$employee_id'";
                            $result = mysqli_query($conn, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    $reason = $row['reason'];
                                    $leave_type = $row['leave_type'];
                                    $start_date = $row['from_date'];
                                    $end_date = $row['to_date'];
                                    $date = date('Y-m-d');
                                    $status = $row['application_status'];
                                    $leave_id = $row['leave_id'];


                                   if( $status == 'ACCEPTED') {
                                        $statusBackground = '#48cfae';
                                    } elseif ($status == 'REJECTED') {
                                        $statusBackground = '#fa5858';
                                    } elseif($status == 'PENDING') {
                                        $statusBackground = '#f6c06e';
                                    }

                                    echo "<div class='status-items' id='notification_$leave_id' style='background-color: $statusBackground'>";
                                    echo "<table>";
                                    echo "<tr'>";
                                    echo "<th>Application No. </th>";
                                    echo "<th>Type of Leave </th>";
                                    echo "<th>Data of Application</th>";
                                    echo "<th>Status</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>$leave_id</td>";
                                    echo "<td>$leave_type</td>";
                                    echo "<td>$start_date</td>";
                                    echo "<td>$status</td>";
                                    echo "</tr>";
                                    echo "</table>";
                                    echo "</div>";
                                }
                            }
                            ?>";
                break;
            default:
                content = "<p>Content not available</p>";
        }
        statusContent.innerHTML = content;

        pendingLink.classList.remove('active');
        balanceLink.classList.remove('active');
        historyLink.classList.remove('active');

        switch (type) {
            case 'pending':
                pendingLink.classList.add('active');
                break;
            case 'balance':
                balanceLink.classList.add('active');
                break;
            case 'history':
                historyLink.classList.add('active');
                break;
        }
    }
</script>