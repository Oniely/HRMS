<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
include('connection.php');

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

function updateAdmin($conn, $table, $id, $newData)
{
    $setClause = "";
    foreach ($newData as $column => $value) {
        $setClause .= "$column = '$value', ";
    }

    $setClause = rtrim($setClause, ', ');
    $sql = "UPDATE $table SET $setClause WHERE admin_id = $id";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    return $result;
}

function insertLeaveEmployee($conn, $table, $insertdata) {
    $keys = implode(", ", array_keys($insertdata));
    $placeholders = implode(", ", array_fill(0, count($insertdata), "?"));

    $values = array_values($insertdata);

    $stmt = $conn->prepare("INSERT INTO $table ($keys) VALUES ($placeholders)");
    $stmt->bind_param(str_repeat("s", count($values)), ...$values);

    $result = $stmt->execute();

    $stmt->close();

    if ($result) {
        echo "<script>alert('Leave Applied')</script>";
        echo '<script>window.location.href = window.location.href;</script>';
    }

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

function updateEmployee($conn, $table, $id, $newData)
{
    $setClause = "";
    foreach ($newData as $column => $value) {
        $setClause .= "$column = '$value', ";
    }

    $setClause = rtrim($setClause, ', ');
    $sql = "UPDATE $table SET $setClause WHERE employee_id = $id";

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
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    if (isset($_FILES[$photoFieldName]) && $_FILES[$photoFieldName]['error'] == 0) {
        $imageFile = $_FILES[$photoFieldName];

        $fileExtension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
        $filename = uniqid('photo_', true) . '.' . $fileExtension;

        $targetFilePath = $targetDirectory . '/' . $filename;

        $check = getimagesize($imageFile['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($imageFile['tmp_name'], $targetFilePath)) {
                return "/hrms/admin/" . $targetFilePath;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function querySelectAll($conn, $sql)
{
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    if (count($rows) > 0) {
        return $rows;
    } else {
        return null;
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