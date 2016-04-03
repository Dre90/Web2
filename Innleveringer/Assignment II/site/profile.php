<?php
require_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
	header('Location: login.php');

$db_server=getDB();
//gets the user_id from session
$user_id = $_SESSION['user_id'];

//Fills out the profile
$query = "SELECT * FROM users where user_id = $user_id";
$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

$profileusername = $profilemail = $profilefirstname = $profilelastname = "";
while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
	$profileusername = $row["username"];
	$profilemail = $row["mail"];
	$profilefirstname = $row["firstname"];
	$profilelastname = $row["lastname"];
}


// Update profile
$usernameErr = $emailErr = $passErr = $firstnameErr = $lastnameErr = "";
$username = $mail = $pass = $firstname = $lastname = $registered = $msg = "";
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
		$query = "UPDATE users
				  SET username='$username', mail='$mail', firstname='$firstname', lastname='$lastname'
				  WHERE user_id='$user_id'";

		$db_server->query($query) or die($db_server->error);

		$msg .= "Your information has been updatet <br>";
    }
}

// Update password
$passOK = 1;

if (isset($_POST['updatePass'])) {

    if (empty($_POST["oldPassword"])) {
        $msg .= "Old password is required <br>" ;
		$passOK = 0;

    } else {
        $oldpassword = $_POST['oldPassword'];

    }

	if (empty($_POST["newPassword"])) {
        $msg .= "New password is required <br>";
		$passOK = 0;

    } else {
        $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    }

	if ($passOK == 1) {
		$result = $db_server -> query("SELECT user_id, user_type, username, mail, password, firstname, lastname FROM users WHERE username='$username'");

		if ($result -> num_rows != 0) {
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			if (password_verify($oldpassword, $row['password'])) {

			    	$query = "UPDATE users
							  SET password='$newPassword'
							  WHERE user_id='$user_id'";

			    	$db_server->query($query) or die($db_server->error);

			    	$msg .= "Your information has been updatet <br>";
					//Need ajax to update profile form


			} else {
				$msg .= "Old password do not match the saved password <br>";
			}
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

            <div class='col-8-12'>

				<h2>Profile</h2>
				<div class="profile">
	                <form method="post" action="profile.php" onsubmit="return validate(this);">
	                    <label for="username">Username</label>    <span class="error"> <?php echo $usernameErr;?></span>
	                    <input type="text" name="username" value="<?php echo $profileusername;?>">
	                    <label for="email">E-mail</label><span class="error"> <?php echo $emailErr;?></span>
	                    <input type="email" name="email" value="<?php echo $profilemail;?>">
	                    <label for="firstname">Firstname</label><span class="error"> <?php echo $firstnameErr;?></span>
	                    <input type="text" name="firstname" value="<?php echo $profilefirstname;?>">
	                    <label for="lastname">Lastname</label><span class="error"> <?php echo $lastnameErr;?></span>
	                    <input type="text" name="lastname" value="<?php echo $profilelastname;?>">
	                    <input type="submit" name="submit" value="Update information">
	                </form>
				</div>
				<div class="password">
					<form method="post" action="profile.php" onsubmit="return validate(this);">
	                    <label for="oldPassword">Old password</label>
	                    <input type="text" name="oldPassword">
						<label for="newPassword">New password</label>
	                    <input type="text" name="newPassword">
	                    <input type="submit" name="updatePass" value="Update password">
	                </form>
				</div>
            </div>
            <div class='col-4-12'>
				<p>
					<?php echo $msg;?>
				</p>
				<p id="error">

                </p>

				
            </div>

        </section>
    </div>
</body>
</html>
