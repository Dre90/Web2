<?php
require 'person_class.php';
require 'overwrite_file_function.php';
require 'open_file_function.php';

$people = array(
    new student("Mark", "Weiser", 21, 120.65),
    new student("Alice", "Karl", 20, 200.122),
    new employee("Jony", "White", 25, 12.522),
    new student("Ida", "Red", 22, 40.98),
    new employee("June", "Greed", 18, 70)
);

overwrite_file();

$arrlength = count($people);
for($x = 0; $x < $arrlength; $x++) {
    $text = $people[$x]->get_title() . ", " .
    $people[$x]->get_name() . ", " .
    $people[$x]->get_surname() . ", " .
    $people[$x]->get_age() . ", " .
    $people[$x]->get_balance() . "\n";
    open_file($text);
}

echo "<pre>";
echo file_get_contents("data.txt");
echo "<pre>";

?>
