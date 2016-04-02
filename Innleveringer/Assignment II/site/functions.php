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

 ?>
