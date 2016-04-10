<?php
include_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

// open the connection
$db_server=getDB();
$sort = $_COOKIE["sort"];



if(isset($_POST['sort'])) {

        $cookie_name = "sort";
        $cookie_value = $_POST["sort"];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        redirect("index.php", false);
}

?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">
            <div class="grid grid-pad">
                <div class="col-7-12">
                    <form method="get" action="search.php" >
                            <input type="text" name="search" placeholder="Search" class="search-field">
                            <input type="submit" name="search_button" value="Search" class="search-botton">
                    </form>
                </div>

                <!-- chronological order UP and down -->
                <div class="col-5-12">
                    <form method="post" action="index.php" >
                        <select name="sort" class="sort-select">
                            <option value=''>Sort on</option>
                            <option value='date'>Chronological order</option>
                            <option value='rating'>Popularity</option>
                        </select>
                        <input type="submit" name="sort_button" value="Sort" class="sort-botton">
                    </form>


                </div>

            </div>
            <?php
            // fetch all the orders
            if ($sort == "") {
                $query = "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_path,  a.author, a.rating, c.category_id, c.category_name
                FROM articles as a
                INNER JOIN category as c
                ON a.category=c.category_id
                ORDER BY date DESC";
            } else {
                $query = "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_path,  a.author, a.rating, c.category_id, c.category_name
                FROM articles as a
                INNER JOIN category as c
                ON a.category=c.category_id
                ORDER BY $sort DESC";
            }

            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                echo "<div class='col-6-12 newsArticle'>";
                    echo "<div class='article-img-container'>";
                        echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . '<img class="articleImg" src="'.$row['image_path'].' ">' . "</a>";
                    echo "</div>";
                    echo "<div class='titleBox'>";
                        echo "<a href='category.php?category_id=" .$row['category_id'] . "'>" . "<p class='articleCategory'>" . $row['category_name'] . " "  . "</p>" . "</a>";

        				echo "<a href='article.php?article_id=" .$row['article_id'] . "'>" . "<h1>" . $row['title'] . "</h1>" . "</a>";


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
</html>
