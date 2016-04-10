<?php
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

    if (empty($_FILES["fileToUpload"]["name"])) {
        $image = $image_path;
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

        $query = "UPDATE articles
                  SET title='$title', category='$category', date='$todaysDate', text='$text', image_path='$image'
                  WHERE article_id = $article_id ";

        $result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
        if($result)
        {
            $msg .= "The article has been saved";
        }
    }
}
 ?>
