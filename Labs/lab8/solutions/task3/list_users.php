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

$result = $db_server -> query("SELECT username FROM users");
?>
<html>
	<head>
		<title>Users</title>
	</head>
	<body>
		<h2>Users</h2>
		<table border="1">
			<tr>
				<td>User name</td>
				<td>Profile</td>
			</tr>
			<?php
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>";
				echo $row['username'];
				echo "</td>";
				echo "<td>";
				echo "<a href='show_profile.php?user=" .$row['username'] . "'>Show profile</a>";
				echo "</td>";
				echo "</tr>";
			}
			?>
		</table>
	</body>
</html>
