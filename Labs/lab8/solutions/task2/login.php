<?php
/* PROGRAMMING FOR WEB II
 LAB 8 / TASK 2 ANSWER */
session_start();

// should go to a separete file
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mysite';

// connect with mysqli API
$db_server = new mysqli($host, $user, $pass, $db) or die($db_server -> error);

if (!isset($_SESSION['isloggedin']) && isset($_POST['login'])) {
	$username = get_post('username', $db_server);
	$password = $_POST['password'];

	$result = $db_server -> query("SELECT name, surname, pass FROM users WHERE username='$username'");

	if ($result -> num_rows != 0) {
		$row = $result -> fetch_array(MYSQLI_ASSOC);
		if (password_verify($password, $row['pass'])) {
			// regenerate the session id
			session_regenerate_id();
			// set session parameters
			$_SESSION['username'] = $username;
			$_SESSION['name'] = $row['name'];
			$_SESSION['surname'] = $row['surname'];
			$_SESSION['isloggedin'] = TRUE;
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
		}
	}
}

// sanitize your input
function get_post($var, $conn) {
	$var = stripslashes($_POST[$var]);
	$var = htmlentities($var);
	$var = strip_tags($var);
	$var = $conn -> real_escape_string($var);

	return $var;
}
?>
<?php
// if not logged in
if(!isset($_SESSION['isloggedin'])){
	// if wrong user name and password is provided
	if(isset($_POST['login']))
		echo "Wrong username or password!";
	echo <<<END
	<html>
		<head>
			<title>Login</title>
		</head>
		<body>
			<h2>Login</h2>
			<form method="post" action="login.php">
				<table>
					<tr>
						<td>User name:</td>
						<td>
						<input type="text" name="username">
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
						<input type="password" name="password">
						</td>
					</tr>
					<tr>
						<td colspan="2">
						<input type="submit" name="login" value="Login">
						</td>
					</tr>
				</table>
			</form>
		</body>
	</html>
END;
}else{
	echo "You are logged in!<br>";
	echo "Click <a href='profile.php'>here</a> to see your profile!";
}
?>
