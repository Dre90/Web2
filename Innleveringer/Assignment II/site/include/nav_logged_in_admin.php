<?php
    require_once 'functions.php';
    // log out
    if(isset($_GET['link'])){
        $link=$_GET['link'];
        deleteSession($link);
    }
 ?>
<header>
    <a href="index.php" class="logo">Online newspaper</a>
    <nav>
        <ul>
            <li><a href="index.php">Front page</a></li>
            <li class="dropdown">
                <a href="admin_dashboard.php" class="dropbtn">Admin dashboard</a>
                <div class="dropdown-content">
                    <a href="admin_dashboard_article.php">Articles</a>
                    <a href="admin_dashboard_categorys.php">Categorys</a>
                    <a href="admin_dashboard_users.php">Users</a>
                </div>
            </li>
			<li><a href="upload.php">Upload article</a></li>
            <li><a href="edit_profile.php">Profile</a></li>
            <li><a href="?link=1">Log out</a></li>
        </ul>
    </nav>
</header>
