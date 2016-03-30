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
                $query = "INSERT INTO articles (title, category, date, text, image_name, image, author, rating) VALUES ('FREDRIK ØKSNEVAD SATSER PÅ FLERE KONTINENT!', '1', '2016-03-30', 'En av Norges aller største talent innenfor drifting, skal kjøre MYE i år. Det blir full satsing på Rogalendingen i Drift Allstars, som kjører rundene sine over tre kontinenter denne sesongen. Første tur ut er Abu Dhabi i De forente arabiske emirater! Bilen ble sendt avgårde i container fra Rotterdam for noen uker siden, forhåpentligvis er den fremme i passe god tid til løpet som er 7-8.april.', '$name','$image', 1, 0)";

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
                    echo '<img src="data:image;base64,'.$row[2].' "> ';
                }
                mysql_close($con);
            }
        ?>
    </body>
</html>
