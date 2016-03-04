<?php
/* PROGRAMMING FOR WEB II
 LAB 7 / TASK 1 ANSWER */

// connection data
// typically should go
// to a separete file
$host = 'localhost';
$user = 'root';
$pass = '';
$db = '';

// connect with mysql API
$db_server = mysql_connect($host, $user, $pass);

if (!$db_server) {
	// here we use echo rather than die, so that
	// execution continues to test mysqli connection
	echo 'Connection failed with mysql API:' . mysql_error();
} else {
	echo "Succesfully connected with mysql API!";
	mysql_close($db_server);
}

echo '<br><br>';

// connect with mysqli API
$db_server = new mysqli($host, $user, $pass, $db);

// check if connected
if ($db_server->connect_error) {
	echo 'Connection failed with mysqli API:' . $db_server->connect_error;
} else {
	echo "Succesfully connected with mysqli API!";
	$db_server->close();
}

?>
