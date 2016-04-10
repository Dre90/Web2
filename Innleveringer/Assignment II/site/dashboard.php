<?php
include_once 'include/head.php';
require_once 'connect.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
    header('Location: login.php');

    $db_server=getDB();
    $current_article_id ="";
        if(isset($_POST['delete'])) {
            $current_article_id = $_POST['deleteForward'];

            $query = "DELETE FROM articles WHERE article_id =  $current_article_id";


            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

        }



?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">

            <h1>Your articles</h1>
            <table>
                <?php
                // fetch all the orders

                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM articles where author = $user_id ORDER BY date DESC";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $currentaID = $row["article_id"];
                        echo "<tr>";

                            echo "<td>";
            				            echo "<a href='article.php?article_id=" .$row['article_id'] . "'>". "<h3>" . $row['title'] . "</h3>" . "</a>";
                            echo "</td>";

                            echo "<td>";
                                echo '<form method="get" action="edit_article.php" >';
                                    echo "<input type='text' name='editForward' value='$currentaID' class='hide'>";
                                        echo '<input type="submit" name="edit" value="Edit">';
                                echo '</form>';
                            echo "</td>";

                            echo "<td>";
                                echo '<form method="post" action="dashboard.php" >';
                                        echo "<input type='text' name='deleteForward' value='$currentaID' class='hide'>";
                                        echo '<input type="submit" name="delete" value="Delete">';
                                echo '</form>';

                            echo "</td>";



                        echo "</tr>";

        			}
                    // close the connection
        			$result -> close();
                 ?>

             </table>
        </section>
    </div>
</body>
</html>
