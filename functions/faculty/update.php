
<?php
include('../../includes/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['faculty_id'])) {
    $faculty_id = $_GET['faculty_id'];

    // Fetch data from the database
    $query = "SELECT * FROM faculty_tbl WHERE faculty_id = $faculty_id";
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
        $family_background = $row['family_background'];
    } else {
        echo "No data found for the provided employee ID.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $faculty_id = $_POST['faculty_id'];
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

    $sql = "UPDATE faculty_tbl SET ";
    $sql .= "fname = '$fname', mname = '$mname', lname = '$lname', ";
    $sql .= "date_of_birth = '$birthdate', place_of_birth = '$birthplace', ";
    $sql .= "sex = '$sex', blood_type = '$bloodtype', civil_status = '$civilstatus', ";
    $sql .= "`tin_id` = '$tin_id', citizenship = '$citizenship', `sss_no` = '$sss_no', ";
    $sql .= "`pag-ibig_no` = '$pagibig_no', `philhealth_no` = '$philhealth_no', ";
    $sql .= "`height` = '$height', `weight` = '$weight', ";
    $sql .= "residential_address = '$residential_address', ";
    $sql .= "permanent_address = '$permanent_address', ";
    $sql .= "email = '$email', `contact_number` = '$contact_number', ";
    $sql .= "`family_background` = '$family_background' ";
    $sql .= "WHERE faculty_id = $faculty_id";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Data Updated Successfully")</script>';
        echo '<script>window.open("../../all_faculty.php","_self")</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
