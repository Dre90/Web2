<?php
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
$query = 'CREATE DATABASE IF NOT EXISTS newspaper_db';
$db_server->query($query) or die('Query failed:' . $db_server->error);

// create the user and grant creditentials
$query = "GRANT ALL ON newspaper_db.* TO 'newspaper_admin'@'localhost' IDENTIFIED BY 'newspaper_admin'";
$db_server->query($query) or die('Query failed:' . $db_server->error);

// select the db
$db_server->select_db('newspaper_db') or die('Can not select db:' . $db_server->error);

// create the users table
$query = 'CREATE TABLE IF NOT EXISTS users (
	user_id INT PRIMARY KEY AUTO_INCREMENT,
	user_type CHAR(1) NOT NULL,
	username VARCHAR(100) NOT NULL,
	mail VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	firstname VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL
)';
$db_server->query($query) or die('Query failed1:' . $db_server->error);

// create the category table
$query = 'CREATE TABLE IF NOT EXISTS category (
	category_id INT PRIMARY KEY AUTO_INCREMENT,
  	category_name VARCHAR(50) NOT NULL
)';
$db_server->query($query) or die('Query failed3:' . $db_server->error);

// create the articles table
$query = 'CREATE TABLE IF NOT EXISTS articles (
	article_id INT PRIMARY KEY AUTO_INCREMENT,
  	title VARCHAR(255) NOT NULL,
  	category INT NOT NULL,
	date DATE NOT NULL,
	text TEXT NOT NULL,
	image_name VARCHAR(50) NOT NULL,
	image LONGBLOB NOT NULL,
	author INT NOT NULL,
  	rating INT NOT NULL,
	FOREIGN KEY (category) REFERENCES category(category_id),
	FOREIGN KEY (author) REFERENCES users(user_id)
)';
$db_server->query($query) or die('Query failed2:' . $db_server->error);


echo "Database and tables are succesfully created!";
echo "<br>";
echo "Go to the <a href='index.php'>front page</a>";
// close the connection
$db_server->close();
 ?>
