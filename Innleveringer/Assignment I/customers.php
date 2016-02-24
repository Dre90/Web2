<!-- The first php file is named ’customers.php’, and when called it should first display the total
number of customers and accounts first, then a table of customers. The table should include
at least the basic information, the number of accounts, associated account information, and
total amount of assets (i.e., the total amount of money in different accounts) for each customer. -->
<html>
<head>
<style>
table tr td {
    border: 1px solid black;
}
</style>

</head>
<?php
require 'functions/get_costumers_function.php';
require 'functions/get_accounts_function.php';
require 'functions/get_transactions_function.php';

$costumersArray = get_costumers();
$accountArray = get_accounts();
$transactionArray = get_transactions();

echo "Total of customers: " . customer::$customerCount;
echo "<br>";
echo "Total of accounts: " . account::$accountCount;
echo "<br>";


$tall1 = 0;
echo "<table>";

foreach ($costumersArray as $value) {
    echo "<tr>";
        echo "<td>" . $costumersArray[$tall1]->get_name() . "<td>";

        echo "<td>" . $costumersArray[$tall1]->get_surname() . "<td>";

    echo "</tr>";
    $tall1++;
}
echo "</table>";

// $tall1 = 0;
// foreach ($costumersArray as $value => $x_value) {
//     echo $costumersArray[$tall1]->get_name();
//     echo "<br>";
//
//
//     $tall1++;
// }
// //echo $costumersArray[0]->get_name();
// echo "<br>";echo "<br>";
// echo customer::$customerCount;
// echo "<br>";echo "<br>";
//
// $tall2 = 0;
// foreach ($accountArray as $value) {
//     echo $accountArray[$tall2]->get_deposits();
//     echo "<br>";
//
//     $tall2++;
// }
// //echo $costumersArray[0]->get_name();
// echo "<br>";echo "<br>";
// echo account::$accountCount;
// echo "<br>";echo "<br>";
//



 ?>
</html>
