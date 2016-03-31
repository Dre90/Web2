<?php
require_once 'include/head.php';
require_once 'connect.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
	header('Location: login.php');

$db_server=getDB();

// close the connection
$db_server -> close();
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">

            <div class='col-8-12'>
                <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?>

            </div>
            <div class='col-4-12'>

            </div>

        </section>
    </div>
</body>
</html>
<!-- $_SESSION['user_id'] = $row['user_id'];
$_SESSION['user_type'] = $row['user_type'];
$_SESSION['username'] = $username;
$_SESSION['mail'] = $row['mail'];
$_SESSION['firstname'] = $row['firstname'];
$_SESSION['lastname'] = $row['lastname']; -->
