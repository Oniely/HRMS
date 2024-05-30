<?php
session_name('departmentSession');
session_start();
session_unset();
session_destroy();
echo "<script>alert('Logged out successfully');
 window.location.href='../department_login.php';
 </script>";
?>