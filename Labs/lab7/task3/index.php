<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}

th {
    padding-top: 20px;

}

th.test {
    padding-top: 7px;
}
tr:nth-child(even) {
    background-color: #eee;
}

tr:nth-child(odd) {
   background-color:#fff;
}
th	{
    background-color: white;

}
</style>

</head>
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

$sql = "SELECT * FROM books";
$books = $conn->query($sql);
$sql = "SELECT * FROM customers";
$customers = $conn->query($sql);
$sql = "SELECT * FROM orders";
$orders = $conn->query($sql);

echo "<table>";
echo "<td>";
    echo "Order id";
echo "</td>";
echo "<td>";
    echo "Customer id";
echo "</td>";
echo "<td>";
    echo "Customer name";
echo "</td>";
echo "<td>";
    echo "Customer address";
echo "</td>";
echo "<td>";
    echo "ISBN";
echo "</td>";
echo "<td>";
    echo "Book title";
echo "</td>";
echo "<td>";
    echo "Publisher";
echo "</td>";
echo "<td>";
    echo "Quantity";
echo "</td>";
$rows = $orders->num_rows;
echo $rows;
if ($rows > 0) {
    // output data of each row
    while($order = $orders->fetch_assoc()) {
        $book = $books->fetch_assoc();
        $customer = $customers->fetch_assoc();

        echo "<tr>";
        echo "<td>" . $order['order_id'] . "</td>";
    while($customer = $customers->fetch_assoc()) {
        if ($order['personal_id'] == $customer['personal_id']) {
        echo "<td>" . $customer['personal_id'] . "</td>";
        echo "<td>" . $customer['name'] . " " . $customer['surname'] ."</td>";
        echo "<td>" . $customer['address'] . "</td>";
    } }
    if ($order['isbn'] == $book['isbn']) {
        echo "<td>" . $book['isbn'] . "</td>";
        echo "<td>" . $book['title'] . "</td>";
        echo "<td>" . $book['publisher'] . "</td>";
        echo "<td>" . $order['quantity'] . "</td>";
        echo "</tr>";
    }
    }
} else {
    echo "0 results";
}
echo "</table>";
?>
</html>
