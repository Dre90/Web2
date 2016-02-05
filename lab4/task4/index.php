<?php
    require 'person.php';
    require 'car.php';

    $person = new person("Mike");

    $car = new car(1234, $person);

    $person->set_owned_car($car);

    print_r($person);
    echo "<br>";
    print_r($car);

    echo "<br>";

    print($person->get_name() . " has a car with plate number " . $person->get_owned_car() ->get_plate_number() );

    echo "<br>";

    print("The car with plate number " . $car->get_plate_number() . " belongs to " . $car->get_owner() ->get_name() );
?>
