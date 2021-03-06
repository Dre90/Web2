<?php
require_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

$db_server=getDB();

$usernameErr = $passErr = $username = $msg = "";
if (!isset($_SESSION['isloggedin']) && isset($_POST['login'])) {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";

    } else {
        $username = get_post('username', $db_server);
    }
    if (empty($_POST["password"])) {
        $passErr = "Password is required";

    } else {
        $password = $_POST['password'];
    }


	$result = $db_server -> query("SELECT user_id, user_type, username, mail, password, firstname, lastname FROM users WHERE username='$username'");

	if ($result -> num_rows != 0) {
		$row = $result -> fetch_array(MYSQLI_ASSOC);
		if (password_verify($password, $row['password'])) {


			// regenerate the session id
			session_regenerate_id();

			// set session parameters
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type'] = $row['user_type'];
			$_SESSION['username'] = $username;
            $_SESSION['mail'] = $row['mail'];
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname'];
			$_SESSION['isloggedin'] = TRUE;
            $_SESSION['last_activity'] = time();
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];

            redirect("index.php", false);
		} else {
		    
		}
	}
}
// close the connection
$db_server -> close();
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">
            <div class='col-2-12'>
            </div>
            <div class='col-6-12'>
                <h2>Log in</h2>
                <form method="post" action="login.php" onsubmit="return validateLogin(this);">
                    <label for="username">Username</label> <span class="error"><?php echo $usernameErr;?></span>
                        <input type="text" name="username" autofocus>

                    <label for="password">Password</label> <span class="error"><?php echo $passErr;?></span>
                        <input type="password" name="password">

                    <input type="submit" name="login" value="Log in">
                </form>

            </div>
            <div class='col-4-12'>
                <p id="error" class="error">


                <?php echo $msg ?>

                <?php
                // if not logged in
                if(!isset($_SESSION['isloggedin'])){
                	// if wrong user name and password is provided
                	if(isset($_POST['login']))
                		echo "Wrong username or password!";

                    }else{
                        redirect("index.php", false);
                    }
                    ?>
                    </p>
            </div>
        </section>
    </div>
</body>
</html>
