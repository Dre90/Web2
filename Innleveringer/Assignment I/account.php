<!-- The second php file is named ’account.php’, and when called it should first display the number
of deposits, the number of withdrawals, and the balance for a specific customer, then a
table of transactions. Each transaction should include at least the date, type, amount, and
currency. One can define and change the customer by manipulating a parameter in the code. -->
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="customers.php">Customers</a></li>
        <li><a class="active" href="account.php">Account</a></li>
        <li><a href="data.php">Upload data</a></li>
    </ul>

<?php
require 'functions/get_customers_function.php';
require 'functions/get_accounts_function.php';
require 'functions/get_transactions_function.php';

/* ---------------------------------------------------------------------------
Getting all the customers, accounts and transactions and puts them in arrays
----------------------------------------------------------------------------*/
$customersArray = get_customers();
$accountArray = get_accounts();
$transactionArray = get_transactions();
/* ---------------------------------------------------------------------------
Counting the arrays
----------------------------------------------------------------------------*/
$customersArrayLength = count($customersArray);
$accountArrayLength = count($accountArray);
$transactionArrayLength = count($transactionArray);
/* ---------------------------------------------------------------------------
Sorting
Sort on transaction amount remove the comment
----------------------------------------------------------------------------*/
//sort($transactionArray); //amount in ascending
//rsort($transactionArray); //amount in descending

/* ---------------------------------------------------------------------------
Selecting customer
To change customer switch out the number in $customerNR
----------------------------------------------------------------------------*/
// echo "<select name='per1' id='per1'>";
// for($x = 0; $x < $customersArrayLength; $x++) {
//   $name = $customersArray[$x]->get_name() . ' ' . $customersArray[$x]->get_surname();
//
//   $customerid = $customersArray[$x]->get_id();
//   echo "<option value='$customerid'>$name</option>";
//     }
// echo "</select>";

$customerNR = 0;
echo "<table>";
    echo "<tr>";
        echo "<th colspan='4'>";
            echo $customersArray[$customerNR]->get_name() . " " . $customersArray[$customerNR]->get_surname() ;
        echo "</th>";
    echo "</tr>";

    for($y = 0; $y < $accountArrayLength; $y++) {
        if($accountArray[$y]->get_id() ===  $customersArray[$customerNR]->get_id()) {
            echo "<tr>";
                echo "<th colspan='4'>";
                echo "Overview of accunt" . " " . $accountArray[$y]->get_accountNumber();
                echo "</th>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>";
                    echo "Account number";
                echo "</td>";
                echo "<td>";
                    echo "Number of deposits";
                echo "</td>";
                echo "<td>";
                    echo "Number of withdrawals";
                echo "</td>";
                echo "<td>";
                    echo "Total Balance";
                echo "</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>";
                    echo $accountArray[$y]->get_accountNumber();
                echo "</td>";
                echo "<td>";
                    echo $accountArray[$y]->get_deposits();
                echo "</td>";
                echo "<td>";
                    echo $accountArray[$y]->get_withdrawals();
                echo "</td>";
                echo "<td>";
                    echo $accountArray[$y]->get_balance();
                echo "</td>";
            echo "</tr>";

            echo "<tr>";
                echo "<th colspan='4'>";
                echo "Transactions";
                echo "</th>";
            echo "</tr>";

            echo "<tr>";
                echo "<td>";
                    echo "Transaction date";
                echo "</td>";
                echo "<td>";
                    echo "Transaction type";
                echo "</td>";
                echo "<td>";
                    echo "Transaction amount";
                echo "</td>";
                echo "<td>";
                    echo "Currency type";
                echo "</td>";
            echo "</tr>";

            for ($z = 0; $z < $transactionArrayLength; $z++) {
                if($transactionArray[$z]->get_associatedAccount() ===  $accountArray[$y]->get_accountNumber()) {
                    echo "<tr>";
                        echo "<td>";
                            $transactionDato = $transactionArray[$z]->get_date();
                            echo date("d.m.Y", $transactionDato);
                        echo "</td>";
                        echo "<td>";
                            echo $transactionArray[$z]->get_type();
                        echo "</td>";
                        echo "<td>";
                            echo $transactionArray[$z]->get_value();
                        echo "</td>";
                        echo "<td>";
                            echo $transactionArray[$z]->get_currencyType();
                        echo "</td>";
                    echo "</tr>";

                }
            }
        }
    }
echo "</table>";
?>
<!-- <script>
$( "select" )
  .change(function () {
    var str = "";
    $( "select option:selected" ).each(function() {
      str += $( this ).val() + " ";
    });
    $( "p" ).text( str );

  })
  .change();
</script>
<p></p> -->
</body>
</html>
