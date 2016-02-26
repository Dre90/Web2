<?php
$servername = "localhost";
$username = "imt3851";
$password = "imt3851";
$dbname = "imt3851_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

// // Create database
// $sql = "CREATE DATABASE imt3851_db";
// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . $conn->error;
// }

// Create user
// $sql = "CREATE USER 'imt3851'@'localhost' IDENTIFIED BY 'imt3851'";
// if ($conn->query($sql) === TRUE) {
//     echo "User created successfully";
// } else {
//     echo "Error creating database: " . $conn->error;
// }

// // Grant user
// $sql = "GRANT ALL PRIVILEGES ON imt3851_db . * TO 'imt3851'@'localhost'";
// if ($conn->query($sql) === TRUE) {
//     echo "Privileges granted successfully";
// } else {
//     echo "Error creating database: " . $conn->error;
// }

// sql to create table
// $sql = "CREATE TABLE books (
//     isbn INT(10),
//     title VARCHAR(50),
//     publisher VARCHAR(50) ,
//     pages INT(6)
// )";
//
// if ($conn->query($sql) === TRUE) {
//     echo "Table books created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// sql to create table
// $sql = "CREATE TABLE customers (
//     personal_id INT(10),
//     name VARCHAR(50),
//     surname VARCHAR(50) ,
//     address VARCHAR(50)
// )";
//
// if ($conn->query($sql) === TRUE) {
//     echo "Table customers created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// sql to create table
// $sql = "CREATE TABLE orders (
//     order_id INT(10),
//     isbn INT(10),
//     personal_id INT(10) ,
//     quantity INT(5)
// )";
//
// if ($conn->query($sql) === TRUE) {
//     echo "Table orders created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// $sql = "INSERT INTO books (isbn, title, publisher, pages)
// VALUES (123, 'Book nr 1', 'Publisher nr 1', 200)";
//
// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }


$conn->close();
?>
