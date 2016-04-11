<?php
include_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
    header('Location: login.php');

    $db_server=getDB();
    $current_article_id = $deletemsg ="";
        if(isset($_POST['delete'])) {
            if (isset($_POST['confirm'])) {
                $current_article_id = $_POST['deleteForward'];
                $query = "DELETE FROM articles WHERE article_id =  $current_article_id";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
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
                    <h3 class="float-right error"><?php echo $deletemsg ?></h3>
                </div>
            </div>
            <table>
                <?php
                echo "<tr>";
                    echo "<th colspan='3'>";
                    echo "<h2>Your articles</h2>";
                    echo "</th>";
                echo "</tr>";
                // fetch all the orders

                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM articles where author = $user_id ORDER BY date DESC";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $article_id = $row["article_id"];
                        echo "<tr>";

                            echo "<td>";
            				            echo "<a href='article.php?article_id=" .$row['article_id'] . "'>". "<h3>" . $row['title'] . "</h3>" . "</a>";
                            echo "</td>";

                            echo "<td>";
                                echo '<form method="post" action="htmlspecialchars($_SERVER["PHP_SELF"])" >';
                                    echo "<input type='text' name='editForward' value='$article_id' class='hide'>";
                                        echo '<input type="submit" name="edit" value="Edit">';
                                echo '</form>';
                            echo "</td>";

                            echo "<td>";
                                echo '<form method="post" action="htmlspecialchars($_SERVER["PHP_SELF"])" >';
                                        echo "<input type='checkbox' name='confirm' value='Confirmed'> Check to confirm";
                                        echo "<input type='text' name='deleteForward' value='$article_id' class='hide'>";
                                        echo '<input type="submit" name="delete" value="Delete">';
                                echo '</form>';


                            echo "</td>";



                        echo "</tr>";

        			}

                    echo "<tr>";
                        echo "<th colspan='3'>";
                        echo "<h2>All articles</h2>";
                        echo "</th>";
                    echo "</tr>";

                    $query = "SELECT * FROM articles ORDER BY date DESC";
                    $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                            $article_id = $row["article_id"];
                            echo "<tr>";

                                echo "<td>";
                				            echo "<a href='article.php?article_id=" .$row['article_id'] . "'>". "<h3>" . $row['title'] . "</h3>" . "</a>";
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
