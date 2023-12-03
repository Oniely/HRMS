<?php

session_start();
require_once "./includes/auth.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/login.css">
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
                        header('location: index.html');
                    } else {
                        echo "<span class='err'>Credentials Incorrect.</span>";
                    }
                }

                ?>
                <input type="text" name="username" id="username" placeholder="Username">
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