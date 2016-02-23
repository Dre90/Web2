<!-- The first php file is named ’customers.php’, and when called it should first display the total
number of customers and accounts first, then a table of customers. The table should include
at least the basic information, the number of accounts, associated account information, and
total amount of assets (i.e., the total amount of money in different accounts) for each customer. -->
<?php
require 'classes/customer_class.php';

$csv_data = file_get_contents('data/customers.csv'); // Get the file content
$lines = explode("\n", $csv_data);
$head = str_getcsv(array_shift($lines));

// $array = array();
// foreach ($lines as $line) {
//     $array[] = array_combine($head, str_getcsv($line));
// }
foreach ($lines as $line) {
    $row = array_pad(str_getcsv($line), count($head), '');
    $array[] = array_combine($head, $row);
}

array_pop($array);

$costumersArray = array();
$tall = 0;
foreach ($array as $value) {
    $costumer = new customer($array[$tall]["name"], $array[$tall]["surname"], $array[$tall]["birthdate"], $array[$tall]["address"], $array[$tall]["totalAssets"]);

    array_push($costumersArray, $costumer);

    $tall++;
}


// $person = new customer($array[0]["name"], $array[0]["surname"], $array[0]["birthdate"], $array[0]["address"], $array[0]["totalAssets"]);

// $person = new customer("Dag-Roger", "Eriksen", "26.10.1990", "Kauffeldts veg 7 2819 Gjøvik", 10000);
echo "<br>";echo "<br>";
$tall1 = 0;
foreach ($array as $value) {
    echo $costumersArray[$tall1]->get_name();
    echo "<br>";

    $tall1++;
}
//echo $costumersArray[0]->get_name();
echo "<br>";echo "<br>";
echo customer::$customerCount;


echo "<br>";echo "<br>";
print_r($array);

?>

 ?>
