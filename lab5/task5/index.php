<?php
$data = file_get_contents("data.txt");

$ret = array_map (
  function ($_) {return explode (',', $_);},
  explode ('\n', $data)
);
echo '<pre>';
print_r ($ret);
echo '</pre>';
 ?>
