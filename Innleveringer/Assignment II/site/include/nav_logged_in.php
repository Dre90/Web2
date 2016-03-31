<?php
// log out
if (isset($_POST['logout'])) {
	// Unset all of the session variables.
	$_SESSION = array();
	// delete the session cookie
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	}
	// Finally, destroy the session.
	session_destroy();
	// direct user to login
	header('Location: index.php');
}
 ?>
<header>
    <a href="index.php" class="logo">Online newspaper</a>
    <nav>
        <ul>
            <li><a href="index.php">Front page</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    				<input type="submit" name="logout" value="Log out">
    			</form>
            </li>
            <!-- fiks -->

        </ul>
    </nav>
</header>
