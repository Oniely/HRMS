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

function updateDatae($conn, $table, $id, $newData)
{
    $setClause = "";
    foreach ($newData as $column => $value) {
        $setClause .= "$column = '$value', ";
    }

    $setClause = rtrim($setClause, ', ');
    $sql = "UPDATE $table SET $setClause WHERE id = $id";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return $result;
}

function updateDataEmployee($conn, $id, $newData)
{
    $setClause = "";
    foreach ($newData as $column => $value) {
        $setClause .= "$column = '$value', ";
    }

    $setClause = rtrim($setClause, ', ');
    $sql = "UPDATE employee_tbl SET $setClause WHERE employee_id = $id";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return $result;
}

function updateDataFaculty($conn, $id, $newData)
{
    $setClause = "";
    foreach ($newData as $column => $value) {
        $setClause .= "$column = '$value', ";
    }

    $setClause = rtrim($setClause, ', ');
    $sql = "UPDATE faculty_tbl SET $setClause WHERE faculty_id = $id";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return $result;
}



function redirect($url)
{
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $url . '";';
    echo '</script>';
    exit;
}

function saveProfileImage($photoFieldName = 'photo', $targetDirectory = 'images/profiles')
{
    // Ensure the target directory exists and is writable.
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    // Check if the photo is uploaded with no error.
    if (isset($_FILES[$photoFieldName]) && $_FILES[$photoFieldName]['error'] == 0) {
        $imageFile = $_FILES[$photoFieldName];

        // Security measure: generate a new filename.
        // Here, using a combination of a unique ID and the original file extension.
        $fileExtension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
        $filename = uniqid('photo_', true) . '.' . $fileExtension;

        // Complete path for the image to be saved.
        $targetFilePath = $targetDirectory . '/' . $filename;

        // Validate the file is an image.
        $check = getimagesize($imageFile['tmp_name']);
        if ($check !== false) {
            // Move the uploaded file to the target directory.
            if (move_uploaded_file($imageFile['tmp_name'], $targetFilePath)) {
                // Return the full path of the saved image.
                return $targetFilePath;
            } else {
                // "There was an error uploading the file."
                return false;
            }
        } else {
            //  "The file is not an image."
            return false;
        }
    } else {
        //  "No file was uploaded or an upload error occurred."
        return false;
    }
}

function resetForm()
{
    ?>
    <script>
        const formInputs = document.querySelectorAll('input, select');

        formInputs.forEach(input => {
            localStorage.removeItem(input.id)
        })
    </script>
    <?php
}