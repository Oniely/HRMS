<?php

global $conn;

session_start();

if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) {
    header('location:login.php');
    exit();
}
// if (isset($_SESSION['admin_id'])) {
//     $admin_id = $_SESSION['admin_id'];
//     $admin_fname = $_SESSION['fname'];
//     $admin_lname = $_SESSION['lname'];
// }

require 'includes/connection.php';
require 'includes/query.php';

if (isset($_POST['add']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $form = array();

    $formFields = [
        'employee_id', 'fname', 'mname', 'lname', 'email',
        'contactnumber', 'birthdate', 'sex', 'civilstatus', 'citizenship',
        'height', 'weight', 'bloodtype', 'tin_id', 'sss_no', 'philhealth_no',
        'pagibig_no', 'photo', 'pob_barangay', 'pob_city', 'pob_province',
        'res_barangay', 'res_city', 'res_province', 'per_barangay', 'per_city',
        'per_province', 'father_fname', 'father_mname', 'father_lname',
        'mother_fname', 'mother_mname', 'mother_lname', 'elem_address',
        'elem_year', 'elem_school', 'hs_school', 'hs_address', 'hs_year',
        'hs_course', 'vocational_school', 'vocational_address', 'vocational_course', 'vocational_year',
        'college_school', 'college_year', 'college_course', 'college_address',
        'graduate_school', 'graduate_address', 'graduate_course', 'graduate_year'
    ];

    foreach ($formFields as $fieldName) {
        $form[$fieldName] = isset($_POST[$fieldName]) ? $_POST[$fieldName] : null;
    }

    $birthplace = $form['pob_barangay'] . ', ' . $form['pob_city'] . ', ' . $form['pob_province'];
    $residential_address = $form['res_barangay'] . ", " . $form['res_city'] . ", " . $form['res_province'];
    $permanent_address = $form['per_barangay'] . ", " . $form['per_city'] . ", " . $form['per_province'];

    $sql_check = "SELECT * FROM employee_tbl WHERE employee_id = '$form[employee_id]'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo '<script>alert("The employee ID already exists. Please use a different ID.")</script>';
    } else {
        $employee_tbl_array = [
            "employee_id" => $form['employee_id'],
            "fname" => $form['fname'],
            "mname" => $form['mname'],
            "lname" => $form['lname'],
            "date_of_birth" => $form['birthdate'],
            "place_of_birth" => $birthplace,
            "sex" => $form['sex'],
            "blood_type" => $form['bloodtype'],
            "civil_status" => $form['civilstatus'],
            "tin_id" => $form['tin_id'],
            "citizenship" => $form['citizenship'],
            "sss_no" => $form['sss_no'],
            "pagibig_no" => $form['pagibig_no'],
            "philhealth_no" => $form['philhealth_no'],
            "height" => $form['height'],
            "weight" => $form['weight'],
            "residential_address" => $residential_address,
            "permanent_address" => $permanent_address,
            "email" => $form['email'],
            "contact_number" => $form['contactnumber'],
            "photo_path" => saveProfileImage()
        ];
        insertDataColumns($conn, 'employee_tbl', $employee_tbl_array);

        $resedential_address_array = [
            "employee_id" => $form['employee_id'],
            "barangay" => $form['res_barangay'],
            "municipality_city" => $form['res_city'],
            "province" => $form['res_province'],
        ];
        insertDataColumns($conn, 'resedential_address_tbl', $resedential_address_array);

        $permananent_address_array = [
            "employee_id" => $form['employee_id'],
            "barangay" => $form['per_barangay'],
            "municipality_city" => $form['per_city'],
            "province" => $form['per_province'],
        ];
        insertDataColumns($conn, "permanent_address_tbl", $permananent_address_array);

        $pob_array = [
            'employee_id' => $form['employee_id'],
            'barangay' => $form['pob_barangay'],
            "municipality_city" => $form['pob_city'],
            "province" => $form['pob_province'],
        ];
        insertDataColumns($conn, 'place_of_birth_tbl', $pob_array);

        $fathers_info_array = [
            'employee_id' => $form['employee_id'],
            'fname' => $form['father_fname'],
            'mname' => $form['father_mname'],
            'lname' => $form['father_lname']
        ];
        insertDataColumns($conn, 'fathers_name', $fathers_info_array);

        $mothers_info_array = [
            'employee_id' => $form['employee_id'],
            'fname' => $form['mother_fname'],
            'mname' => $form['mother_mname'],
            'lname' => $form['mother_lname']
        ];
        insertDataColumns($conn, 'mothers_name', $mothers_info_array);

        $elementary_array = [
            'employee_id' => $form['employee_id'],
            'schoolname' => $form['elem_school'],
            'address' => $form['elem_address'],
            'year_graduate' => $form['elem_year'],
        ];
        insertDataColumns($conn, 'elementary_tbl', $elementary_array);

        $highschool_array = [
            'employee_id' => $form['employee_id'],
            'schoolname' => $form['hs_school'],
            'address' => $form['hs_address'],
            'course' => $form['hs_course'],
            'year_graduate' => $form['hs_year'],
        ];
        insertDataColumns($conn, 'highschool_tbl', $highschool_array);

        $vocational_array = [
            'employee_id' => $form['employee_id'],
            'schoolname' => $form['vocational_school'],
            'address' => $form['vocational_address'],
            'course' => $form['vocational_course'],
            'year_graduate' => $form['vocational_year'],
        ];
        insertDataColumns($conn, 'vocational_tbl', $vocational_array);

        $college_array = [
            'employee_id' => $form['employee_id'],
            'schoolname' => $form['college_school'],
            'address' => $form['college_address'],
            'course' => $form['college_course'],
            'year_graduate' => $form['college_year'],
        ];
        insertDataColumns($conn, 'college_tbl', $college_array);

        $graduate_array = [
            'employee_id' => $form['employee_id'],
            'schoolname' => $form['graduate_school'],
            'address' => $form['graduate_address'],
            'course' => $form['graduate_course'],
            'year_graduate' => $form['graduate_year'],
        ];
        insertDataColumns($conn, 'graduate_tbl', $graduate_array);

        echo '<script>alert("Employee Added")</script>';
        redirect('/HRMS/admin/all_staff.php');
    }
    resetForm();
    $conn->close();
}


