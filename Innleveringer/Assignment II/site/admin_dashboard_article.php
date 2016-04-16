<?php
    include_once 'include/head.php';
    require_once 'connect.php';
    include_once 'functions.php';

    if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
        header('Location: login.php');

        // open the connection
        $db_server=getDB();

        // Delete
        $current_article_id = $deletemsg = $deleteImage = $msg = "";
        if(isset($_POST['delete'])) {
            if (isset($_POST['confirm'])) {
                $current_article_id = $_POST['deleteForward'];
                $deleteImage = $_POST['deleteImage'];
                $query = "DELETE FROM articles WHERE article_id =  $current_article_id";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                unlink($deleteImage);
                $msg .= "Article deleted";
            }else {
                $deletemsg .= "Please check confirm first";
            }
        }

        // Edit
        if(isset($_POST['edit'])) {
            // regenerate the session id
			session_regenerate_id();

			// set session parameters
            $_SESSION['article_id'] = $_POST['editForward'];
            redirect("edit_article.php");
        }
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <div class="grid grid-pad">
                <div class="col-7-12">
                    <h1>Admin dashboard - Articles</h1>
                </div>
                <div class="col-5-12">
                    <h3 class="float-right error"><?php echo $deletemsg; echo $msg; ?></h3>
                </div>
            </div>
            <table>
                <?php
                    echo "<tr>";
                        echo "<th colspan='4'>";
                        echo "<h2>Your articles</h2>";
                        echo "</th>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<h3>Title</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>Category</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>Edit</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>Delete</h3>";
                        echo "</td>";
                    echo "</tr>";

                    // fetch all the articles
                    $user_id = $_SESSION['user_id'];
                    $query =    "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_path,  a.author, a.rating, c.category_id, c.category_name
                                FROM articles as a
                                INNER JOIN categorys as c
                                ON a.category=c.category_id
                                WHERE author = $user_id
                                ORDER BY a.date DESC";
                    $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $article_id = $row["article_id"];
                        $title = $row['title'];
                        $category_id = $row['category_id'];
                        $category = $row['category_name'];
                        $image_path = $row["image_path"];
                        echo "<tr>";
                            echo "<td>";
    				            echo "<a href='article.php?article_id=" . $article_id . "'>". "<p>" . $title . "</p>" . "</a>";
                            echo "</td>";
                            echo "<td>";
                                echo "<a href='category.php?category_id=" . $category_id . "'>"."<p>" . $category . "</p>". "</a>";
                            echo "</td>";
                            echo "<td>";
                                echo '<form method="post" action="admin_dashboard_article.php" >';
                                    echo "<input type='text' name='editForward' value='$article_id' class='hide'>";
                                        echo '<input type="submit" name="edit" value="Edit">';
                                echo '</form>';
                            echo "</td>";
                            echo "<td>";
                                echo '<form method="post" action="admin_dashboard_article.php" >';
                                    echo "<input type='checkbox' name='confirm' value='Confirmed'> Check to confirm";
                                    echo "<input type='text' name='deleteForward' value='$article_id' class='hide'>";
                                    echo "<input type='text' name='deleteImage' value='$image_path' class='hide'>";
                                    echo '<input type="submit" name="delete" value="Delete">';
                                echo '</form>';
                            echo "</td>";
                        echo "</tr>";
        			}

                        echo "<tr>";
                            echo "<th colspan='4'>";
                                echo "<h2>All articles</h2>";
                            echo "</th>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>";
                                echo "<h3>Title</h3>";
                            echo "</td>";
                            echo "<td>";
                                echo "<h3>Category</h3>";
                            echo "</td>";
                            echo "<td>";
                                echo "<h3>Edit</h3>";
                            echo "</td>";
                            echo "<td>";
                                echo "<h3>Delete</h3>";
                            echo "</td>";
                        echo "</tr>";

                        $query =    "SELECT a.article_id, a.title, a.date, a.category, a.text, a.image_path,  a.author, a.rating, c.category_id, c.category_name
                                    FROM articles as a
                                    INNER JOIN categorys as c
                                    ON a.category=c.category_id
                                    ORDER BY a.date DESC";
                        $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                            $article_id = $row["article_id"];
                            $title = $row['title'];
                            $category_id = $row['category_id'];
                            $category = $row['category_name'];
                            $image_path = $row["image_path"];

                            echo "<tr>";
                                echo "<td>";
        				            echo "<a href='article.php?article_id=" . $article_id . "'>". "<p>" . $title . "</p>" . "</a>";
                                echo "</td>";
                                echo "<td>";
        				            echo "<a href='category.php?category_id=" . $category_id . "'>"."<p>" . $category . "</p>". "</a>";
                                echo "</td>";
                                echo "<td>";
                                    echo '<form method="post" action="dashboard.php" >';
                                        echo "<input type='text' name='editForward' value='$article_id' class='hide'>";
                                        echo '<input type="submit" name="edit" value="Edit">';
                                    echo '</form>';
                                echo "</td>";
                                echo "<td>";
                                    echo '<form method="post" action="admin_dashboard_article.php" >';
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
        </section>
    </div>
</body>
</html>
