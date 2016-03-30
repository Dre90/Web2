<?php
    ini_set('mysql.connect_timeout',300);
    ini_set('default_socket_timeout',300);
?>
<html>
    <body>
        <form method="post" enctype="multipart/form-data">
        <br/>
            <input type="file" name="image" />
            <br/><br/>
            <input type="submit" name="sumit" value="Upload" />
        </form>
        <?php
        require_once 'connect.php';
            if(isset($_POST['sumit']))
            {
                if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
                {
                    echo "Please select an image.";
                }
                else
                {
                    $image= addslashes($_FILES['image']['tmp_name']);
                    $name= addslashes($_FILES['image']['name']);
                    $image= file_get_contents($image);
                    $image= base64_encode($image);
                    saveimage($name,$image);
                }
            }
            //displayimage();
            function saveimage($name,$image)
            {
                $db_server=getDB();
                $query = "INSERT INTO articles (title, category, date, text, image_name, image, author, rating) VALUES ('Fredric Aasbo and Ken Gushi Gets New Livery for Formula DRIFT 2016', '1', '2016-03-30', 'Last week we dropped a quick snippet of both Aasbo and Gushi’s liveries for 2016 but today we’re unleashing the full renderings for their SR by Toyota competition cars for the Formula Drift series. Both drivers have found amajor tire sponsor with Nexen Tire and are continuing respective partnerships with several companies, including GReddy/TRUST, Rockstar Energy Drink, Garrett, Rocket Bunny, Wisefab, OS Giken and many more.', '$name','$image', 1, 0)";

    			$result = $db_server -> query($query) or die('Query failed:' . $db_server -> error);
                if($result)
                {
                    echo "<br/>Image uploaded.";
                }
                else
                {
                    echo "<br/>Image not uploaded.";
                }
            }
            function displayimage()
            {
                $con=getDB();
                $qry="select * from images";
                $result=mysql_query($qry,$con);
                while($row = mysql_fetch_array($result))
                {
                    echo '<img height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
                }
                mysql_close($con);
            }
        ?>
    </body>
</html>
