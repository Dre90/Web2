<?php
header('Content-Type: application/json');

// connect to database system
mysql_connect('localhost', 'root', '') or die(mysql_error());
// select a database
mysql_select_db('test') or die(mysql_error());

// if it is an add request
if($_POST["type"] == "add"){
	$name = $_POST["name"];
	$surname = $_POST["surname"];

	mysql_query("INSERT INTO people (name, surname) VALUES('$name', '$surname')");
}

// always return back the records in the database
$data = mysql_query('SELECT name, surname FROM people') or die(mysql_error());

$result = array();

// push records into an array
while($row = mysql_fetch_array($data)){
	array_push($result, $row);
}

// send a json response
echo json_encode($result);

?>
