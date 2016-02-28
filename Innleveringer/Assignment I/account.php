<!-- The second php file is named ’account.php’, and when called it should first display the number
of deposits, the number of withdrawals, and the balance for a specific customer, then a
table of transactions. Each transaction should include at least the date, type, amount, and
currency. One can define and change the customer by manipulating a parameter in the code. -->
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
<body>
<?php
require 'functions/get_costumers_function.php';
require 'functions/get_accounts_function.php';
require 'functions/get_transactions_function.php';

$costumersArray = get_costumers();
$transactionArray = get_transactions();
$accountArray = get_accounts();

$costumersArrayLength = count($costumersArray);
$accountArrayLength = count($accountArray);
$transactionArrayLength = count($transactionArray);

// for($x = 0; $x < $costumersArrayLength; $x++) {

// for($y = 0; $y < $accountArrayLength; $y++) {
$customerNR = 0;
    echo "<table>";
    echo "<tr>";
        echo "<th colspan='5'>";
            echo $costumersArray[$customerNR]->get_name() . " " . $costumersArray[$customerNR]->get_surname() ;
        echo "</th>";
    echo "</tr>";
    echo "<tr>";
        echo "<th colspan='5'>";
        echo "Overview";
        echo "</th>";
    echo "</tr>";

    echo "<tr>";
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

        $nrDeposits = array();
        $nrWithdrawals = array();
        for($y = 0; $y < $accountArrayLength; $y++) {
            if($accountArray[$y]->get_id() ===  $costumersArray[$customerNR]->get_id()) {
                for ($z = 0; $z < $transactionArrayLength; $z++) {
                    if($transactionArray[$z]->get_associatedAccount() ===  $accountArray[$y]->get_accountNumber()) {
                        if ($transactionArray[$z]->get_type() === "deposit") {
                            $var = $transactionArray[$z]->get_type();
                            $nrDeposits[] = $var;
                        } else {
                            $var2 = $transactionArray[$z]->get_type();
                            $nrWithdrawals[] = $var2;
                        }
                    }
                }
            }
        }
        echo "<td>";
        $DepositsOccurences = array_count_values($nrDeposits);

        if (count($nrDeposits) == 0) {
            echo "0";
        }else {
            echo $DepositsOccurences["deposit"];
        }
        echo "</td>";
        echo "<td>";
        $WithdrawalsOccurences = array_count_values($nrWithdrawals);
        if (count($nrWithdrawals) == 0) {
            echo "0";
        }else {
            echo $WithdrawalsOccurences["withdrawal"];
        }

        echo "</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<th colspan='5'>";
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
            echo "Transaction value";
        echo "</td>";
        echo "<td>";
            echo "Currency type";
        echo "</td>";
    echo "</tr>";

    for($y = 0; $y < $accountArrayLength; $y++) {
        if($accountArray[$y]->get_id() ==  $costumersArray[$customerNR]->get_id()) {
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
    // echo "<tr>";
    //     echo "<td>";
    //         echo "Account Holder";
    //     echo "</td>";
    //     echo "<td>";
    //         echo "Account Number";
    //     echo "</td>";
    //     echo "<td>";
    //         echo "Balance";
    //     echo "</td>";
    //     echo "<td>";
    //         echo "Currency Type";
    //     echo "</td>";
    // echo "</tr>";
    //     for($y = 0; $y < $accountArrayLength; $y++) {
    //         if($accountArray[$y]->get_id() ==  $costumersArray[$customerNR]->get_id()) {
    //             echo "<tr>";
    //                 echo "<td>";
    //                 echo $accountArray[$customerNR]->get_accountHolder();
    //                 echo "</td>";
    //                 echo "<td>";
    //                 echo $accountArray[$customerNR]->get_accountNumber();
    //                 echo "</td>";
    //                 echo "<td>";
    //                 echo $accountArray[$customerNR]->get_balance();
    //                 echo "</td>";
    //                 echo "<td>";
    //                 echo $accountArray[$customerNR]->get_currencyType();
    //                 echo "</td>";
    //             echo "</tr>";
    //         }
    //          }
echo "</table>";


        // }
        echo "<table>";

    // }
        echo "</table>";
    // }
// }




//hvis accountnr er like og type er lik deposits så account deposits +1
 ?>
</body>
</html>
