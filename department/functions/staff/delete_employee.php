<?php 
    include('../../includes/connection.php')
?>
<?php 
    // session_start();
    // if (!isset($_SESSION['id']) || (trim ($_SESSION['id']) == '')) {
    //     header('location:../user.php');
    //     exit();
    // }
?>
<?php 
if(isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "DELETE FROM `employee_tbl` WHERE `employee_id`=$id";
    $conn->query($sql);

}
echo '<script>alert("Data Deleted Successfully")</script>';
header("location: ../../all_staff.php");
?>
`