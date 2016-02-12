<?php
require 'person_class.php';


//$test = new student("Mark", "Weiser", 21, 120.65);
//print_r($test);

$people = array(
    new student("Mark", "Weiser", 21, 120.65),
    new student("Alice", "Karl", 20, 200.122),
    new employee("Jony", "White", 25, 12.522),
    new student("Ida", "Red", 22, 40.98),
    new employee("June", "Greed", 18, 70)
);

$arrlength = count($people);
for($x = 0; $x < $arrlength; $x++) {
    echo $people[$x]->get_title() . ", ";
    echo $people[$x]->get_name() . ", ";
    echo $people[$x]->get_surname() . ", ";
    echo $people[$x]->get_age() . ", ";
    echo $people[$x]->get_balance();
    echo "<br>";
}

if(file_exists("data.txt"))
    $fh = fopen("data.txt", 'w') or die ('Failed!');
    $text = "First line!\nSecond line\nThird line!";

    fwrite($fh, $text) or die ("Failed!");

    echo "File successfully written!";
 ?>
