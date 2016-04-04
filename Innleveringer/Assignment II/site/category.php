<?php
    require_once 'include/head.php';
    require_once 'connect.php';
 ?>

<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <?php
            // fetch all the orders
            $db_server=getDB();

            $query = "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_name, a.image, a.author, a.rating, c.category_id, c.category_name
            FROM articles as a
            INNER JOIN category as c
            ON a.category=c.category_id
            WHERE category_id='$_GET[category_id]';";
            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                echo "<div class='col-6-12 newsArticle'>";
                    echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . '<img class="articleImg" src="data:image;base64,'.$row['image'].' ">' . "</a>";

                        echo "<div class='titleBox'>";
                            echo "<a href='category.php?category_id=" .$row['category_id'] . "'>" . "<p class='articleCategory'>" . $row['category_name'] . " "  . "</p>" . "</a>";

            				echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . "<h1>" . $row['title'] . "</h1>" . "</a>";

            				echo "<p class='articleDate'>" . $row['date'] . " "  . "</p>";

                        echo "</div>";


    				echo "<p>" . substr($row['text'],0 , 100) . "..." . "</p>";

                    echo "<footer><i class='fa fa-heart fa-lg'></i> Like</footer>";
                echo "</div>";
			}
            // close the connection
			$result -> close();
             ?>

         </section>
     </div>
</body>
