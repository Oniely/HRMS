<?php
include('../../includes/connection.php');

if ($_GET['faculty']) {
    $faculty_id = $_GET['faculty_id'];
} elseif ($_GET['employee']) {
    $employee_id = $_GET['employee_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['faculty_id'])) {
    if ($_GET['faculty']) {
        $query = "SELECT * FROM faculty_tbl WHERE faculty_id = $faculty_id";
    } elseif ($_GET['employee']) {
        $query = "SELECT * FROM employee_id WHERE employee_id = $employee_id";
    }
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $faculty_id = $_GET['faculty_id'];
        $fname = $row['fname'];
        $mname = $row['mname'];
        $lname = $row['lname'];
        $birthdate = $row['date_of_birth'];
        $birthplace = $row['place_of_birth'];
        $sex = $row['sex'];
        $bloodtype = $row['blood_type'];
        $civilstatus = $row['civil_status'];
        $tin_id = $row['tin_id'];
        $citizenship = $row['citizenship'];
        $sss_no = $row['sss_no'];
        $pagibig_no = $row['pag-ibig_no'];
        $philhealth_no = $row['philhealth_no'];
        $height = $row['height'];
        $weight = $row['weight'];
        $residential_address = $row['residential_address'];
        $permanent_address = $row['permanent_address'];
        $email = $row['email'];
        $contact_number = $row['contact_number'];
        $photo = $row['photo_path'];
    } else {
        echo "No data found for the provided employee ID.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $faculty_id = $_POST['faculty_id'];

    $sqlQuery = "SELECT photo_path FROM faculty_tbl WHERE faculty_id = $faculty_id";
    $result = mysqli_query($conn, $sqlQuery);
    $photo_path_original = mysqli_fetch_assoc($result)['photo_path'];

    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $pob_barangay = $_POST['pob_barangay'];
    $pob_city = $_POST['pob_city'];
    $pob_province = $_POST['pob_province'];
    $birthplace = $pob_barangay . ", " . $pob_city . ", " . $pob_province;
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
    $res_barangay = $_POST['res_barangay'];
    $res_city = $_POST['res_city'];
    $res_province = $_POST['res_province'];
    $residential_address = $res_barangay . ", " . $res_city . ", " . $res_province;
    $per_barangay = $_POST['per_barangay'];
    $per_city = $_POST['per_city'];
    $per_province = $_POST['per_province'];
    $permanent_address = $per_barangay . ", " . $per_city . ", " . $per_province;
    $email = $_POST['email'];
    $contact_number = $_POST['contactnumber'];
    $father_fname = $_POST['father_fname'];
    $father_mname = $_POST['father_mname'];
    $father_lname = $_POST['father_lname'];
    $father_name = $father_fname . ", " . $father_mname . ", " . $father_lname;
    $mother_fname = $_POST['mother_fname'];
    $mother_mname = $_POST['mother_mname'];
    $mother_lname = $_POST['mother_lname'];
    $mother_name = $mother_fname . ", " . $mother_mname . ", " . $mother_lname;
    $photo_path = $photo_path_original;

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "../../images/profiles/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        } else {
            echo "<script>alert('DIRECTORY EXISTS')</script>";
        }

        $target_file = $target_dir . basename($_FILES['photo']['name']);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            $photo_path = "/hrms/admin/images/profiles/" . basename($_FILES['photo']['name']);
        } else {
            echo "<script>alert('NOT MOVED')</script>";
        }
    }

    if ($_GET['faculty']) {
        $sql = "UPDATE faculty_tbl SET fname='$fname', mname='$mname', lname='$lname', date_of_birth='$birthdate', place_of_birth='$birthplace', sex='$sex', blood_type='$bloodtype', civil_status='$civilstatus', tin_id='$tin_id', citizenship='$citizenship', sss_no='$sss_no', `pagibig_no`='$pagibig_no', philhealth_no='$philhealth_no', height='$height', weight='$weight', residential_address='$residential_address', permanent_address='$permanent_address', email='$email', contact_number='$contact_number', photo_path = '$photo_path' WHERE faculty_id='$faculty_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE resedential_address_tbl SET barangay='$res_barangay', municipality_city='$res_city', province='$res_province' WHERE employee_id='$faculty_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE permanent_address_tbl SET barangay='$per_barangay', municipality_city='$per_city', province='$per_province' WHERE employee_id='$faculty_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE place_of_birth_tbl SET barangay='$pob_barangay', municipality_city='$pob_city', province='$pob_province' WHERE employee_id='$faculty_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE fathers_name SET fname = '$father_fname', mname = '$father_mname', lname = '$father_lname' WHERE employee_id='$faculty_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in fathers_name :" . mysqli_error($conn);
        }
        $sql = "UPDATE mothers_name SET fname = '$mother_fname', mname = '$mother_mname', lname = '$mother_lname' WHERE employee_id='$faculty_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in fathers_name :" . mysqli_error($conn);
        }
    } elseif ($_GET['employee']) {
        $sql = "UPDATE employee_id SET fname='$fname', mname='$mname', lname='$lname', date_of_birth='$birthdate', place_of_birth='$birthplace', sex='$sex', blood_type='$bloodtype', civil_status='$civilstatus', tin_id='$tin_id', citizenship='$citizenship', sss_no='$sss_no', `pagibig_no`='$pagibig_no', philhealth_no='$philhealth_no', height='$height', weight='$weight', residential_address='$residential_address', permanent_address='$permanent_address', email='$email', contact_number='$contact_number', photo_path = '$photo' WHERE employee_id='$employee_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE resedential_address_tbl SET barangay='$res_barangay', municipality_city='$res_city', province='$res_province' WHERE employee_id='$employee_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE permanent_address_tbl SET barangay='$per_barangay', municipality_city='$per_city', province='$per_province' WHERE employee_id='$employee_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE place_of_birth_tbl SET barangay='$pob_barangay', municipality_city='$pob_city', province='$pob_province' WHERE employee_id='$employee_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in employee_tbl: " . mysqli_error($conn);
        }
        $sql = "UPDATE fathers_name SET fname = '$father_fname', mname = '$father_mname', lname = '$father_lname' WHERE employee_id='$employee_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in fathers_name :" . mysqli_error($conn);
        }
        $sql = "UPDATE mothers_name SET fname = '$mother_fname', mname = '$mother_mname', lname = '$mother_lname' WHERE employee_id='$employee_id'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record in fathers_name :" . mysqli_error($conn);
        }
    }

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Data Updated Successfully")</script>';
        echo '<script>window.open("../../all_faculty.php","_self")</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
