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
	$db_server->query($query) or die('Query failed 1.1: ' . $db_server->error);

	// create the category table
	$query = 'CREATE TABLE IF NOT EXISTS categorys (
		category_id INT PRIMARY KEY AUTO_INCREMENT,
	  	category_name VARCHAR(50) NOT NULL
	)';
	$db_server->query($query) or die('Query failed 1.2: ' . $db_server->error);

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
		FOREIGN KEY (category) REFERENCES categorys(category_id),
		FOREIGN KEY (author) REFERENCES users(user_id)
	)';
	$db_server->query($query) or die('Query failed 1.3: ' . $db_server->error);

	// --------------------Create users--------------------
	// create a deleteduser
	$pass = password_hash("deleteduser", PASSWORD_DEFAULT);
	$query = "INSERT INTO users(user_type, username, mail, password, firstname, lastname)
			  VALUES(2, 'DeletedUser', 'deleteduser@assignmentII.com', '$pass', 'Deleted', 'User')";
	$db_server->query($query) or die('Query failed 2.1: ' . $db_server->error);

	// create a admin
	$pass = password_hash("admin", PASSWORD_DEFAULT);
	$query = "INSERT INTO users(user_type, username, mail, password, firstname, lastname)
			  VALUES(1, 'Admin', 'admin@assignmentII.com', '$pass', 'Ola', 'Norman')";
	$db_server->query($query) or die('Query failed 2.2: ' . $db_server->error);

	// create a user
	$pass = password_hash("user", PASSWORD_DEFAULT);
	$query = "INSERT INTO users(user_type, username, mail, password, firstname, lastname)
			  VALUES(2, 'User', 'user@assignmentII.com', '$pass', 'Kari', 'Norman')";
	$db_server->query($query) or die('Query failed 2.3: ' . $db_server->error);

	// create a user
	$pass = password_hash("trump", PASSWORD_DEFAULT);
	$query = "INSERT INTO users(user_type, username, mail, password, firstname, lastname)
			  VALUES(2, 'Trump', 'donald@trump.com', '$pass', 'Donald', 'Trump')";
	$db_server->query($query) or die('Query failed 2.4: ' . $db_server->error);


	// --------------------Create categorys--------------------
	// create Uncategorized category
	$query = "INSERT INTO categorys(category_name)
			  VALUES('Uncategorized')";
	$db_server->query($query) or die('Query failed 3.1: ' . $db_server->error);

	// create Tech category
	$query = "INSERT INTO categorys(category_name)
			  VALUES('Tech')";
	$db_server->query($query) or die('Query failed 3.2: ' . $db_server->error);

	// create Watercooler category
	$query = "INSERT INTO categorys(category_name)
			  VALUES('Watercooler')";
	$db_server->query($query) or die('Query failed 3.3: ' . $db_server->error);

	// create Politics category
	$query = "INSERT INTO categorys(category_name)
			  VALUES('Politics')";
	$db_server->query($query) or die('Query failed 3.4: ' . $db_server->error);

	// create Sports category
	$query = "INSERT INTO categorys(category_name)
			  VALUES('Sports')";
	$db_server->query($query) or die('Query failed 3.5: ' . $db_server->error);

	// --------------------Create articles--------------------
	//article 1
	$title = $category = $todaysDate = $text = $image = $user_id = "";
	$title = "This pig that thinks she is a dog is living her best life";
	$category = 3;
	$todaysDate = "2016-03-10";
	$text = "Olive the pig has a unique family that does not discriminate.

	Despite her brothers and sisters being of the canine variety, Olive has found her home by their side. It is like Babe come to life.

	The eight-month-old farm animal lives with Tilly the British bulldog, Alfie the Boston terrier and Lola the French bulldog in the semi-rural suburb of Glenorie in Sydney, Australia. Her parents, Alissa and Nick Childs, have collected the group of misfits and showered them with love, parties and dress-up costumes.

	Olive, who joined the clan in October 2015, spends most of her days either grazing on the lawns or sleeping on the couch with the dogs. She also goes on bush walks with the family.

	Their adorable lives are being documented on Alissa Instagram account, Abby Love Photography. From the blooming friendship of Olive and Lola, the outrageous outfits and their cheeky run-ins with the goats and chickens, there is not a moment of boredom.";
	$image = "article_images/pig.jpg";
	$user_id = "3";
	$likes = "10";

	$query = "INSERT INTO articles (title, category, date, text, image_path, author, rating)
			  VALUES ('$title', '$category', '$todaysDate', '$text', '$image', '$user_id', '$likes')";
	$db_server->query($query) or die('Query failed 4.1: ' . $db_server->error);

	//article 2
	$title = $category = $todaysDate = $text = $image = $user_id = "";
	$title = "The world is ready for the Model 3. Is Tesla?";
	$category = 2;
	$todaysDate = "2016-01-15";
	$text = "By attracting over 325,000 pre-orders in just three days, Tesla proved unequivocally that the world is ready for the Model 3.

	But is Tesla ready for the mass-market long-range EV?

	Sure, Tesla showed us a car. It is designed and debuted at least part of it, though the interior is still to come.

	For traditional automakers, at this point, they be effectively close to the finish line. The research and design (R&D) is the hard part. Sending the final design into production is the easier part (I am speaking very broadly, of course).

	Tesla has the unenviable task of scaling up from a small carmaker into a major one.
	That is because carmakers like Toyota, for example, have been building cars for almost 80 years, and they have the production process honed to a fine art.

	Tesla, on the other hand, is a relative newcomer. In fact, it is produced around 200,000 cars since the company began making cars in 2008. Heck, it is only produced around 80,000 Model S cars.

	Now, however, Tesla has the unenviable task of scaling up from a small carmaker into a major one in two years time — and not just in terms of production.

	In many ways, the upstart automaker operates like a tech company, rather than a traditional car company. This fact is best evidenced in its company-owned stores and Apple-like repair policies.";
	$image = "article_images/model_3.jpg";
	$user_id = "2";
	$likes = "20";

	$query = "INSERT INTO articles (title, category, date, text, image_path, author, rating)
			  VALUES ('$title', '$category', '$todaysDate', '$text', '$image', '$user_id', '$likes')";
	$db_server->query($query) or die('Query failed 4.2: ' . $db_server->error);

	//article 3
	$title = $category = $todaysDate = $text = $image = $user_id = "";
	$title = "Donald Trump masks are yuuuge business for this Mexican retailer";
	$category = 4;
	$todaysDate = "2016-04-05";
	$text = 'Despite his comments about Mexican immigrants and ideas about how he make the Mexican government pay for "the wall," Donald Trumps GOP front-runner status has managed to be positive for Mexico in at least one way: locally-made masks of his face are selling like hotcakes.

	Caretas REV, a mask-making company in central Mexico, has produced tens of thousands of Trump masks since last fall, CNN Money reported.

	The majority of those masks are sold in the United States, and the company expects orders to increase in coming months, co-owner Ricardo Esponda told CNN. The deluxe version of the latex mask, which comes with artificial hair, retails for $23 in the U.S., and the standard all-latex version is $19.95.

	"We weren making this mask with hair at first," Esponda said. "But some of our customers asked for it. It is got to have hair."

	The company also makes Hillary Clinton and Barack Obama masks, but the Trump mask is the most popular by far. It is currently outsold only by a mask bearing the likeness of infamous drug cartel leader Joaquin "El Chapo" Guzman, which comes with a striped prisoner uniform. ';
	$image = "article_images/trump.jpg";
	$user_id = "4";
	$likes = "5";

	$query = "INSERT INTO articles (title, category, date, text, image_path, author, rating)
			  VALUES ('$title', '$category', '$todaysDate', '$text', '$image', '$user_id', '$likes')";
	$db_server->query($query) or die('Query failed 4.3: ' . $db_server->error);

	//article 4
	$title = $category = $todaysDate = $text = $image = $user_id = "";
	$title = "Snapchat is now the most popular social network among teens, according to new study";
	$category = 2;
	$todaysDate = "2016-04-10";
	$text = 'As Snapchat has expanded and added new features over the year, it has steadily climbed the ranks of social media titans. In fact, it is now more popular among its core demographic — teens — than Twitter, Facebook and now even Instagram.
	The Piper Jaffray study "Taking Stock With Teens" polled about 6,500 U.S. teens to see what they felt was the most important social network, and Snapchat took 28% of votes. Instagram came in close-second with 27%, followed by Twitter and Facebook.
	The "Taking Stock With Teens" survey, which is done semi-annually, shows Snapchats rise over the past year. In the spring 2015 survey, Instagram was the top social network, with Snapchat coming in fourth behind Twitter and Facebook. In the fall, Snapchat edged out Facebook for third.

	The study shows that teens tend to be more interested in viewing pictures and videos rather than text-focused media seen on Twitter and Facebook.

	Snapchat has been making the most changes and updates over the last year, introducing things like Snapchat Discover and debuting live coverage at the Oscars. The social network has expanded into more entertaining areas like adding in more and more video and picture filters, as well as the popular face swapping feature. The platform is consistently updating to keep itself interesting and fresh for users, while other social networks have mostly remained unchanged.

	Unsurprisingly, Google+ came in last place with 1% of votes from teens, beat by Tumblr and Pinterest which each had a 2% share of votes.';
	$image = "article_images/snapchat.jpg";
	$user_id = "3";
	$likes = "2";

	$query = "INSERT INTO articles (title, category, date, text, image_path, author, rating)
			  VALUES ('$title', '$category', '$todaysDate', '$text', '$image', '$user_id', '$likes')";
	$db_server->query($query) or die('Query failed 4.4: ' . $db_server->error);

	echo "Database and tables has been succesfully created, and some data has been succesfully added!";
	echo "<br>";
	echo "Go to the <a href='index.php'>front page</a>";
	// close the connection
	$db_server->close();
 ?>
