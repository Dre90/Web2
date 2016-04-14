<?php
// sanitize your input
function get_post($var, $db_server) {
	$var = stripslashes($_POST[$var]);
	$var = htmlentities($var);
	$var = strip_tags($var);
	$var = $db_server -> real_escape_string($var);

	return $var;
}

// Redirect
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

function deleteSession($link)
{
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
