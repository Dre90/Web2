<?php
    if(!isset($_SESSION['isloggedin'])) {include 'include/nav_not_logged_in.php';}
    if(isset($_SESSION['isloggedin']) && $_SESSION['user_type'] == 1) {include 'include/nav_logged_in_admin.php';}
    if(isset($_SESSION['isloggedin']) && $_SESSION['user_type'] == 2) {include 'include/nav_logged_in.php';}
?>
