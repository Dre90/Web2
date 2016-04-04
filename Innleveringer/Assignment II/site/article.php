<?php include_once 'include/head.php'; ?>

<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <div class='col-1-12'>
            </div>
            <?php require_once 'connect.php';
            // fetch all the orders
            $db_server=getDB();
            $query = "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_name, a.image, a.author, a.rating, c.category_id, c.category_name, u.user_id, u.username
            FROM articles as a
                JOIN category as c
                    ON a.category=c.category_id
                JOIN users as u
                    ON a.author=u.user_id
                     WHERE article_id='$_GET[article_id]'";
            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                echo "<div class='col-10-12'>";
                    echo "<h1>" . $row['title'] . "</h1>";
                    echo "<small>" . $row['date'] . "</small>";
                    echo '<img class="articleImg" src="data:image;base64,'.$row['image'].' ">';
                    echo "<p>" . $row['text'] . "</p>";
                    echo "<p class='articleAuthor'>" . $row['username'] . " "  . "</p>";
                echo "</div>";
            }
            // close the connection
			$result -> close();
             ?>
             <div class='col-1-12'>
             </div>
         </section>
     </div>
</body>
