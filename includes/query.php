<?php

// the $data takes in an object array: 
/* $data = [
  'column_name1' => 'column_value1',
  'column_name2' => 'column_value2',
  ...
]; */
function insertDataColumns($conn, $table, $data)
{
    $columns = implode(', ', array_keys($data));
    $values = "'" . implode("', '", $data) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return $result;
}

// the $data takes in an array:
// $data = [column_value1, column_value2, ...];
function insertData($conn, $table, $data)
{
    $values = "'" . implode("', '", $data) . "'";

    $sql = "INSERT INTO $table VALUES ($values)";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return $result;
}

function saveProfilePhoto($file)
{
    $file_path = '../images/profiles/';

    $save_path = $file_path . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $save_path);

    return $save_path;
}

function redirect($url)
{
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $url . '";';
    echo '</script>';
    exit;
}
