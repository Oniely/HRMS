<!DOCTYPE html>
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

<body class="min-h-screen py-10">
    <main class="w-full h-screen flex justify-center items-center py-10">
        <div class="container max-w-[25rem] border border-[#101010] flex flex-col items-center py-[1.5rem] shadow-lg">
            <div class="w-[8rem] mb-[1.5rem] md:mb-[1rem]">
                <img class="w-full h-full object-cover" src="./img/nechma_logo.svg" alt="" />
            </div>
            <form method="POST" id="signUpForm" class="w-full h-full flex flex-col items-center gap-[1.2rem] md:gap-[15px] text-[14px] text-[#101010]">
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="fname">First Name</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2" type="text" name="fname" id="fname" placeholder="Your First Name" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="lname">Last Name</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2" type="text" name="lname" id="lname" placeholder="Your Last Name" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="contact">Contact Number</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2" type="text" name="contact" id="contact" placeholder="Your Contact Number" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="username">Username</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2" type="text" name="username" id="username" placeholder="Your Username" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="password">Password</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2 relative" type="password" name="password" id="password" placeholder="Your Password">
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                    <img data-visibility="invisible" class="password_visibility absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_invisible.png" alt="invisible">
                    <img data-visibility="visible" class="password_visibility hidden absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_visible.png" alt="visible">
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="confirmPass">Confirm Password</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2 relative" type="password" name="confirmPass" id="confirmPass" placeholder="Your Password">
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                    <img data-visibility="invisible" class="password_visibility absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_invisible.png" alt="invisible">
                    <img data-visibility="visible" class="password_visibility hidden absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_visible.png" alt="visible">

                </div>
                <div class="w-full max-w-[18rem] text-center">
                    <input class="w-full bg-[#101010] py-2 mb-2  text-white font-semibold cursor-pointer" type="submit" name="submit" value="Sign Up">
                    <?php

                    require "includes/auth.php";

                    if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === "POST") {
                        $fname = $_POST["fname"];
                        $lname = $_POST["lname"];
                        $contact = $_POST["contact"];
                        $username = $_POST["username"];
                        $password = $_POST["password"];

                        if (signUpAuth($fname, $lname, $contact, $username, $password)) {
                            header('location: login.php');
                        } else {
                            echo '<p class="text-xs text-[#ff0000] hidden">
                        Account already exists.
                    </p>';
                        }
                    }

                    ?>
                    <span class="underline text-[12px] font-semibold">Already have an account? <a class="text-blue-800" href="login.php">Log in</a></span>
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