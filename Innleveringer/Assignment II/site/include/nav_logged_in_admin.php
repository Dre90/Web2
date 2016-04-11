<?php
// log out
if(isset($_GET['link'])){
    $link=$_GET['link'];
	if ($link == '1'){
		// Unset all of the session variables.
		$_SESSION = array();
		// delete the session cookie
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
		// Finally, destroy the session.
		session_destroy();
		// direct user to index
		redirect("index.php", false);
	}
}
 ?>
<header>
    <a href="index.php" class="logo">Online newspaper</a>
    <nav>
        <ul>
            <li><a href="index.php">Front page</a></li>
			<!-- <li><a href="admin_dashboard.php">Admin dashboard</a></li> -->
            <li class="dropdown">
                <a href="#" class="dropbtn">Admin dashboard</a>
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
