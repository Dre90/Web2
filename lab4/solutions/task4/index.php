<?php
/* PROGRAMMING FOR WEB II
   LAB 4 / TASK 4 ANSWER */

//require files
require_once ("person_class.php");
require_once ("car_class.php");

//create a person and car objects
$person = new Person("Mike");
$car = new Car("1234", $person);
//set the car for person
$person -> set_owned_car($car);

//print objects
print_r($person);
echo "<br><br>";
print_r($car);
echo "<br><br>";

//print by public methods
echo $person -> get_name() . " has a car with plate number " . $person -> get_owned_car() -> get_plate_number();
echo "<br><br>";
echo "The car with plate number " . $car -> get_plate_number() . " belongs to " . $car -> get_owner() -> get_name();
?>
