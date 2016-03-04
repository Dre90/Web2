<?php
/* PROGRAMMING FOR WEB II
 LAB 7 / TASK 2 ANSWER */

// connection data
// typically should go
// to a separete file
$host = 'localhost';
$user = 'root';
$pass = '';
$db = '';

// connect with mysqli API
$db_server = new mysqli($host, $user, $pass, $db);

// see if it is succesfull
if ($db_server -> connect_error)
	die('Connection failed with mysqli API:' . $db_server -> connect_error);

// create the database
$query = 'CREATE DATABASE IF NOT EXISTS imt3851_db';
$db_server->query($query) or die('Query failed:' . $db_server->error);

// create the user and grant creditentials
$query = "GRANT ALL ON imt3851_db.* TO 'imt3851'@'localhost' IDENTIFIED BY 'imt3851'";
$db_server->query($query) or die('Query failed:' . $db_server->error);

// select the db
$db_server->select_db('imt3851_db') or die('Can not select db:' . $db_server->error);

// create the books table
$query = 'CREATE TABLE IF NOT EXISTS books (
	isbn INT PRIMARY KEY,
  	title VARCHAR(100),
  	publisher VARCHAR(50),
  	pages TINYINT(4),
 	abstract TEXT(1000))';
$db_server->query($query) or die('Query failed:' . $db_server->error);

// create the customers table
$query = 'CREATE TABLE IF NOT EXISTS customers (
	personal_id INT PRIMARY KEY,
  	name VARCHAR(30),
  	surname VARCHAR(50),
  	address VARCHAR(100))';
$db_server->query($query) or die('Query failed:' . $db_server->error);

// create the orders table
$query = 'CREATE TABLE IF NOT EXISTS orders (
	order_id INT AUTO_INCREMENT PRIMARY KEY,
  	personal_id INT,
  	isbn INT,
  	quantity SMALLINT)';
$db_server->query($query) or die('Query failed:' . $db_server->error);

echo "Database and tables are succesfully created!";

// insert into books table
$query = "INSERT INTO books(isbn, title, publisher, pages, abstract) VALUES('1234', 'First book', 'Pub A', '300', 'This is the first book!')";
$db_server->query($query) or die('Query failed:' . $db_server->error);

// insert into books table
$query = "INSERT INTO books(isbn, title, publisher, pages, abstract) VALUES('1235', 'Second book', 'Pub B', '400', 'This is the second book!')";
$db_server->query($query) or die('Query failed:' . $db_server->error);

// insert into books table
$query = "INSERT INTO books(isbn, title, publisher, pages, abstract) VALUES('1236', 'Third book', 'Pub C', '300', 'This is the third book!')";
$db_server->query($query) or die('Query failed:' . $db_server->error);

// close the connection
$db_server->close();
?>
