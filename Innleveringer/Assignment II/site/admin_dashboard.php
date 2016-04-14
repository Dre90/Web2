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
                <h1>Admin dashboard - summary</h1>

                </div>
                <div class="col-5-12">
                    <h3 class="float-right error"><?php echo $deletemsg ?></h3>
                </div>
            </div>

            <section class="grid grid-pad">
                <div class="col-4-12">
                <?php
                $query = "SELECT COUNT(user_id) AS userCount FROM users;";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $userCount = $row['userCount'];
                        echo "<p class='number'>" . "<span class='count'>" . $userCount . "</span>" . "</p>";
                        echo "<p class='numberDescription'> Users </p>";
                    }
                 ?>
                </div>
                <div class="col-4-12">
                <?php
                $query = "SELECT COUNT(article_id) AS articleCount FROM articles;";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $articleCount = $row['articleCount'];
                        echo "<p class='number'>" . "<span class='count'>" . $articleCount . "</span>" . "</p>";
                        echo "<p class='numberDescription'> Articles </p>";
                    }
                 ?>
                </div>
                <div class="col-4-12">
                <?php
                $query = "SELECT COUNT(category_id) AS categoryCount FROM categorys;";
                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $categoryCount = $row['categoryCount'];
                        echo "<p class='number'>" . "<span class='count'>" . $categoryCount . "</span>" . "</p>";
                        echo "<p class='numberDescription'> Categorys </p>";
                    }
                 ?>
                </div>
            </section>
            <section class="grid grid-pad">
                <div class="">
                    <h2>Number of articles in each category</h2>
                </div>


                <?php
                $query = "SELECT c.category_name, a.category, c.category_id, COUNT(a.category) AS categoryCount
                FROM articles as a
                INNER JOIN categorys as c
                ON a.category=c.category_id
                GROUP BY category";

                $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                        $category_name = $row['category_name'];
                        $categoryCount = $row['categoryCount'];
                        echo "<div class='col-4-12'>";
                            echo "<p class='number'>" . "<span class='count'>" . $categoryCount . "</span>" . "</p>";
                            echo "<p class='numberDescription'> $category_name </p>";
                        echo "</div>";
                    }
                 ?>

            </section>
        </section>
    </div>
    <?php // close the connection
    $result -> close(); ?>

    <script>
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
            });
        });
    </script>
</body>
</html>
