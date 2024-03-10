<?php
  
  $employee_tbl_array = [$employee_id, $fname, $mname, $lname, $birthdate, $birthplace, $sex, $bloodtype, $civilstatus, $tin_id, $citizenship, $sss_no, $pagibig_no, $philhealth_no, $height, $weight, $residential_address, $permanent_address, $email, $contact_number];
  insertData($conn, 'employee_tbl', $employeeData);

  $resedential_address_array = [
    "employee_id" => $employee_id,
    "barangay" => $res_barangay,
    "municipality_city" => $res_city,
    "province" => $res_province,
  ];
  insertDataColumns($conn, 'resedential_address_tbl', $resedential_address_array);

  $permananent_address_array = [
    "employee_id" => $employee_id,
    "barangay" => $per_barangay,
    "municipality_city" => $per_city,
    "province" => $per_province,
  ];
  insertDataColumns($conn, "permanent_address_tbl", $permananent_address_array);

  $pob_array = [
    'employee_id' => $employee_id,
    'barangay' => $pob_barangay,
    "municipality_city" => $pob_city,
    "province" => $pob_province,
  ];
  insertDataColumns($conn, 'place_of_birth_tbl', $pob_array);

  $fathers_info_array = [
    'employee_id' => $employee_id,
    'fname' => $father_fname,
    'mname' => $father_mname,
    'lname' => $father_lname
  ];
  insertDataColumns($conn, 'fathers_name', $fathers_info_array);

  $mothers_info_array = [
    'employee_id' => $employee_id,
    'fname' => $mother_fname,
    'mname' => $mother_mname,
    'lname' => $mother_lname
  ];
  insertDataColumns($conn, 'mothers_name', $mothers_info_array);

  $elementary_array = [
    'employee_id' => $employee_id,
    'schoolname' => $elem_school,
    'address' => $elem_address,
    'year_graduate' => $elem_year,
  ];
  insertDataColumns($conn, 'elementary_tbl', $elementary_array);

  $highschool_array = [
    'employee_id' => $employee_id,
    'schoolname' => $hs_schol,
    'address' => $hs_address,
    'course' => $hs_course,
    'year_graduate' => $hs_year,
  ];
  insertDataColumns($conn, 'highschool_tbl', $highschool_array);

  $vocational_array = [
    'employee_id' => $employee_id,
    'schoolname' => $vocational_school,
    'address' => $vocational_address,
    'course' => $vocational_course,
    'year_graduate' => $vocational_year,
  ];
  insertDataColumns($conn, 'vocational_tbl', $vocational_array);

  $college_array = [
    'employee_id' => $employee_id,
    'schoolname' => $college_school,
    'address' => $college_address,
    'course' => $college_course,
    'year_graduate' => $college_year,
  ];
  insertDataColumns($conn, 'college_tbl', $college_array);

  $graduate_array = [
    'employee_id' => $employee_id,
    'schoolname' => $graduate_school,
    'address' => $graduate_address,
    'course' => $graduate_course,
    'year_graduate' => $graduate_year,
  ];
  insertDataColumns($conn, 'graduate_tbl', $graduate_array);

?>