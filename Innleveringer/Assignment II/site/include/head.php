<?php
    session_start();


    // Auto log out after 60 min
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
        // last request was more than 60 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
    }

    // updates last_activity
    $_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online newspaper - Assignment II</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/simplegrid.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <script src="js/validate.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
</head>
