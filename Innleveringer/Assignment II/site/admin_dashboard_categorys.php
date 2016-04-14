<?php
include_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
    header('Location: login.php');

    $db_server=getDB();
    $current_category_id = $deletemsg ="";
        if(isset($_POST['delete'])) {
            if (isset($_POST['confirm'])) {
                $current_category_id = $_POST['deleteForward'];
                $query = "DELETE FROM categorys WHERE category_id =  $current_category_id";
                // $success = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

                try {
                $success = $db_server -> query($query);

                // if FOREIGN KEY set category to 1 = Uncategorized
                if (!$success) {
                    $query = "UPDATE articles
        					  SET category='1'
        					  WHERE category =  $current_category_id";

                    $result = $db_server -> query($query) or die('Query failed: ' . $db_server -> error);


                    $query = "DELETE FROM categorys WHERE category_id =  $current_category_id";
                    $success = $db_server -> query($query) or die('Query failed: ' . $db_server -> error);
                }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }else {
                $deletemsg .= "Please check confirm first";
            }
        }

        if(isset($_POST['addCategory'])) {
            $category = $_POST['addCategoryInput'];
            // create table
            $query = "INSERT INTO categorys(category_name)
            		  VALUES($category)";
            $db_server->query($query) or die('Query failed5:' . $db_server->error);
        }
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <div class="grid grid-pad">
                <div class="col-6-12">
                    <h1>Admin dashboard - Categorys</h1>
                </div>
                <div class="col-6-12">
                    <h3 class="float-left error"><?php echo $deletemsg ?></h3>
                </div>
            </div>
            <div class="grid grid-pad">
                <div class="col-6-12">
                    <form method="post" action="admin_dashboard_categorys.php" >
                        <label for="addCategory"></label>
                            <input type="text" name="addCategoryInput">
                            <input type="submit" name="addCategory" value="Add category">
                    </form>
                </div>
                <div class="col-6-12">
                </div>
            </div>
            <table>
                <?php
                echo "<tr>";
                    echo "<th colspan='3'>";
                    echo "<h2>Categorys</h2>";
                    echo "</th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>";
                                echo "<h3>CategoryID</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>Category name</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>Delete category</h3>";
                    echo "</td>";

                echo "</tr>";
                // fetch all the orders



                $query = "SELECT * FROM categorys ORDER BY category_name ASC";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                        echo "<tr>";

                            echo "<td>";
            				            echo $category_id;
                            echo "</td>";
                            echo "<td>";
            				            echo $category_name;
                            echo "</td>";

                            echo "<td>";
                                echo '<form method="post" action="admin_dashboard_categorys.php" >';
                                        echo "<input type='checkbox' name='confirm' value='Confirmed'> Check to confirm";
                                        echo "<input type='text' name='deleteForward' value='$category_id' class='hide'>";
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
