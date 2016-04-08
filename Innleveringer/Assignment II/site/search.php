<?php
include_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

// open the connection
$db_server=getDB();
$sort = $_COOKIE["sort"];



$search = "$_GET[search]";
$searchArray = explode(" ", $search);
$arrlength = count($searchArray);

$searchString = $where = "";
$msg = "No results";

   $x = 0;
   foreach($searchArray as $element) {
        $where .= " a.title LIKE '%" . $searchArray[$x] . "%' OR " . "a.text LIKE '%" . $searchArray[$x] . "%'";
        if ($x == $arrlength - 1) {

        } else {
            $where .= " OR " ;
        }
            $x++;
    }

?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">
            <div class="grid grid-pad">
                <div class="col-8-12">
                    <h2>
                        Search results
                    </h2>

                </div>
            </div>
            <?php
            // fetch all the orders

                $query = "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_name, a.image, a.author, a.rating, c.category_id, c.category_name
                FROM articles as a
                INNER JOIN category as c
                ON a.category=c.category_id
                WHERE $where";

// WHERE $where
            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
            $resultCount = count($result);

            // echo $resultCount;
            // print_r($result);
            if ($result-> num_rows == 0) {

                echo "<div class='col-12-12'>";
                    echo "<p>". $msg ."</p>";
                echo "</div>";
            } else {
                # code...


            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                echo "<div class='col-6-12 newsArticle'>";
                    echo "<div class='article-img-container'>";
                        echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . '<img class="articleImg" src="data:image;base64,'.$row['image'].' ">' . "</a>";
                    echo "</div>";
                    echo "<div class='titleBox'>";
                        echo "<a href='category.php?category_id=" .$row['category_id'] . "'>" . "<p class='articleCategory'>" . $row['category_name'] . " "  . "</p>" . "</a>";

        				echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . "<h1>" . $row['title'] . "</h1>" . "</a>";


                    echo "</div>";


    				echo "<p>" . substr($row['text'],0 , 100) . "..." . "</p>";

                    echo "<footer><i class='fa fa-heart fa-lg'></i> Like</footer>";
                echo "</div>";
			}
            }
            // close the connection
			$result -> close();
             ?>
        </section>
    </div>
</body>
</html>
