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
$db_server->query($query) or die('Query failed2:' . $db_server->error);

// create the articles table
$query = 'CREATE TABLE IF NOT EXISTS articles (
	article_id INT PRIMARY KEY AUTO_INCREMENT,
  	title VARCHAR(255) NOT NULL,
  	category INT NOT NULL,
	date DATE NOT NULL,
	text TEXT NOT NULL,
	image_path VARCHAR(255) NOT NULL,
	author INT NOT NULL,
  	rating INT NOT NULL,
	FOREIGN KEY (category) REFERENCES category(category_id),
	FOREIGN KEY (author) REFERENCES users(user_id)
)';
$db_server->query($query) or die('Query failed3:' . $db_server->error);

// --------------------Create users--------------------
// create a admin
$pass = password_hash("admin", PASSWORD_DEFAULT);
$query = "INSERT INTO users(user_type, username, mail, password, firstname, lastname)
		  VALUES(1, 'Admin', 'admin@assignmentII.com', '$pass', 'Ola', 'Norman')";
$db_server->query($query) or die('Query failed4:' . $db_server->error);

// create a user
$pass = password_hash("user", PASSWORD_DEFAULT);
$query = "INSERT INTO users(user_type, username, mail, password, firstname, lastname)
		  VALUES(2, 'User', 'user@assignmentII.com', '$pass', 'Kari', 'Norman')";
$db_server->query($query) or die('Query failed4:' . $db_server->error);

// --------------------Create categorys--------------------
// create Uncategorized category
$query = "INSERT INTO category(category_name)
		  VALUES('Uncategorized')";
$db_server->query($query) or die('Query failed5:' . $db_server->error);

// create Tech category
$query = "INSERT INTO category(category_name)
		  VALUES('Tech')";
$db_server->query($query) or die('Query failed6:' . $db_server->error);

// create Watercooler category
$query = "INSERT INTO category(category_name)
		  VALUES('Watercooler')";
$db_server->query($query) or die('Query failed7:' . $db_server->error);

// --------------------Create articles--------------------
//article 1
$title = $category = $todaysDate = $text = $image = $user_id = "";
$title = "This pig that thinks she's a dog is living her best life";
$category = 3;
$todaysDate = date("Y-m-d");
$text = "Olive the pig has a unique family that does not discriminate.

Despite her brothers and sisters being of the canine variety, Olive has found her home by their side. It is like Babe come to life.

The eight-month-old farm animal lives with Tilly the British bulldog, Alfie the Boston terrier and Lola the French bulldog in the semi-rural suburb of Glenorie in Sydney, Australia. Her parents, Alissa and Nick Childs, have collected the group of misfits and showered them with love, parties and dress-up costumes.

Olive, who joined the clan in October 2015, spends most of her days either grazing on the lawns or sleeping on the couch with the dogs. She also goes on bush walks with the family.

Their adorable lives are being documented on Alissa's Instagram account, Abby Love Photography. From the blooming friendship of Olive and Lola, the outrageous outfits and their cheeky run-ins with the goats and chickens, there is not a moment of boredom.";
$image = "article_images\pig.jpg";
$user_id = "2";

$query = "INSERT INTO articles (title, category, date, text, image_path, author)
		  VALUES ('$title', '$category', '$todaysDate', '$text', '$image', $user_id)";
$db_server->query($query) or die('Query failed7:' . $db_server->error);

//article 2
$title = $category = $todaysDate = $text = $image = $user_id = "";
$title = "The world is ready for the Model 3. Is Tesla?";
$category = 2;
$todaysDate = date("Y-m-d");
$text = "By attracting over 325,000 pre-orders in just three days, Tesla proved unequivocally that the world is ready for the Model 3.

But is Tesla ready for the mass-market long-range EV?

Sure, Tesla showed us a car. It's designed and debuted at least part of it, though the interior is still to come.

For traditional automakers, at this point, they'd be effectively close to the finish line. The research and design (R&D) is the hard part. Sending the final design into production is the easier part (I am speaking very broadly, of course).

Tesla has the unenviable task of scaling up from a small carmaker into a major one.
That's because carmakers like Toyota, for example, have been building cars for almost 80 years, and they have the production process honed to a fine art.

Tesla, on the other hand, is a relative newcomer. In fact, it's produced around 200,000 cars since the company began making cars in 2008. Heck, it's only produced around 80,000 Model S cars.

Now, however, Tesla has the unenviable task of scaling up from a small carmaker into a major one in two years time — and not just in terms of production.

In many ways, the upstart automaker operates like a tech company, rather than a traditional car company. This fact is best evidenced in its company-owned stores and Apple-like repair policies.";
$image = "article_images\model_3.jpg";
$user_id = "2";

$query = "INSERT INTO articles (title, category, date, text, image_path, author)
		  VALUES ('$title', '$category', '$todaysDate', '$text', '$image', $user_id)";
$db_server->query($query) or die('Query failed7:' . $db_server->error);

echo "Database, tables and some data has been succesfully created!";
echo "<br>";
echo "Go to the <a href='index.php'>front page</a>";
// close the connection
$db_server->close();
 ?>
