
<nav class="navbar" id="navbar">
    <div class="left-nav">
        <button id="burger" class="burger">
            <img src="images/burger.svg" alt="" />
        </button>
        <div class="search-container">
            <input type="text" placeholder="Search" />
            <button>
                <img src="images/search.svg" alt="" />
            </button>
        </div>
    </div>
    <div class="right-nav">
        <button class="profile-btn">
            <div class="profile-img-container">
                <img src="images/profile.svg" alt="" />
            </div>
            <?php echo "<span>$admin_fname</span>"; ?>
            <!-- Popup Menu -->
            <div class="profile-menu">
                <a href="about_faculty.php?admin_id">
                    <div>
                        <img src="images/1.svg" alt="" />
                        <span>Profile</span>
                    </div>
                </a>
                <a href="about_faculty.php?admin_id">
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
                <a href="/HRMS/includes/logout.php">
                    <div>
                        <img src="images/arrow.svg" alt="" />
                        <span>Logout</span>
                    </div>
                </a>
            </div>
        </button>
    </div>
</nav>