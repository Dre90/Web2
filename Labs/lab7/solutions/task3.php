<?php
/* PROGRAMMING FOR WEB II
 LAB 7 / TASK 3 ANSWER */

// connection data
// typically should go
// to a separete file
$host = 'localhost';
$user = 'imt3851';
$pass = 'imt3851';
$db = 'imt3851_db';

// sanitize string
function get_post($var) {
	if (isset($_POST[$var]))
		return htmlspecialchars(mysql_real_escape_string($_POST[$var]));
	else
		return NULL;
}

// connect with mysqli API
$db_server = new mysqli($host, $user, $pass, $db);

// if connection fails
if ($db_server -> connect_error)
	die('Connection failed with mysqli API:' . $db_server -> connect_erro);

// select the db
$db_server -> select_db('imt3851_db') or die('Can not select db:' . $db_server -> error);

// if delete is clicked
if (isset($_POST['delete'])) {
	$order_id = get_post('order_id');
	$query = "DELETE FROM orders WHERE order_id = $order_id";
	$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
}

// if add is clicked
if (isset($_POST['add'])) {
	$personal_id = get_post('personal_id');
	$name = get_post('name');
	$surname = get_post('surname');
	$address = get_post('address');
	$isbn = get_post('isbn');
	$quantity = get_post('quantity');

	// all fields have to be entered
	if ($personal_id AND $name AND $surname AND $isbn AND $quantity) {
		$query = "SELECT * FROM customers WHERE personal_id='$personal_id'";
		$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

		// if user exists updated otherwise insert
		if (!$result -> num_rows) {
			$query = "INSERT INTO customers(personal_id, name, surname, address) VALUES('$personal_id', '$name', '$surname', '$address')";
			$db_server -> query($query) or die('Query failed:' . $db_server -> error);
		} else {
			$query = "UPDATE customers SET name='$name', surname='$surname', address='$address' WHERE personal_id ='$personal_id'";
			$db_server -> query($query) or die('Query failed:' . $db_server -> error);

		}

		// check if book exists
		$query = "SELECT * FROM books WHERE isbn='$isbn'";
		$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

		// if book exists, insert the order
		if ($result -> num_rows) {
			$query = "INSERT INTO orders(personal_id, isbn, quantity) VALUES('$personal_id', '$isbn', '$quantity')";
			$db_server -> query($query) or die('Query failed:' . $db_server -> error);
			$order_id = $db_server -> insert_id;
		}
	}
}

// fetch all the orders
$query = "SELECT order_id, orders.personal_id, name, surname, address, orders.isbn, title, publisher, quantity FROM orders,
			  customers, books WHERE orders.personal_id = customers.personal_id AND orders.isbn = books.isbn";
$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

// close the connection
$db_server -> close();
?>
<html>
	<head>
		<title>Orders</title>
	</head>
	<body>
		<?php
		if (isset($order_id))
			if (isset($_POST['delete']))
				echo "Order #$order_id has been deleted!";
			else
				echo "Order #$order_id has been created!";
		?>
		<table border=1>
			<tr>
				<td>Order id</td>
				<td>Customer id</td>
				<td>Customer name</td>
				<td>Customer surname</td>
				<td>Customer address</td>
				<td>ISBN</td>
				<td>Book title</td>
				<td>Publisher</td>
				<td>Quantitiy</td>
				<td>Delete</td>
			</tr>
			<?php
			// list all the orders
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>" . $row['order_id'] . "</td>";
				echo "<td>" . $row['personal_id'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['surname'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['isbn'] . "</td>";
				echo "<td>" . $row['title'] . "</td>";
				echo "<td>" . $row['publisher'] . "</td>";
				echo "<td>" . $row['quantity'] . "</td>";
				echo "<form method='post' action='Lab7_Task3_Answer.php'>";
				echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
				echo "<td><input type='submit' name='delete' value='Delete'></td>";
				echo "</form>";
				echo "</tr>";

			}

			// close the connection
			$result -> close();
			?>
		</table>
		<br>
		<br>
		<form method='post' action='Lab7_Task3_Answer.php'>
			<table border=1>
				<tr>
					<td>Customer id:</td>
					<td>
					<input type='text' name='personal_id'>
					</td>
				</tr>
				<tr>
					<td>Customer name:</td>
					<td>
					<input type='text' name='name'>
					</td>
				</tr>
				<tr>
					<td>Customer surname:</td>
					<td>
					<input type='text' name='surname'>
					</td>
				</tr>
				<tr>
					<td>Customer address:</td>
					<td>
					<input type='text' name='address'>
					</td>
				</tr>
				<tr>
					<td>Isbn:</td>
					<td>
					<input type='text' name='isbn'>
					</td>
				</tr>
				<tr>
					<td>Quantity:</td>
					<td>
					<input type='text' name='quantity'>
					</td>
				</tr>
			</table>
			<input type='submit' name='add' value='Add order'>
		</form>
	</body>
</html>
