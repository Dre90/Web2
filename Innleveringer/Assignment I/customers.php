<!-- The first php file is named ’customers.php’, and when called it should first display the total
number of customers and accounts first, then a table of customers. The table should include
at least the basic information, the number of accounts, associated account information, and
total amount of assets (i.e., the total amount of money in different accounts) for each customer. -->
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}

th {
    padding-top: 20px;

}

th.test {
    padding-top: 7px;
}
tr:nth-child(even) {
    background-color: #eee;
}

tr:nth-child(odd) {
   background-color:#fff;
}
th	{
    background-color: white;

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

// echo "<pre>";
// echo "<br>";echo "<br>";
// print_r($costumersArray);
// echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";
// print_r($accountArray);
// echo "<br>";echo "<br>";
// echo "<br>";echo "<br>";
// print_r($transactionArray);
// echo "<br>";echo "<br>";
// echo "</pre>";

echo "Total of customers: " . customer::$customerCount;
echo "<br>";
echo "Total of accounts: " . account::$accountCount;
echo "<br>";


$costumersArrayLength = count($costumersArray);
$accountArrayLength = count($accountArray);



echo "<table>";
for($x = 0; $x < $costumersArrayLength; $x++) {
    echo "<tr>";
        echo "<th colspan='5'>";
            echo "Costumer";
        echo "</th>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>";
            echo "Name";
        echo "</td>";
        echo "<td>";
            echo "Surname";
        echo "</td>";
        echo "<td>";
            echo "Birthdate";
        echo "</td>";
        echo "<td>";
            echo "Number of accounts";
        echo "</td>";
        echo "<td>";
            echo "Total amount of assets";
        echo "</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>";
            echo $costumersArray[$x]->get_name() ;
        echo "</td>";
        echo "<td>";
            echo $costumersArray[$x]->get_surname() ;
        echo "</td>";
        echo "<td>";
            echo $costumersArray[$x]->get_birthdate() ;
        echo "</td>";
        echo "<td>";
            $nrAccounts = array();
            for($y = 0; $y < $accountArrayLength; $y++) {

                if($accountArray[$y]->get_id() ===  $costumersArray[$x]->get_id()) {
                    $var = $accountArray[$y]->get_id();
                    $nrAccounts[] = $var;
                }
            }
            $occurences = array_count_values($nrAccounts);
            echo $occurences[$costumersArray[$x]->get_id()];
        echo "</td>";
        echo "<td>";
        $totalAssets = 0;
        for($y = 0; $y < $accountArrayLength; $y++) {

            if($accountArray[$y]->get_id() ===  $costumersArray[$x]->get_id()) {
                $totalAssets += $accountArray[$y]->get_balance();
            }
        }
        echo $totalAssets;
        echo "</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<th class='test' colspan='4'>";
            echo "Accounts";
        echo "</th>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>";
            echo "Account Holder";
        echo "</td>";
        echo "<td>";
            echo "Account Number";
        echo "</td>";
        echo "<td>";
            echo "Balance";
        echo "</td>";
        echo "<td>";
            echo "Currency Type";
        echo "</td>";
    echo "</tr>";

        for($y = 0; $y < $accountArrayLength; $y++) {
            if($accountArray[$y]->get_id() ===  $costumersArray[$x]->get_id()) {
                echo "<tr>";
                    echo "<td>";
                    echo $accountArray[$y]->get_accountHolder();
                    echo "</td>";
                    echo "<td>";
                    echo $accountArray[$y]->get_accountNumber();
                    echo "</td>";
                    echo "<td>";
                    echo $accountArray[$y]->get_balance();
                    echo "</td>";
                    echo "<td>";
                    echo $accountArray[$y]->get_currencyType();
                    echo "</td>";
                echo "</tr>";
            }
        }
    }
    echo "</table>";
echo "<br>";
echo "<br>";


// $arrlength = count($nrAccounts);
//
// for($x = 0; $x < $arrlength; $x++) {
//     echo $nrAccounts[$x];
//     echo "<br>";
// }


// $tall1 = 0;
// echo "<table>";
//
// foreach ($costumersArray as $value) {
//     echo "<tr>";
//         echo "<td>" . $costumersArray[$tall1]->get_name() . "<td>";
//
//         echo "<td>" . $costumersArray[$tall1]->get_surname() . "<td>";
//
//     echo "</tr>";
//     $tall1++;
// }
// echo "</table>";

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
