<?php

session_start();
require_once "includes/auth.php";
include 'includes/connection.php';

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
    <main>

        <form method="POST" class="container">
            <img class="img" src="images/login-img.svg" alt="">
            <div class="container1">
                <h1>Login</h1>
                <?php

                include_once "./includes/auth.php";

                if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $passw = $_POST['password'];

                    if (loginAuth($username, $passw)) {
                        header('location: index.php');
                    } else {
                        echo "<span class='err'>Credentials Incorrect.</span>";
                    }
                }

                ?>
                <input type="text" name="username" id="username" placeholder="Username" autofocus>
                <input type="password" name="password" id="password" placeholder="Password">

                <div class="remember"><input type="checkbox"> Remember me</div>

                <input class="btn" type="submit" name="submit" value="Login">
            </div>
        </form>
    </main>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>