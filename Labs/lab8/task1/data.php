<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully <br>";

// sanitize string
function get_post($var) {
	if (isset($_POST[$var])) {
		return strip_tags(htmlentities(stripslashes($_POST[$var])));
	} else
		return NULL;
}

if (isset($_POST['submit'])) {
    $id = null;
	$username = get_post('username');
	$name = get_post('name');
	$surname = get_post('surname');
	$password = $hash = password_hash(get_post('password'), PASSWORD_DEFAULT);
	$tos = get_post('tos');
    if ((isset($gender) && $gender=="female")) {
        $gender = "f";
    } else {
        $gender = "m";
    }

    if ((isset($tos) && $tos=="1")) {
        $tos = 1;
    } else {
        $tos = 0;
    }

    if ($tos == 1) {
        $query = "INSERT INTO user(username, name, surname, gender, password, tos) VALUES('$username', '$name', '$surname', '$gender', '$password', '$tos')";
        $conn -> query($query) or die('Query failed:' . $conn -> error);
    } else {
        echo "You have to agree to the term of service.";
    }
}
$conn -> close();
 ?>
