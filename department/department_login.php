<?php

global $id;
session_name('departmentSession');
session_start();
require_once "./includes/auth.php";
include './includes/connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="w-full h-screen flex justify-center items-center bg-[#e6f1ff]">
        <div class="bg-white rounded-2xl flex flex-col md:justify-around items-center py-14 md:px-10 md:py-24 gap-8 md:gap-14 w-full max-w-sm md:max-w-4xl mx-4 md:mx-10 shadow-md md:shadow-2xl md:flex-row">
            <div class="w-[17rem] hidden md:block">
                <img class="w-full object-cover object-center" src="images/login-img.svg" alt="login image">
            </div>
            <div class="flex flex-col items-center gap-6 w-full md:w-auto px-4">
                <?php

                include_once "./includes/auth.php";

                if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    
                    if (deptloginAuth($username, $password)) {
                        header('location: index.php');
                    } else {
                        echo "<span class='w-full bg-red-500 text-center py-3 text-white'>Invalid Credentials</span>";
                    }
                }

                ?>
                <h1 class="text-3xl md:text-4xl font-semibold text-[#101010] md:mb-6">Login</h1>
                <div class="mb-4 md:hidden">
                    <img class="w-[9rem] max-h-full" src="./images/login-img.svg" alt="login image">
                </div>
                <form method="POST" class="flex flex-col gap-4 w-full max-w-[18rem] md:w-[18rem]">
                    <input name="username" id="username" class="px-4 py-2 border border-[#303030] w-full text-sm" type="text" placeholder="Username" autofocus>
                    <input name="password" id="password" class="px-4 py-2 border border-[#303030] w-full text-sm" type="password" placeholder="Password">
                    <button type="submit" name="submit" class="bg-[#4763ca] w-full px-4 py-2 text-white shadow-sm mt-2">Login</button>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>