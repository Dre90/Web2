<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php

$host = 'localhost';
$user = 'lab10';
$pass = 'lab10';
$db = 'lab10';

// connect with mysqli API
$con = new mysqli($host, $user, $pass, $db) or die("Could not connect!");


mysqli_select_db($con,"lab10");
$sql="SELECT name, surname FROM user";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['surname'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
