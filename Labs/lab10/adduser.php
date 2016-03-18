<?php
$host = 'localhost';
$user = 'lab10';
$pass = 'lab10';
$db = 'lab10';

// connect with mysqli API
$con = new mysqli($host, $user, $pass, $db) or die("Could not connect!");

//if(isset($_POST['submit'])){
	$name = get_post('name', $con);
	$surname = get_post('surname', $con);

	$query = "INSERT INTO user(name, surname) VALUES('$name', '$surname')";
	$con->query($query) or die($con->error);

//}

// sanitize your input
function get_post($var, $conn){
	$var = stripslashes($_POST[$var]);
	$var = htmlentities($var);
	$var = strip_tags($var);
	$var = $conn->real_escape_string($var);

	return $var;
}

mysqli_close($con);
?>
