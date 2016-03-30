<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online newspaper - Assignment II</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/simplegrid.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require_once 'connect.php'; ?>
    <div class="wrapper">
        <?php   //if(logged_in() === false) {include 'header/not_logged_in.php';} ?>
        <?php  // if(logged_in() === true) {include 'header/logged_in.php';} ?>
        <header>
            <a href="index.html" class="logo">Online newspaper</a>
            <nav>
                <ul>
                    <li><a href="index.html">Front page</a></li>
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </header>
        <div class="content">
        <section class="grid grid-pad">

            <?php
            // fetch all the orders
            $db_server=getDB();
            $query = "SELECT * FROM articles";
            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                echo "<div class='col-1-3'>";
    				echo "<h1>" . $row['title'] . "</h1>";

    				echo "<small>" . $row['date'] . "</small>";

    				echo '<img class="articleImg" src="data:image;base64,'.$row['image'].' ">';

    				echo "<p>" . substr($row['text'],0 , 100) . "..." . "</p>";


                    echo "<a href='article.php?article_id=" .$row['article_id'] . "'>Read more</a>";
                echo "</div>";


			}
             ?>

        </section>
    </div>
    </div>
</body>
</html>
