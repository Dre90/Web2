<?php
/* PROGRAMMING FOR WEB II
 LAB 8 / TASK 1 ANSWER */

/*
 * Create the database and table first
 * CREATE DATABASE mysite;
 * CREATE TABLE users (username VARCHAR(15) PRIMARY KEY, name VARCHAR(30), surname VARCHAR(30), gender CHAR(1), pass CHAR(250), terms CHAR(1));
 *
 */

// These should go to a separete file
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mysite';

// connect with mysqli API
$db_server = new mysqli($host, $user, $pass, $db) or die("Could not connect!");

// if form is submitted
if(isset($_POST['submit'])){
	$username = get_post('username', $db_server);
	$name = get_post('name', $db_server);
	$surname = get_post('surname', $db_server);
	$gender = get_post('gender', $db_server);
	$terms = get_post('terms', $db_server);
	$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

	$query = "INSERT INTO users(username, name, surname, gender, pass, terms) VALUES('$username', '$name', '$surname', '$gender', '$pass', '$terms')";
	$db_server->query($query) or die($db_server->error);
	echo "The user has been registered!<br>";
}

// sanitize your input
function get_post($var, $conn){
	$var = stripslashes($_POST[$var]);
	$var = htmlentities($var);
	$var = strip_tags($var);
	$var = $conn->real_escape_string($var);

	return $var;
}

?>
<html>
	<head>
		<title>User Resgistration Form</title>
	</head>
	<body>
		<h2>Registration Form</h2>
		<form method="post" action="Lab8_Task1_Answer.php">
			<table border=1>
				<tr>
					<td>User name: </td>
					<td>
					<input type="text" name="username">
					</td>
				</tr>
				<tr>
					<td>Name: </td>
					<td>
					<input type="text" name="name">
					</td>
				</tr>
				<tr>
					<td>Surname: </td>
					<td>
					<input type="text" name="surname">
					</td>
				</tr>
				<tr>
					<td>Gender: </td>
					<td>
					<select name="gender">
						<option value="M">Male</option>
						<option value="F">Female</option>
					</select></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>
					<input type="password" name="pass">
					</td>
				</tr>
				<tr>
					<td>Do you agree with terms?</td>
					<td>
					<input type="radio" name="terms">
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Register">
		</form>
	</body>
</html>
