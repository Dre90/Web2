<?php
require_once 'connect.php';
// fetch all the orders
$db_server=getDB();
$query = "SELECT * FROM articles WHERE article_id='$_GET[article_id]'";
$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
    echo "<div class='col-1-3'>";
        echo "<h1>" . $row['title'] . "</h1>";

        echo "<small>" . $row['date'] . "</small>";

        echo '<img class="articleImg" src="data:image;base64,'.$row['image'].' ">';

        echo "<p>" . $row['text'] . "</p>";



    echo "</div>";


}
 ?>
