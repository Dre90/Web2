<?php include_once 'include/head.php'; ?>
<?php require_once 'connect.php'; ?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">

            <?php
            // fetch all the orders
            $db_server=getDB();
            $query = "SELECT * FROM articles";
            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                echo "<div class='col-1-3'>";
    				echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . "<h1>" . $row['title'] . "</h1>" . "</a>";

    				echo "<small>" . $row['date'] . "</small>";

    				echo '<img class="articleImg" src="data:image;base64,'.$row['image'].' ">';

    				echo "<p>" . substr($row['text'],0 , 100) . "..." . "</p>";


                    echo "<a href='article.php?article_id=" .$row['article_id'] . "'>Read more</a>";
                echo "</div>";
			}
            // close the connection
			$result -> close();
             ?>
        </section>
    </div>
</body>
</html>
