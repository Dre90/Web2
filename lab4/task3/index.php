<?php
$months = array (
    array("January",31),
    array("February",28),
    array("March",31),
    array("April",30),
    array("May",31),
    array("June",30),
    array("Juli",31),
    array("August",31),
    array("September",30),
    array("October",31),
    array("November",30),
    array("December",31)
);

function printMonths($months){
    echo "I am the first function and I am printing months array! <br>";
    for ($row = 0; $row < 12; $row++) {
        if ($row == 11) {
            for ($col = 0; $col < 1; $col++) {
                echo $months[$row][$col] . " => " . $months[$row][1]. ". <br>";
            }
        } else {
            for ($col = 0; $col < 1; $col++) {
                echo $months[$row][$col] . " => " . $months[$row][1]. ", <br>";
            }
        }
    }
}

function modifyMonths(&$months){
    global $months;
    echo "I am the second function and a just modifying months array! <br>";
    for ($row = 0; $row < 12; $row++) {
        if ($months[$row][1] > 30) {
            $months[$row][0] = strrev(ucfirst(strrev(strtolower($months[$row][0]))));
        }

    }
}

printMonths($months);
echo "<br>";
modifyMonths($months);
echo "<br>";
printMonths($months);
?>