$active = "add staff";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/nav.css"/>
    <link rel="stylesheet" href="styles/add.css"/>
    <!-- Scripts -->
    <script src="script/burger.js" defer></script>
    <script src="script/dropdown.js" defer></script>
    <script src="script/form_autosave.js" defer></script>
    <!-- CDN's -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<!-- Side Bar -->
<?php require 'partials/aside.php' ?>
<!-- Navbar -->
<?php require 'partials/nav.php' ?>
<!-- Dashboard -->
<section class="dashboard-container">
    <div class="content-title">
        <h3>Add Staff</h3>
    </div>
    <form class="f-container" method="post" enctype="multipart/form-data">
        <div class="f-section">
            <div class="f-title">
                <h1>Personal Information</h1>
                <div class="hr"></div>
            </div>
            <div class="f-inputs px-0">
                <div class="relative z-0">
                    <input type="text" name="employee_id" id="employee_id"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="employee_id"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Employee
                        ID</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="fname" id="fname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="fname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">First
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="mname" id="mname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="mname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Middle
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="lname" id="lname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="lname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Last
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="email" name="email" id="email"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="email"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email
                        Address</label>
                </div>
                <div class="relative z-0">
                    <input type="number" name="contactnumber" id="contactnumber"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="contactnumber"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Phone
                        Number</label>
                </div>
                <div class="relative z-0">
                    <input type="date" name="birthdate" id="dob"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="dob"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Date
                        of Birth</label>
                </div>
                <div class="relative z-0">
                    <select type="text" name="sex" id="sex"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] text-black focus:outline-none focus:ring-0 peer"
                            placeholder=" " required>
                        <option value="" selected hidden>Select sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                    <label for="sex"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Sex</label>
                </div>
                <div class="relative z-0">
                    <select type="text" name="civilstatus" id="civilStatus"
                            class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] text-black focus:outline-none focus:ring-0 peer"
                            placeholder=" " required>
                        <option value="" selected hidden>Select status</option>
                        <option value="Male">Single</option>
                        <option value="Female">Married</option>
                        <option value="Seperated">Seperated</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                    <label for="civilStatus"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Civil
                        Status</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="citizenship" id="citizenship"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="citizenship"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Citizenship</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="height" id="height"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="height"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Height
                        (cm)</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="weight" id="weight"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="weight"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Weight
                        (kg)</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="bloodtype" id="bloodtype"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="bloodtype"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Bloodtype</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="tin_id" id="tin_id"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="tin_id"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Tin
                        ID</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="sss_no" id="sss_no"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="sss_no"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">SSS
                        No.</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="philhealth_no" id="philhealth_no"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="philhealth_no"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">PhilHealth
                        No.</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="pagibig_no" id="pagibig_no"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="pagibig_no"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Pag-ibig
                        No.</label>
                </div>
                <div class="relative z-0 -mt-1">
                    <input type="file" name="photo" id="photo"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="photo"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Photo</label>
                </div>
                <div class="text-xl col-span-2">
                    Place of Birth :
                </div>
                <div class="relative z-0">
                    <input type="text" name="pob_barangay" id="pob_brgy"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="pob_brgy"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Barangay</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="pob_city" id="pob_city"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="pob_city"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">City</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="pob_province" id="pob_province"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="pob_province"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                </div>

                <div class="text-xl col-span-2">
                    Residential Address :
                </div>
                <div class="relative z-0">
                    <input type="text" name="res_barangay" id="res_brgy"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="res_brgy"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Street/Barangay</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="res_city" id="res_city"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="res_city"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Municipality/City</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="res_province" id="res_province"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="res_province"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                </div>

                <div class="text-xl col-span-2">
                    Permanent Address :
                </div>
                <div class="relative z-0">
                    <input type="text" name="per_barangay" id="perma_brgy"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="perma_brgy"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Street/Barangay</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="per_city" id="perma_city"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="perma_city"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Municipality/City</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="per_province" id="perma_province"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="perma_province"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Province</label>
                </div>
            </div>
        </div>
        <div class="f-section mt-20">
            <div class="f-title">
                <h1>Family Background</h1>
                <div class="hr"></div>
            </div>
            <div class="f-inputs px-0">
                <div class="ml-1 text-lg col-span-2">Father:</div>
                <div class="relative z-0">
                    <input type="text" name="father_fname" id="father_fname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="father_fname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's
                        First Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="father_mname" id="father_mname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="father_mname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's
                        Middle Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="father_lname" id="father_lname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="father_lname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Father's
                        Last Name</label>
                </div>
            </div>
            <div class="f-inputs px-0">
                <div class="ml-1 text-lg col-span-2">Mother:</div>
                <div class="relative z-0">
                    <input type="text" name="mother_fname" id="mother_fname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="mother_fname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's
                        First Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="mother_mname" id="mother_mname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="mother_mname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's
                        Middle Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="mother_lname" id="mother_lname"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " required/>
                    <label for="mother_lname"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Mother's
                        Last Name</label>
                </div>
            </div>
        </div>
        <div class="f-section mt-20">
            <div class="f-title">
                <h1>Educational Background</h1>
                <div class="hr"></div>
            </div>
            <div class="f-inputs px-0">
                <div class="text-xl col-span-2">
                    Elementary :
                </div>
                <div class="relative z-0">
                    <input type="text" name="elem_school" id="elem_school"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="elem_school"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="elem_address" id="elem_address"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="elem_address"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                </div>
                <div class="relative z-0">
                    <input type="date" name="elem_year" id="elem_year"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="elem_year"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year
                        Graduate</label>
                </div>
            </div>
            <div class="f-inputs px-0">
                <div class="text-xl col-span-2">
                    High School :
                </div>
                <div class="relative z-0">
                    <input type="text" name="hs_school" id="hs_school"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="hs_school"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="hs_address" id="hs_address"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="hs_address"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="hs_course" id="hs_course"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="hs_course"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Course</label>
                </div>
                <div class="relative z-0">
                    <input type="date" name="hs_year" id="hs_year"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="hs_year"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year
                        Graduate</label>
                </div>
            </div>
            <div class="f-inputs px-0">
                <div class="text-xl col-span-2">
                    Vocational :
                </div>
                <div class="relative z-0">
                    <input type="text" name="vocational_school" id="vocational_school"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="vocational_school"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="vocational_address" id="vocational_address"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="vocational_address"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="vocational_course" id="vocational_course"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="vocational_course"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Course</label>
                </div>
                <div class="relative z-0">
                    <input type="date" name="vocational_year" id="vocational_year"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="vocational_year"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year
                        Graduate</label>
                </div>
            </div>
            <div class="f-inputs px-0">
                <div class="text-xl col-span-2">
                    College :
                </div>
                <div class="relative z-0">
                    <input type="text" name="college_school" id="college_school"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="college_school"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="college_address" id="college_address"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="college_address"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="college_course" id="college_course"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="college_course"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Course</label>
                </div>
                <div class="relative z-0">
                    <input type="date" name="college_year" id="college_year"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="college_year"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year
                        Graduate</label>
                </div>
            </div>
            <div class="f-inputs px-0">
                <div class="text-xl col-span-2">
                    Graduate School :
                </div>
                <div class="relative z-0">
                    <input type="text" name="graduate_school" id="graduate_school"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="graduate_school"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">School
                        Name</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="graduate_address" id="graduate_address"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="graduate_address"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Address</label>
                </div>
                <div class="relative z-0">
                    <input type="text" name="graduate_course" id="graduate_course"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="graduate_course"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Course</label>
                </div>
                <div class="relative z-0">
                    <input type="date" name="graduate_year" id="graduate_course"
                           class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b border-[#9d9d9d] appearance-none text-black focus:outline-none focus:ring-0 peer"
                           placeholder=" " />
                    <label for="graduate_course"
                           class="absolute text-[#9d9d9d] font-medium duration-300 transform -translate-y-6 scale-75 -top-3 -left-4 -z-10 origin-[0] peer-focus:-left-4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-95 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Year
                        Graduate</label>
                </div>
            </div>
        </div>
        <div class="btns">
            <input type="submit" name="add" value="Add Staff">
            <a href="javascript:history.back()">Cancel</a>
        </div>
    </form>
</section>
</body>
<?php include "includes/form_reset.php" ?>

</html>