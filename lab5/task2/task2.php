<?php

$birthday=strtotime("26 october");
$d2=ceil(($birthday-time())/60/60/24);

echo "<p>Birthday countdown</p>";
echo "There are " . $d2 ." days until my birthday.";

 ?>
