<?php

global $active;
global $fname;
global $breadcrumbs;

if (isset($_SESSION['department_id'])) {
    $id = $_SESSION['department_id'];
    $query = "SELECT * FROM department_tbl WHERE department_id = $id";
    $query_res = mysqli_query($conn, $query);
    if ($query_res && mysqli_num_rows($query_res) > 0) {
        $row = mysqli_fetch_assoc($query_res);
        $department_id = $row['department_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $position = $row['position'];
        $contact = $row['contact'];
        $department = $row['department'];

        $_SESSION['department'] = $department;
    } else {
        echo "Department not found.";
    }
}

include('./includes/connection.php');
?>

<script src="https://cdn.tailwindcss.com"></script>
<script src="/hrms/admin/script/search.js" defer></script>

<nav class="navbar" id="navbar">
    <div class="left-nav">
        <button id="burger" class="burger">
            <img src="images/burger.svg" alt="" />
        </button>
        <div class="search-container">
            <input type="text" placeholder="Search" id="search-input" />
            <button>
                <img src="images/search.svg" alt="" />
            </button>
            <div class="absolute top-[2.3rem] left-0 w-[15rem] bg-white min-h-10 max-h-52 rounded-md hidden flex-col py-3 px-2 gap-2 overflow-y-auto overflow-x-hidden shadow-md" id="search-result-container">
            </div>
        </div>
    </div>
    <div class="right-nav">
        <a class="notification-btn" href="./notifications.php">
            <div class="notification-img-container">
                <img src="images/notification-bell.svg" alt="" class="white-svg" />
            </div>
            <div class="notification-count" id="notificationCount">

            </div>
        </a>
        <button class="profile-btn">
            <div class="profile-img-container">
                <img src="images/profile.svg" alt="" />
            </div>
            <span> <?= @$fname ?? "USER" ?> </span>
            <!-- Popup Menu -->
            <div class="profile-menu">
                <a href="about_department.php">
                    <div>
                        <img src="images/1.svg" alt="" />
                        <span>Profile</span>
                    </div>
                </a>
                <a href="about_staff.php?employee_id">
                    <div>
                        <img src="images/5.svg" alt="" />
                        <span>Setting</span>
                    </div>
                </a>
                <a href="">
                    <div>
                        <img src="images/3.svg" alt="" />
                        <span>Help</span>
                    </div>
                </a>
                <a href="./includes/logout.php">
                    <div>
                        <img src="images/arrow.svg" alt="" />
                        <span>Logout</span>
                    </div>
                </a>
            </div>
        </button>
    </div>
</nav>

<header class="m-header">
    <div class="m-logo">
        <a href="/HRMS/department/">
            <img src="images/sc-logo.svg" alt="sc-logo">
        </a>
    </div>
    <div class="m-right-nav">
        <a class="notification-btn" href="./notifications.php">
            <div class="notification-img-container">
                <img src="images/notification-bell.svg" alt="" class="white-svg" />
            </div>
            <div class="notification-count" id="notificationCount">
            </div>
        </a>
        <button id="m-burger" class="m-burger">
            <img id="m-burger-btn" src="images/burger.svg" alt="burger">
            <img id="m-x-burger-btn" src="images/x-burger.svg" alt="X">
        </button>
    </div>

    <div class="m-burger-menu">
        <div class="m-breadcrumbs">
            <?php
            if (isset($breadcrumbs) && is_array($breadcrumbs)) {
                foreach ($breadcrumbs as $key => $value) {
                    echo "<a href='$value'>$key</a>";
                }
            } else {
                echo "<a href='/HRMS/department/'>Home</a>";
            }
            ?>
        </div>

        <div class="m-search-container">
            <input type="text" placeholder="Search" />
            <button>
                <img src="images/search.svg" alt="" />
            </button>
        </div>

        <div class="m-profile" id="profile">
            <div class="profile-img-container">
                <a href="index.php"><img src="images/1.svg" alt="icon" /></a>
            </div>
            <div class="profile-info">
                <h1>Hello World!</h1>
                <h3>Administrator</h3>
            </div>
        </div>

        <ul class="m-links">
            <li>
                <a class="s-link <?= $active == "dashboard" ? "active" : "" ?>" href=" index.php">
                    <svg class="icon <?= $active == "dashboard" ? "active" : "" ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="500" preserveAspectRatio="xMidYMid meet" version="1.0">
                        <defs>
                            <clipPath id="6325d10b93">
                                <path d="M 0 43.125 L 375 43.125 L 375 287 L 0 287 Z M 0 43.125 " clip-rule="nonzero" />
                            </clipPath>
                            <clipPath id="1e1b69b5b5">
                                <path d="M 107 294 L 268 294 L 268 337.875 L 107 337.875 Z M 107 294 " clip-rule="nonzero" />
                            </clipPath>
                        </defs>
                        <g clip-path="url(#6325d10b93)">
                            <path d="M 343 286.007812 L 32 286.007812 C 14.355469 286.007812 0 271.652344 0 254.007812 L 0 75.59375 C 0 57.949219 14.355469 43.59375 32 43.59375 L 343 43.59375 C 360.644531 43.59375 375 57.949219 375 75.59375 L 375 254.007812 C 375 271.652344 360.644531 286.007812 343 286.007812 Z M 32 59.59375 C 23.179688 59.59375 16 66.769531 16 75.59375 L 16 254.007812 C 16 262.832031 23.179688 270.007812 32 270.007812 L 343 270.007812 C 351.820312 270.007812 359 262.832031 359 254.007812 L 359 75.59375 C 359 66.769531 351.820312 59.59375 343 59.59375 Z M 32 59.59375 " fill-opacity="1" fill-rule="nonzero" />
                        </g>
                        <g clip-path="url(#1e1b69b5b5)">
                            <path d="M 267.5 329.027344 C 267.5 333.4375 263.910156 337.027344 259.5 337.03125 C 259.5 337.03125 115.496094 337.03125 115.496094 337.03125 C 108.519531 337.195312 104.796875 328.132812 109.851562 323.382812 C 111.289062 321.925781 113.289062 321.027344 115.496094 321.027344 L 158.699219 321.027344 L 153.5625 294.003906 L 221.4375 294.003906 L 216.300781 321.027344 L 259.5 321.027344 C 263.917969 321.027344 267.5 324.613281 267.5 329.027344 Z M 267.5 329.027344 " fill-opacity="1" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <span class="link-name <?= $active == "dashboard" ? "active" : "" ?>">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="s-link <?= $active == "profile" ? "active" : "" ?>" href="about_department.php">
                    <svg class="icon <?= str_contains($active, "profile") ? "active" : "" ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="500" preserveAspectRatio="xMidYMid meet" version="1.0">
                        <defs>
                            <clipPath id="397a3b1a3c">
                                <path d="M 35.453125 0 L 337.703125 0 L 337.703125 375 L 35.453125 375 Z M 35.453125 0 " clip-rule="nonzero" />
                            </clipPath>
                        </defs>
                        <g clip-path="url(#397a3b1a3c)">
                            <path d="M 240.347656 184.542969 C 268.097656 166.734375 286.5625 135.667969 286.5625 100.332031 C 286.5625 45.148438 241.65625 0.246094 186.472656 0.246094 C 131.289062 0.246094 86.386719 45.148438 86.386719 100.332031 C 86.386719 135.6875 104.851562 166.734375 132.601562 184.542969 C 75.863281 206.300781 35.453125 261.296875 35.453125 325.597656 C 35.453125 352.695312 57.511719 374.753906 84.609375 374.753906 L 288.320312 374.753906 C 315.433594 374.753906 337.476562 352.695312 337.476562 325.597656 C 337.492188 261.296875 297.085938 206.300781 240.347656 184.542969 Z M 112.226562 100.332031 C 112.226562 59.398438 145.539062 26.089844 186.472656 26.089844 C 227.40625 26.089844 260.71875 59.398438 260.71875 100.332031 C 260.71875 141.265625 227.40625 174.578125 186.472656 174.578125 C 145.539062 174.578125 112.226562 141.265625 112.226562 100.332031 Z M 288.339844 348.910156 L 84.609375 348.910156 C 71.746094 348.910156 61.296875 338.445312 61.296875 325.597656 C 61.296875 256.578125 117.453125 200.421875 186.472656 200.421875 C 255.496094 200.421875 311.652344 256.578125 311.652344 325.597656 C 311.632812 338.445312 301.183594 348.910156 288.339844 348.910156 Z M 288.339844 348.910156 " fill-opacity="1" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <span class="link-name <?= $active == "profile" ? "active" : "" ?>">Profile</span>
                </a>
            </li>
            <li>
                <button class=" dropdown-btn">
                    <svg class="w-6 h-6 icon icon-leave <?= str_contains($active, 'data') ? 'active' : '' ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                    <span class="link-name <?= str_contains($active, "data") ? "active" : "" ?>">Data</span>
                    <img class=" arrow" src="images/arrow.svg" alt=">" />
                </button>
                <div class="dropdown-menu">
                    <a class="<?= str_contains($active, "department staff") ? "active" : "" ?>" href="department_staff.php">Employee</a>
                    <a class="<?= str_contains($active, "department faculty") ? "active" : "" ?>" href="department_faculty.php">Faculty</a>
                    <a class="<?= str_contains($active, "notification") ? "active" : "" ?>" href="./notifications.php">Notifications</a>
                </div>
            </li>
            <li>
                <a class="s-link <?= $active == "leave" ? "active" : "" ?>" href="all_leave.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-x">
                        <path d="M2 21a8 8 0 0 1 11.873-7" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="m17 17 5 5" />
                        <path d="m22 17-5 5" />
                    </svg>
                    <span class="link-name <?= $active == "leave" ? "active" : "" ?>">Leave</span>
                </a>
            </li>
            <li>
                <a class="s-link" href="#">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="500" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="500" preserveAspectRatio="xMidYMid meet" version="1.0">
                        <defs>
                            <clipPath id="2cd95ec2d4">
                                <path d="M 150 27.65625 L 225 27.65625 L 225 103 L 150 103 Z M 150 27.65625 " clip-rule="nonzero" />
                            </clipPath>
                            <clipPath id="5a1d3744c1">
                                <path d="M 300 272 L 375 272 L 375 347.15625 L 300 347.15625 Z M 300 272 " clip-rule="nonzero" />
                            </clipPath>
                        </defs>
                        <path d="M 366.714844 178.53125 C 368.894531 178.53125 370.984375 179.398438 372.523438 180.9375 C 374.0625 182.480469 374.929688 184.566406 374.929688 186.746094 C 374.929688 188.925781 374.0625 191.015625 372.523438 192.554688 C 370.984375 194.09375 368.894531 194.960938 366.714844 194.960938 L 68.152344 194.960938 C 65.980469 194.960938 63.890625 194.09375 62.34375 192.554688 C 60.804688 191.015625 59.9375 188.925781 59.9375 186.746094 C 59.9375 184.566406 60.804688 182.480469 62.34375 180.9375 C 63.890625 179.398438 65.980469 178.53125 68.152344 178.53125 Z M 366.714844 178.53125 " fill-opacity="1" fill-rule="nonzero" />
                        <path d="M 366.714844 55.375 C 368.894531 55.375 370.984375 56.242188 372.523438 57.78125 C 374.0625 59.320312 374.929688 61.410156 374.929688 63.589844 C 374.929688 65.769531 374.0625 67.863281 372.523438 69.398438 C 370.984375 70.9375 368.894531 71.804688 366.714844 71.804688 L 218.183594 71.804688 C 216.003906 71.804688 213.914062 70.9375 212.375 69.398438 C 210.835938 67.863281 209.96875 65.769531 209.96875 63.589844 C 209.96875 61.410156 210.835938 59.320312 212.375 57.78125 C 213.914062 56.242188 216.003906 55.375 218.183594 55.375 Z M 366.714844 55.375 " fill-opacity="1" fill-rule="nonzero" />
                        <path d="M 304.0625 301.6875 C 306.234375 301.6875 308.324219 302.554688 309.871094 304.089844 C 311.410156 305.636719 312.277344 307.71875 312.277344 309.902344 C 312.277344 312.082031 311.410156 314.171875 309.871094 315.710938 C 308.324219 317.25 306.234375 318.117188 304.0625 318.117188 L 8.414062 318.117188 C 6.238281 318.117188 4.148438 317.25 2.601562 315.710938 C 1.0625 314.171875 0.199219 312.082031 0.199219 309.902344 C 0.199219 307.71875 1.0625 305.636719 2.601562 304.089844 C 4.148438 302.554688 6.238281 301.6875 8.414062 301.6875 Z M 304.0625 301.6875 " fill-opacity="1" fill-rule="nonzero" />
                        <g clip-path="url(#2cd95ec2d4)">
                            <path d="M 150.199219 64.996094 C 150.199219 55.085938 154.136719 45.578125 161.140625 38.574219 C 168.144531 31.5625 177.65625 27.625 187.566406 27.625 C 197.476562 27.625 206.984375 31.5625 213.988281 38.574219 C 220.992188 45.578125 224.933594 55.085938 224.933594 64.996094 C 224.933594 74.902344 220.992188 84.410156 213.988281 91.414062 C 206.984375 98.425781 197.476562 102.363281 187.566406 102.363281 C 177.65625 102.363281 168.144531 98.425781 161.140625 91.414062 C 154.136719 84.410156 150.199219 74.902344 150.199219 64.996094 Z M 166.628906 64.996094 C 166.628906 59.445312 168.832031 54.113281 172.757812 50.1875 C 176.6875 46.265625 182.011719 44.054688 187.566406 44.054688 C 193.117188 44.054688 198.449219 46.265625 202.375 50.1875 C 206.296875 54.113281 208.507812 59.445312 208.507812 64.996094 C 208.507812 70.542969 206.296875 75.875 202.375 79.800781 C 198.449219 83.722656 193.117188 85.933594 187.566406 85.933594 C 182.011719 85.933594 176.6875 83.722656 172.757812 79.800781 C 168.832031 75.875 166.628906 70.542969 166.628906 64.996094 Z M 166.628906 64.996094 " fill-opacity="1" fill-rule="evenodd" />
                        </g>
                        <path d="M 0.0703125 186.777344 C 0.0703125 176.875 4.007812 167.359375 11.011719 160.355469 C 18.015625 153.351562 27.53125 149.40625 37.4375 149.40625 C 47.339844 149.40625 56.855469 153.351562 63.859375 160.355469 C 70.863281 167.359375 74.804688 176.875 74.804688 186.777344 C 74.804688 196.683594 70.863281 206.199219 63.859375 213.203125 C 56.855469 220.207031 47.339844 224.144531 37.4375 224.144531 C 27.53125 224.144531 18.015625 220.207031 11.011719 213.203125 C 4.007812 206.199219 0.0703125 196.683594 0.0703125 186.777344 Z M 16.5 186.777344 C 16.5 181.226562 18.703125 175.894531 22.628906 171.96875 C 26.558594 168.046875 31.882812 165.835938 37.4375 165.835938 C 42.988281 165.835938 48.320312 168.046875 52.246094 171.96875 C 56.167969 175.894531 58.378906 181.226562 58.378906 186.777344 C 58.378906 192.332031 56.167969 197.65625 52.246094 201.582031 C 48.320312 205.511719 42.988281 207.714844 37.4375 207.714844 C 31.882812 207.714844 26.558594 205.511719 22.628906 201.582031 C 18.703125 197.65625 16.5 192.332031 16.5 186.777344 Z M 16.5 186.777344 " fill-opacity="1" fill-rule="evenodd" />
                        <g clip-path="url(#5a1d3744c1)">
                            <path d="M 300.195312 309.929688 C 300.195312 300.023438 304.136719 290.515625 311.140625 283.511719 C 318.144531 276.5 327.660156 272.5625 337.5625 272.5625 C 347.46875 272.5625 356.984375 276.5 363.988281 283.511719 C 370.992188 290.515625 374.929688 300.023438 374.929688 309.929688 C 374.929688 319.839844 370.992188 329.347656 363.988281 336.351562 C 356.984375 343.363281 347.46875 347.300781 337.5625 347.300781 C 327.660156 347.300781 318.144531 343.363281 311.140625 336.351562 C 304.136719 329.347656 300.195312 319.839844 300.195312 309.929688 Z M 316.621094 309.929688 C 316.621094 304.382812 318.832031 299.050781 322.753906 295.121094 C 326.679688 291.203125 332.011719 288.992188 337.5625 288.992188 C 343.117188 288.992188 348.441406 291.203125 352.371094 295.121094 C 356.296875 299.050781 358.5 304.382812 358.5 309.929688 C 358.5 315.480469 356.296875 320.8125 352.371094 324.738281 C 348.441406 328.660156 343.117188 330.871094 337.5625 330.871094 C 332.011719 330.871094 326.679688 328.660156 322.753906 324.738281 C 318.832031 320.8125 316.621094 315.480469 316.621094 309.929688 Z M 316.621094 309.929688 " fill-opacity="1" fill-rule="evenodd" />
                        </g>
                        <path d="M 156.203125 55.375 C 158.375 55.375 160.46875 56.242188 162.011719 57.78125 C 163.550781 59.320312 164.417969 61.410156 164.417969 63.589844 C 164.417969 65.769531 163.550781 67.863281 162.011719 69.398438 C 160.46875 70.9375 158.375 71.804688 156.203125 71.804688 L 8.414062 71.804688 C 6.238281 71.804688 4.148438 70.9375 2.601562 69.398438 C 1.0625 67.863281 0.199219 65.769531 0.199219 63.589844 C 0.199219 61.410156 1.0625 59.320312 2.601562 57.78125 C 4.148438 56.242188 6.238281 55.375 8.414062 55.375 Z M 156.203125 55.375 " fill-opacity="1" fill-rule="nonzero" />
                    </svg>
                    <span class="link-name">Settings</span>
                </a>
            </li>
            <li>
                <a class="s-link" href="/HRMS/department/includes/logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 27px; height: 27px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span class="link-name">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</header>
<script>
    function loadDoc() {
        setInterval(function() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelectorAll('.notification-count').forEach((element) => {
                        element.innerHTML = this.responseText;
                    });
                }
            };
            xhttp.open("GET", "partials/notification_count.php", true);
            xhttp.send();
        }, 1000);
    }
    loadDoc();
</script>