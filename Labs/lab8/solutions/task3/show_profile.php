<?php
/* PROGRAMMING FOR WEB II
 LAB 8 / TASK 3 ANSWER */

// should go to a separete file
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mysite';

// connect with mysqli API
$db_server = new mysqli($host, $user, $pass, $db) or die($db_server -> error);
$query = "SELECT username, name, surname, gender, terms FROM users WHERE username='$_GET[user]'";
$result = $db_server -> query($query);
?>
<html>
	<head>
		<title>User Profile</title>
	</head>
	<body>
	<?php
	// if user is found
	if($result->num_rows > 0){
		$row = $result->fetch_array(MYSQLI_ASSOC);

	?>
		<h2><?php echo $row['username'] ?></h2>
		<table border="1">
			<tr>
				<td>
					Name:
				</td>
				<td>
					<?php echo $row['name']; ?>
				</td>
			</tr>
			<tr>
				<td>Surname: </td>
				<td><?php echo $row['surname']; ?></td>
			</tr>
			<tr>
				<td>Gender: </td>
				<td><?php echo $row['gender']; ?></td>
			</tr>
			<tr>
				<td>Terms: </td>
				<td><?php echo $row['terms']; ?></td>
			</tr>
		</table>
	</body>
	<?php
	// if user id is invalid
	} else {
		echo "Invalid user!";
	} ?>
</html>
