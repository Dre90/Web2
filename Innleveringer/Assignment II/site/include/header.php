<?php   if(!isset($_SESSION['isloggedin'])) {include 'include/nav_not_logged_in.php';} ?>
<?php  if(isset($_SESSION['isloggedin'])) {include 'include/nav_logged_in.php';} ?>
