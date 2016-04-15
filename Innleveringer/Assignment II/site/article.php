<?php
    require_once 'include/head.php';
    require_once 'connect.php';

    // open the connection
    $db_server=getDB();
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <?php
                // fetch all the articles and category name
                $query =    "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_path, a.author, a.rating, c.category_id, c.category_name, u.user_id, u.username
                            FROM articles as a
                            JOIN categorys as c
                            ON a.category=c.category_id
                            JOIN users as u
                            ON a.author=u.user_id
                            WHERE article_id='$_GET[article_id]'";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

                while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                    $category_id = $row["category_id"];

                    echo "<div class='col-9-12'>";
                        echo "<h1>" . $row['title'] . "</h1>";
                        echo "<div class='grid grid-pad underTitle'>";
                            echo "<div class='col-4-12'>" . "Writen by " . $row['username'] . "</div>";
                            echo "<div class='col-4-12'>" . $row['date'] . "</div>";
                            echo "<div class='col-4-12'>" . $row['rating'] . " likes" . "</div>";
                        echo "</div>";
                        echo '<img class="articleImg" src="'.$row['image_path'].' ">';
                        echo "<p>" . $row['text'] . "</p>";
                    echo "</div>";
                }
             ?>
             <div class='col-3-12'>
                 <?php
                     $query = "SELECT * FROM categorys WHERE category_id = $category_id ";
                     $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

                     while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                         $category_name = $row['category_name'];
                     }
                     echo "<h3>". "Hot in " . $category_name . "</h3>";


                     $query =   "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_path, a.author, a.rating, c.category_id, c.category_name
                                FROM articles as a
                                INNER JOIN categorys as c
                                ON a.category=c.category_id
                                WHERE category_id=$category_id
                                ORDER BY rating DESC";

                     $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

                     while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                         $article_id = $row["article_id"];
                         $rating = $row["rating"];

                         echo "<div class='newsArticle sidebar'>";
                             echo "<div class='article-img-container'>";
                                 echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . '<img class="articleImg" src="'.$row['image_path'].' ">' . "</a>";
                             echo "</div>";
                             echo "<div class='titleBox'>";
                 				echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . "<h1>" . $row['title'] . "</h1>" . "</a>";
                             echo "</div>";

             				echo "<p>" . substr($row['text'],0 , 160) . ".." . "</p>";
                         echo "</div>";
         			}
                     // close the connection
         			$db_server -> close();
                  ?>
             </div>
         </section>
     </div>
</body>
</html>
