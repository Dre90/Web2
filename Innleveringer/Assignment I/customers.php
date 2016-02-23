<!-- The first php file is named ’customers.php’, and when called it should first display the total
number of customers and accounts first, then a table of customers. The table should include
at least the basic information, the number of accounts, associated account information, and
total amount of assets (i.e., the total amount of money in different accounts) for each customer. -->
<?php
require 'functions/get_costumers_function.php';
require 'functions/get_accounts_function.php';
//require 'classes/customer_class.php';

// $csv_data = file_get_contents('data/customers.csv'); // Get the file content
// $lines = explode("\n", $csv_data); // Get the lines
// $head = str_getcsv(array_shift($lines)); // Get the head
//
// foreach ($lines as $line) {
//     $row = array_pad(str_getcsv($line), count($head), '');
//     $array[] = array_combine($head, $row);
// }
//
// array_pop($array); //removes the last empty element of the array
//
// $costumersArray = array();
// $tall = 0;
// foreach ($array as $value) {
//     $costumer = new customer($array[$tall]["name"], $array[$tall]["surname"], $array[$tall]["birthdate"], $array[$tall]["address"], $array[$tall]["totalAssets"]);
//
//     array_push($costumersArray, $costumer);
//
//     $tall++;
// }


// require 'classes/account_class.php';
// $csv_data = file_get_contents('data/accounts.csv'); // Get the file content
// $lines = explode("\n", $csv_data); // Get the lines
// $head = str_getcsv(array_shift($lines)); // Get the head
//
// foreach ($lines as $line) {
//     $row = array_pad(str_getcsv($line), count($head), '');
//     $array[] = array_combine($head, $row);
// }
//
// array_pop($array); //removes the last empty element of the array
//
// $accountArray = array();
// $tall = 0;
// foreach ($array as $value) {
//     $account = new account($array[$tall]["accountHolder"], $array[$tall]["accountNumber"], $array[$tall]["currencyType"], $array[$tall]["balance"], $array[$tall]["withdrawals"], $array[$tall]["deposits"]);
//
//     array_push($accountArray, $account);
//
//     $tall++;
// }


$costumersArray = get_costumers();
$accountArray = get_accounts();

echo "<br>";echo "<br>";

$tall1 = 0;
foreach ($costumersArray as $value) {
    echo $costumersArray[$tall1]->get_name();
    echo "<br>";

    $tall1++;
}
//echo $costumersArray[0]->get_name();
echo "<br>";echo "<br>";
echo customer::$customerCount;
echo "<br>";echo "<br>";

$tall2 = 0;
foreach ($accountArray as $value) {
    echo $accountArray[$tall2]->get_deposits();
    echo "<br>";

    $tall2++;
}
//echo $costumersArray[0]->get_name();
echo "<br>";echo "<br>";
echo account::$accountCount;



 ?>
