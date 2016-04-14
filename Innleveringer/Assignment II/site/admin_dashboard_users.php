<?php
include_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
    header('Location: login.php');

    $db_server=getDB();
    $current_user_id = $deletemsg = $msg ="";
        if(isset($_POST['delete'])) {
            if (isset($_POST['confirm'])) {
                $current_user_id = $_POST['deleteForward'];
                $query = "DELETE FROM users WHERE user_id =  $current_user_id";
                try {
                $success = $db_server -> query($query);

                // if FOREIGN KEY set author to 1 = DeletedUser
                if (!$success) {
                    $query = "UPDATE articles
        					  SET author='1'
        					  WHERE author =  $current_user_id";

                    $result = $db_server -> query($query) or die('Query failed: ' . $db_server -> error);


                    $query = "DELETE FROM users WHERE user_id =  $current_user_id";
                    $success = $db_server -> query($query) or die('Query failed: ' . $db_server -> error);
                    $msg .= "User deleted <br>";
                }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }else {
                $deletemsg .= "Please check confirm first";
            }
        }
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>
        <section class="grid grid-pad">
            <div class="grid grid-pad">
                <div class="col-7-12">
                <h1>Admin dashboard - Users</h1>

                </div>
                <div class="col-5-12">
                    <h3 class="float-right error"><?php echo $deletemsg; echo $msg;?></h3>
                </div>
            </div>
            <table>
                <?php
                echo "<tr>";
                    echo "<th colspan='7'>";
                    echo "<h2>Users</h2>";
                    echo "</th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>";
                                echo "<h3>UserID</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>User type</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>Username</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>Mail</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>Firstname</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>Lastname</h3>";
                    echo "</td>";
                    echo "<td>";
                                echo "<h3>Delete user</h3>";
                    echo "</td>";
                echo "</tr>";

                // fetch all the orders
                $query = "SELECT * FROM users ORDER BY username ASC";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $UserID = $row['user_id'];
                        $User_type = $row['user_type'];
                        $Username = $row['username'];
                        $mail = $row['mail'];
                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];

                        echo "<tr>";

                            echo "<td>";
            				            echo $UserID;
                            echo "</td>";
                            if ($User_type == 1) {
                                echo "<td>";
                				            echo "Admin";
                                echo "</td>";
                            } else {
                                echo "<td>";
                				            echo "User";
                                echo "</td>";
                            }
                            echo "<td>";
            				            echo $Username;
                            echo "</td>";
                            echo "<td>";
            				            echo $mail;
                            echo "</td>";
                            echo "<td>";
            				            echo $firstname;
                            echo "</td>";
                            echo "<td>";
            				            echo $lastname;
                            echo "</td>";

                            echo "<td>";
                                echo '<form method="post" action="admin_dashboard_users.php" >';
                                        echo "<input type='checkbox' name='confirm' value='Confirmed'> Check to confirm";
                                        echo "<input type='text' name='deleteForward' value='$UserID' class='hide'>";
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
