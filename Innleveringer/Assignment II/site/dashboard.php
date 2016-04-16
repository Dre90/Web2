<?php
    include_once 'include/head.php';
    require_once 'connect.php';
    require_once 'functions.php';

    if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
        header('Location: login.php');

        // open the connection
        $db_server=getDB();

        $current_article_id = $deletemsg = $deleteImage = "";
        if(isset($_POST['delete'])) {
            if (isset($_POST['confirm'])) {
                $current_article_id = $_POST['deleteForward'];
                $deleteImage = $_POST['deleteImage'];
                $query = "DELETE FROM articles WHERE article_id =  $current_article_id";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                unlink($deleteImage);
            }else {
                $deletemsg .= "Please check confirm first";
            }
        }

        if(isset($_POST['edit'])) {
            // regenerate the session id
			session_regenerate_id();

			// set session parameters
            $_SESSION['article_id'] = $_POST['editForward'];
            redirect("edit_article.php");
        }
        $info = "<h3>You have not uploaded any articles yet. Go to the <a href='upload.php'>upload article</a> page to do that.</h3>";
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <div class="grid grid-pad">
                <div class="col-7-12">
                    <h1>Your articles</h1>

                </div>
                <div class="col-5-12">
                    <h3 class="float-right error"><?php echo $deletemsg ?></h3>
                </div>

            </div>

            <table>
                <?php
                    echo "<tr>";
                        echo "<td>";
                            echo "<h3>Title</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>Likes</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>Edit</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>Delete category</h3>";
                        echo "</td>";
                    echo "</tr>";

                    // fetch all the articles
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM articles WHERE author = $user_id ORDER BY date DESC";
                    $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

                        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                            $info = "";

                            $article_id = $row["article_id"];
                            $title = $row["title"];
                            $rating = $row["rating"];
                            $image_path = $row["image_path"];
                            echo "<tr>";
                                echo "<td>";
        				            echo "<a href='article.php?article_id=" . $article_id . "'>". "<h4>" . $title . "</h4>" . "</a>";
                                echo "</td>";
                                echo "<td>";
        				            echo "<h3>" . $rating . "</h3>";
                                echo "</td>";
                                echo "<td>";
                                    echo '<form method="post" action="dashboard.php" >';
                                        echo "<input type='text' name='editForward' value='$article_id' class='hide'>";
                                            echo '<input type="submit" name="edit" value="Edit">';
                                    echo '</form>';
                                echo "</td>";
                                echo "<td>";
                                    echo '<form method="post" action="dashboard.php" >';
                                        echo "<input type='checkbox' name='confirm' value='Confirmed'> Check to confirm";
                                        echo "<input type='text' name='deleteForward' value='$article_id' class='hide'>";
                                        echo "<input type='text' name='deleteImage' value='$image_path' class='hide'>";
                                        echo '<input type="submit" name="delete" value="Delete">';
                                    echo '</form>';
                                echo "</td>";
                            echo "</tr>";
            			}
                        // close the connection
            			$db_server -> close();
                 ?>
             </table>
             <?php echo $info; ?>
        </section>
    </div>
</body>
</html>
