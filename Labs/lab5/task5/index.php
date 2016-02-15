<?php
$data = file_get_contents("data.txt");

$ret = array_map (
  function ($_) {return explode (', ', $_);},

  explode ('\n', $data)

);

// $ret["name"] = $ret["1"];
// unset($ret["1"]);

echo '<pre>';
print_r ($ret);
echo '</pre>';
 ?>
