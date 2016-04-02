<?php
include_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

$db_server=getDB();

$usernameErr = $emailErr = $passErr = $firstnameErr = $lastnameErr = "";
$username = $mail = $pass = $firstname = $lastname = $registered = "";
// if form is submitted
if(isset($_POST['submit'])){
    $registerOk = 1;
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
        $registerOk = 0;
    } else {
        $username = get_post('username', $db_server);
    }
    if (empty($_POST["email"])) {
        $emailErr = "E-mail is required";
        $registerOk = 0;
    } else {
        $mail = get_post('email', $db_server);
    }
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
        $registerOk = 0;
    } else {
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    if (empty($_POST["firstname"])) {
        $firstnameErr = "Firstname is required";
        $registerOk = 0;
    } else {
        $firstname = get_post('firstname', $db_server);
    }
    if (empty($_POST["lastname"])) {
        $lastnameErr = "Lastname is required";
        $registerOk = 0;
    } else {
        $lastname = get_post('lastname', $db_server);
    }

    if ($registerOk == 1) {
    	$query = "INSERT INTO users(user_type, username, mail, password, firstname, lastname) VALUES(2, '$username', '$mail', '$pass', '$firstname', '$lastname')";
    	$db_server->query($query) or die($db_server->error);
    	$registered = "The user has been registered! You can now <a href='login.php'>log in</a>.";
    }
}

// close the connection
$db_server -> close();
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">

            <div class='col-8-12'>
                <h2>Registration Form</h2>
                <h3 class="success"><?php echo $registered;?></h3>
                <form method="post" action="register.php" onsubmit="return validate(this);">
                    <label for="username">Username</label><span class="error"> * <?php echo $usernameErr;?></span>
                    <input type="text" name="username">
                    <label for="email">E-mail</label><span class="error"> * <?php echo $emailErr;?></span>
                    <input type="email" name="email">
                    <label for="password">Password</label><span class="error"> * <?php echo $passErr;?></span>
                    <input type="text" name="password">
                    <label for="firstname">Firstname</label><span class="error"> * <?php echo $firstnameErr;?></span>
                    <input type="text" name="firstname">
                    <label for="lastname">Lastname</label><span class="error"> * <?php echo $lastnameErr;?></span>
                    <input type="text" name="lastname">
                    <input type="submit" name="submit" value="Register">
                </form>

            </div>
            <div class='col-4-12'>
                <p id="error">

                </p>
            </div>
        </section>
    </div>
</body>
</html>
