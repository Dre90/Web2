<?php
function multiexplode ($delimiters,$string) {
    $ary = explode($delimiters[0],$string);
    array_shift($delimiters);
    if($delimiters != NULL) {
        foreach($ary as $key => $val) {
             $ary[$key] = multiexplode($delimiters, $val);
        }
    }
    return  $ary;
}

// Example of use
$string = file_get_contents("data.txt");
$delimiters = Array("Employee", "Student", ", ");

$res = multiexplode($delimiters,$string);

echo '<pre>';
print_r($res);
echo '</pre>';



// $res = explode(",", $string);
//
// echo '<pre>';
// print_r($res);
// echo '</pre>';
 ?>
