<?php
require_once 'include/head.php';
require_once 'connect.php';
include_once 'functions.php';

if (!isset($_SESSION['isloggedin']) OR $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] OR $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'])
	header('Location: login.php');

    // open the connection
    $db_server=getDB();

    //gets the user_id from session
    $user_id = $_SESSION['user_id'];

    $titleErr = $categoryErr = $textErr = $imgErr = $msg = "";
    $todaysDate = date("Y-m-d");
    if(isset($_POST['submit']))
    {
        $registerOk = 1;

        if (empty($_POST["title"])) {
            $titleErr = "Title is required";
            $registerOk = 0;
        } else {
            $title = get_post('title', $db_server);
        }
        if (empty($_POST["category"])) {
            $categoryErr = "You need to choose a category";
            $registerOk = 0;
        } else {
            $category = get_post('category', $db_server);
        }
        if (empty($_POST["text"])) {
            $textErr = "Text is required";
            $registerOk = 0;
        } else {
            $text = get_post('text', $db_server);
        }

        if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
        {
            $imgErr = "Please select an image.";
            $registerOk = 0;
        }
        else
        {
            $image= addslashes($_FILES['image']['tmp_name']);
            $name= addslashes($_FILES['image']['name']);
            $image= file_get_contents($image);
            $image= base64_encode($image);
        }

        if ($registerOk == 1) {
            $todaysDate = date("Y-m-d");
            $query = "INSERT INTO articles (title, category, date, text, image_name, image, author) VALUES ('$title', '$category', '$todaysDate', '$text', '$name','$image', $user_id)";

            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
            if($result)
            {
                $msg .= "The article has been uploaded";
            }
        }
    }
?>
<body>
    <div class="wrapper">
        <?php  include 'include/header.php'; ?>

        <section class="grid grid-pad">

            <div class='col-8-12'>
				<h2>Profile</h2>
	                <form method="post" enctype="multipart/form-data" action="upload.php" onsubmit="return validate(this);">
	                    <label for="title">Title</label><span class="error"> <?php echo $titleErr;?></span>
	                       <input type="text" name="title">
                        <label for="category">Choose a category</label><span class="error"> <?php echo $categoryErr;?></span>
                            <select name="category">
                                "<option value=''>Choose a category</option>"
                                <?php
                                   //Fills out category list
                                    $query = "SELECT * FROM category";
                                    $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

                                    $category_id = $category_name = "";
                                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                                        $category_id = $row["category_id"];
                                        $category_name = $row["category_name"];
                                        echo "<option value='$category_id'>" . $category_name . "</option>";
                                    }
                                ?>
                            </select>
                        <label for="image">Image</label><span class="error"> <?php echo $imgErr;?></span>
                            <input type="file" name="image">
                        <label for="text">Text</label><span class="error"> <?php echo $textErr;?></span>
                            <textarea name="text" ></textarea>
	                    <input type="submit" name="submit" value="Upload article">
	                </form>
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
<?php // close the connection
$db_server -> close(); ?>
