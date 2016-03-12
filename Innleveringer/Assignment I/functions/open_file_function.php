<?php
    function open_file($filePath,$text){
        if( file_exists($filePath) ) {
            $fh = fopen($filePath, 'w+') or die ('Failed!'); //opens the file

            fwrite($fh, $text) or die(); //writes to the file

            fclose($fh); //closes the file
            }
    };
 ?>
