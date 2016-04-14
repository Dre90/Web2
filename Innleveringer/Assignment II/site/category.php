<?php
    require_once 'include/head.php';
    require_once 'connect.php';

    $db_server=getDB();

    $category_id = $_GET['category_id'];

    $query = "SELECT * FROM categorys WHERE category_id = $category_id ";
    $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        $category_name = $row['category_name'];
    }
 ?>

<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <div>
                <h1><?php echo $category_name ?></h1>
            </div>
            <?php
            $query = "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_path, a.author, a.rating, c.category_id, c.category_name
            FROM articles as a
            INNER JOIN categorys as c
            ON a.category=c.category_id
            WHERE category_id=$category_id";

            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                $article_id = $row["article_id"];
                $rating = $row["rating"];
                echo "<div class='col-6-12 newsArticle'>";
                    echo "<div class='article-img-container'>";
                        echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . '<img class="articleImg" src="'.$row['image_path'].' ">' . "</a>";
                    echo "</div>";
                    echo "<div class='titleBox'>";
                        echo "<a href='category.php?category_id=" .$row['category_id'] . "'>" . "<p class='articleCategory'>" . $row['category_name'] . " "  . "</p>" . "</a>";

        				echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . "<h1>" . $row['title'] . "</h1>" . "</a>";

                    echo "</div>";

    				echo "<p>" . substr($row['text'],0 , 160) . ".." . "</p>";
                    echo "<footer>";
                        echo "<p>";
                        echo $rating . " likes";
                        echo "</p>";
                    echo "</footer>";
                echo "</div>";
			}
            // close the connection
			$result -> close();
             ?>

         </section>
     </div>
</body>
