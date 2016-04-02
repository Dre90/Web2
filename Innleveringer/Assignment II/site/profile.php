<?php
require_once 'include/head.php';
require_once 'connect.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
	header('Location: login.php');

$db_server=getDB();
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users where user_id = $user_id";
$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

$username = $mail = $pass = $firstname = $lastname = "";
while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
	$username = $row["username"];
	$mail = $row["mail"];
	$pass = password_get_info($row["password"]);
	$firstname = $row["firstname"];
	$lastname = $row["lastname"];
}

// Update password
$passOK = 1;
$oldpassErr = $newpassErr = "";
if (isset($_POST['updatePass'])) {

    if (empty($_POST["oldPassword"])) {
        $oldpassErr = "Old password is required";
		$passOK = 0;

    } else {
        $oldpassword = $_POST['oldPassword'];
    }

	if (empty($_POST["newPassword"])) {
        $newpassErr = "New password is required";
		$passOK = 0;

    } else {
        $newPassword = $_POST['newPassword'];
    }

	if ($passOK == 1) {
		$result = $db_server -> query("SELECT user_id, user_type, username, mail, password, firstname, lastname FROM users WHERE username='$username'");

		if ($result -> num_rows != 0) {
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			if (password_verify($oldpassword, $row['password'])) {


				echo "Old password match";
			} else {
				echo "Old password not match";
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
                <!-- <h3 class="success"><?php echo $registered;?></h3> -->
				<div class="profile">
	                <form method="post" action="profile.php" onsubmit="return validate(this);">
	                    <label for="username">Username</label>    <!--<span class="error"> * <?php echo $usernameErr;?></span>-->
	                    <input type="text" name="username" value="<?php echo $username;?>">
	                    <label for="email">E-mail</label><!--<span class="error"> * <?php echo $emailErr;?></span>-->
	                    <input type="email" name="email" value="<?php echo $mail;?>">
	                    <label for="firstname">Firstname</label><!--<span class="error"> * <?php echo $firstnameErr;?></span>-->
	                    <input type="text" name="firstname" value="<?php echo $firstname;?>">
	                    <label for="lastname">Lastname</label><!--<span class="error"> * <?php echo $lastnameErr;?></span>-->
	                    <input type="text" name="lastname" value="<?php echo $lastname;?>">
	                    <input type="submit" name="submit" value="Update information">
	                </form>
				</div>
				<div class="password">
					<form method="post" action="profile.php" onsubmit="return validate(this);">
	                    <label for="oldPassword">Old password</label><!--<span class="error"> * <?php echo $passErr;?></span>-->
	                    <input type="text" name="oldPassword">
						<label for="newPassword">New password</label><!--<span class="error"> * <?php echo $passErr;?></span>-->
	                    <input type="text" name="newPassword">
	                    <input type="submit" name="updatePass" value="Update password">
	                </form>
				</div>
            </div>
            <div class='col-4-12'>
				<p>
					<?php echo $oldpassErr . "<br>" . $newpassErr;?>
				</p>
				<p id="error">

                </p>
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
