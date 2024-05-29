<?php
global $conn;
session_start();

include('includes/connection.php');
require 'includes/query.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $destination = isset($_POST['destination']) ? $_POST['destination'] : '';
    $accompany = isset($_POST['accompany']) ? $_POST['accompany'] : '';
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';
    $total_days = isset($_POST['total_days']) ? $_POST['total_days'] : '';
    $leave_balance = isset($_POST['leave_balance']) ? $_POST['leave_balance'] : '';
    $leave_type = isset($_POST['status']) ? $_POST['status'] : '';

    $department = isset($_SESSION['department']) ? $_SESSION['department'] : 'Unknown';


    $designation = '';

    $designation = '';

    // Debugging: Display the employee ID being checked
    error_log("Checking employee ID: $employee_id");

    // Query to check if employee_id is in employee_tbl
    $checkEmployee = "SELECT * FROM employee_tbl WHERE employee_id = ?";
    $stmtEmployee = $conn->prepare($checkEmployee);
    $stmtEmployee->bind_param("i", $employee_id);
    $stmtEmployee->execute();
    $resultEmployee = $stmtEmployee->get_result();

    if ($resultEmployee->num_rows > 0) {
        $designation = 'Staff';
    } else {
        // Query to check if employee_id is in faculty_tbl
        $checkFaculty = "SELECT * FROM faculty_tbl WHERE faculty_id = ?";
        $stmtFaculty = $conn->prepare($checkFaculty);
        $stmtFaculty->bind_param("i", $employee_id);
        $stmtFaculty->execute();
        $resultFaculty = $stmtFaculty->get_result();

        if ($resultFaculty->num_rows > 0) {
            $designation = 'Faculty';
        } else {
            $designation = 'Not Designated';
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <link rel="stylesheet" href="styles/print.css" />
</head>

<body>
    <main>
        <!-- HR COPY -->
        <section>
            <div class="banner">
                <img src="images/southland_banner.png" alt="Southland College">
            </div>
            <div class="container">
                <h2>
                    Application for Leave of Absence
                    <span>Human Resource Copy</span>
                </h2>
                <div class="box application-box">
                    <div class="box-left">
                        <div>
                            <p>Date of Filing: <span>2021-06-24</span></p>
                            <p>Name: <span><?php echo $name ?></span></p>
                            <p>Department: <span><?php echo $department ?></span></p>
                            <p>Designation: <span><?php echo $designation ?></span></p>
                        </div>
                        <div>
                            <b><?php echo $name ?></b>
                            <input type="text" />
                            <i>Signature of Application</i>
                        </div>
                    </div>
                    <div class="box-right">
                        <div>
                            <p>
                                Leave Applied for: <span><?php echo $leave_type ?></span>
                            </p>
                            <p>
                                Inclusive Date/s:
                                <span>From: <?php echo $from_date ?> To: <?php echo $to_date ?></span>
                            </p>
                            <p>No. of Day/s: <span><?php echo $total_days ?></span></p>
                        </div>
                        <div>
                            <div class="approval">
                                <p>ACTION (By Authorized Official):</p>
                                <div>
                                    <input type="checkbox" id="approval" name="approval" />
                                    <p>Approval</p>
                                </div>
                                <div>
                                    <input type="checkbox" id="disapproval" name="disapproval" />
                                    <p>Disapproval</p>
                                </div>
                            </div>
                            <input type="text" />
                            <i>Immediate Supervisor</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Certification of Leave Credits</h2>
                <div class="box certification-box">
                    <div class="box-left">
                        <div>
                            <p>Leave Credits as of: <span>2021-06-24</span></p>
                            <p>
                                Reason:
                                <span><?php echo $reason ?></span>
                            </p>
                            <p>Balance: <span><?php echo $leave_balance ?></span></p>
                        </div>
                    </div>
                    <div class="box-right">
                        <div>
                            <input type="text" />
                            <i>HR Personnel</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Recommending Approval:</h2>
                <div class="box recommend-box">
                    <div class="box-left">
                        <div>
                            <div>
                                <span>For:</span>
                                <input type="text" />
                                <span>days with pay</span>
                            </div>
                            <div>
                                <span>For:</span>
                                <input type="text" />
                                <span>days without pay</span>
                            </div>
                        </div>
                        <div>
                            <input type="text" />
                            <i>Division Head</i>
                        </div>
                    </div>
                    <div class="box-right">
                        <div>
                            <div><span>Date: </span><input type="text" /></div>
                            <div class="approval">
                                <div>
                                    <input type="checkbox" id="approval" name="approval" />
                                    <p>Approval</p>
                                </div>
                                <div>
                                    <input type="checkbox" id="disapproval" name="disapproval" />
                                    <p>Disapproval</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <b><u>JUAN ANTONIO Z. VILLALUZ, Ph.D</u></b>
                            <i>President</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box instruction-box">
                    <div>
                        <p>Instructions:</p>
                        <p>
                            1. Application fo VACATION LEAVE shall be filed in
                            advice, or whenever possible, three (3) days before
                            going such leave.
                        </p>
                        <p>
                            2. Application fo SICK LEAVE exceeding three (3)
                            days shall be accompanied by medical certificate and
                            shall be filled after the sick of employee.
                        </p>
                        <p>
                            3. Application fo LEAVE OF ABSENCE for thirty (30)
                            days or more shall be accomplished by a clearance
                            from money and property accountability.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- EMPLOYEE COPY -->
        <section>
            <div class="banner">
                <img src="images/southland_banner.png" alt="Southland College">
            </div>
            <div class="container">
                <h2>
                    Application for Leave of Absence
                    <span>Employee Copy</span>
                </h2>
                <div class="box application-box">
                    <div class="box-left">
                        <div>
                            <p>Date of Filing: <span>2021-06-24</span></p>
                            <p>Name: <span><?php echo $name ?></span></p>
                            <p>Department: <span><?php echo $department ?></span></p>
                            <p>Designation: <span>Staff</span></p>
                        </div>
                        <div>
                            <b><?php echo $name ?></b>
                            <input type="text" />
                            <i>Signature of Application</i>
                        </div>
                    </div>
                    <div class="box-right">
                        <div>
                            <p>
                                Leave Applied for: <span><?php echo $leave_type ?></span>
                            </p>
                            <p>
                                Inclusive Date/s:
                                <span>From: <?php echo $from_date ?> To:<?php echo $to_date ?></span>
                            </p>
                            <p>No. of Day/s: <span><?php echo $total_days ?></span></p>
                        </div>
                        <div>
                            <div class="approval">
                                <p>ACTION (By Authorized Official):</p>
                                <div>
                                    <input type="checkbox" id="approval" name="approval" />
                                    <p>Approval</p>
                                </div>
                                <div>
                                    <input type="checkbox" id="disapproval" name="disapproval" />
                                    <p>Disapproval</p>
                                </div>
                            </div>
                            <input type="text" />
                            <i>Immediate Supervisor</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Certification of Leave Credits</h2>
                <div class="box certification-box">
                    <div class="box-left">
                        <div>
                            <p>Leave Credits as of: <span>2021-06-24</span></p>
                            <p>
                                Reason:
                                <span><?php echo $reason ?></span>
                            </p>
                            <p>Balance: <span><?php echo $leave_balance ?></span></p>
                        </div>
                    </div>
                    <div class="box-right">
                        <div>
                            <input type="text" />
                            <i>HR Personnel</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h2>Recommending Approval:</h2>
                <div class="box recommend-box">
                    <div class="box-left">
                        <div>
                            <div>
                                <span>For:</span>
                                <input type="text" />
                                <span>days with pay</span>
                            </div>
                            <div>
                                <span>For:</span>
                                <input type="text" />
                                <span>days without pay</span>
                            </div>
                        </div>
                        <div>
                            <input type="text" />
                            <i>Division Head</i>
                        </div>
                    </div>
                    <div class="box-right">
                        <div>
                            <div><span>Date: </span><input type="text" /></div>
                            <div class="approval">
                                <div>
                                    <input type="checkbox" id="approval" name="approval" />
                                    <p>Approval</p>
                                </div>
                                <div>
                                    <input type="checkbox" id="disapproval" name="disapproval" />
                                    <p>Disapproval</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <b><u>JUAN ANTONIO Z. VILLALUZ, Ph.D</u></b>
                            <i>President</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box instruction-box">
                    <div>
                        <p>Instructions:</p>
                        <p>
                            1. Application fo VACATION LEAVE shall be filed in
                            advice, or whenever possible, three (3) days before
                            going such leave.
                        </p>
                        <p>
                            2. Application fo SICK LEAVE exceeding three (3)
                            days shall be accompanied by medical certificate and
                            shall be filled after the sick of employee.
                        </p>
                        <p>
                            3. Application fo LEAVE OF ABSENCE for thirty (30)
                            days or more shall be accomplished by a clearance
                            from money and property accountability.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        window.onload = window.print
        window.onafterprint = function() {
            window.close();
        }
    </script>
</body>

</html>