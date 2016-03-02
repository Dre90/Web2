<?php
    function open_file($filePath,$text){
        if( file_exists($filePath) ) {
            $fh = fopen($filePath, 'w+') or die ('Failed!');

            fwrite($fh, $text) or die();

            fclose($fh);
            }
    };
 ?>
