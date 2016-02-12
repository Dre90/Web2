<?php
    function overwrite_file(){
        if( file_exists("data.txt") )
            $fh = fopen("data.txt", 'w') or die ('Failed!');
            $text = "\n";

            fwrite($fh, $text) or die();

            fclose($fh);
    };
 ?>
