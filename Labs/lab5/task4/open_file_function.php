<?php
    function open_file($text){
        if( file_exists("data.txt") )
            $fh = fopen("data.txt", 'r+') or die ('Failed!');

            fseek($fh, 0, SEEK_END);

            fwrite($fh, $text) or die();

            fclose($fh);
    };
 ?>
