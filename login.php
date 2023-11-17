<?php

session_start();
session_regenerate_id();

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    header('location: index.php');
}

require_once "./includes/auth.php";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Southland College</title>
    <!-- Styles -->
    <link rel="stylesheet" href="styles/main.css">
    <!-- Scripts -->
    <script src="script/auth.js" defer></script>
    <!-- CDNs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-white">
    <main class="w-full h-screen flex justify-center items-center px-5">
        <div class="w-[25rem] border border-[#101010] flex flex-col items-center pt-[3rem] pb-[2rem] px-5 shadow-lg">
            <div class="w-[8rem] mb-[3rem]">
                <h1 class="text-5xl font-medium">Login</h1>
            </div>
            <form method="POST" class="w-full h-full flex flex-col items-center gap-[1.2rem] text-[14px] text-[#101010]">
                <?php

                include_once "./includes/auth.php";

                if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $passw = $_POST['password'];

                    if (loginAuth($username, $passw)) {
                        header('location: index.html');
                    } else {
                        echo "<span class='bg-red-400 p-4 w-[18rem] text-center'>Credentials Incorrect.</span>";
                    }
                }

                ?>
                <div class="w-full max-w-[18rem] flex flex-col">
                    <input class="w-full h-full border border-[#101010] px-[10px] py-3" type="text" name="username" id="username" placeholder="Username" />
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <input class="w-full h-full border border-[#101010] px-[10px] py-3 relative" type="password" name="password" id="password" placeholder="Password">
                    <img data-visibility="invisible" class="password_visibility absolute top-[0.7rem] right-[10px] cursor-pointer w-5 h-5" src="images/p_invisible.png" alt="invisible">
                    <img data-visibility="visible" class="password_visibility hidden absolute top-[0.7rem] right-[10px] cursor-pointer w-5 h-5" src="images/p_visible.png" alt="visible">
                    <div class="self-start mt-3 mb-[-8px] flex justify-center items-center gap-2 py-1">
                        <input type="checkbox" name="remember" id="remember">
                        <a class="text-[12px] font-medium" href="">Remember me</a>
                    </div>
                </div>
                <div class="w-full max-w-[18rem] text-center">
                    <input class="w-full bg-[#101010] py-2 mb-2  text-white font-medium cursor-pointer mt-1 text-lg" type="submit" name="submit" value="Login">
                    <span class="underline text-[12px] font-semibold leading-10">Don't have an account yet? <a class="text-blue-800" href="signup.php">Sign Up</a></span>
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>