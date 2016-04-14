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

    $titleErr = $categoryErr = $textErr = $imgErr = $msg = $imgMsg = $image = "";
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
		if (empty($_FILES["fileToUpload"]["name"])) {
			$imgErr = "Please select an image.";
			$registerOk = 0;
		} else {

			if (getimagesize($_FILES['fileToUpload']['tmp_name']) == FALSE) {
				$imgErr = "Please select an image.";
				$registerOk = 0;
			} else {
				$uploadOk = 1;
				$target_dir = "article_images/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				$imagename=date("d-m-Y")."-".time(). "." . $imageFileType;
				$target_path = $target_dir.$imagename;

				if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        $imgMsg .=  "File is not an image. <br>";
			        $uploadOk = 0;
			    }

				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
				    $imgMsg .=  "Sorry, your file is too large. <br>";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    $imgMsg .=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    $imgMsg .=  "Sorry, your file was not uploaded. <br>";
					$registerOk = 0;
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_path)) {
						$image = $target_path;
						$registerOk = 1;
				    } else {
				        $imgMsg .=  "Sorry, there was an error uploading your file. <br>";
						$registerOk = 0;
				    	}
				}
			}
		}
        if ($registerOk == 1) {
            $todaysDate = date("Y-m-d");
            $query = "INSERT INTO articles (title, category, date, text, image_path, author) VALUES ('$title', '$category', '$todaysDate', '$text', '$image', $user_id)";

            $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
            if($result)
            {
                $msg .= "The article has been uploaded";
				$_SESSION['last_activity'] = time();
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
				<!-- onsubmit="return validate(this);" -->
	                <form method="post" enctype="multipart/form-data" action="upload.php" >
	                    <label for="title">Title</label><span class="error"> <?php echo $titleErr;?></span>
	                       <input type="text" name="title">
                        <label for="category">Category</label><span class="error"> <?php echo $categoryErr;?></span>
                            <select name="category">
                                <option value=''>Choose a category</option>
                                <?php
                                   //Fills out category list
                                    $query = "SELECT * FROM categorys";
                                    $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);

                                    $category_id = $category_name = "";
                                    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                                        $category_id = $row["category_id"];
                                        $category_name = $row["category_name"];
                                        echo "<option value='$category_id'>" . $category_name . "</option>";
                                    }
                                ?>
                            </select>
							<label for="fileToUpload">Image</label><span class="error"> <?php echo $imgErr;?></span>
								<input type="file" name="fileToUpload" >
								<?php echo $imgMsg; ?>


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
