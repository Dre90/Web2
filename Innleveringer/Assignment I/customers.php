<html>
    <head>
        <meta charset="UTF-8">
        <title>Assignment I - Account management system - Customers</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a class="active" href="customers.php">Customers</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="data.php">Upload data</a></li>
        </ul>
        <?php
        require 'functions/get_customers_function.php';
        require 'functions/get_accounts_function.php';
        require_once 'functions/open_file_function.php';

        /* ---------------------------------------------------------------------------
        Getting all the customers, accounts and transactions and puts them in arrays
        ----------------------------------------------------------------------------*/
        $customersArray = get_customers();
        $accountArray = get_accounts();

        /* ---------------------------------------------------------------------------
        Counting the arrays
        ----------------------------------------------------------------------------*/
        $customersArrayLength = count($customersArray);
        $accountArrayLength = count($accountArray);

        /* ---------------------------------------------------------------------------
        Customers and accounts counts in the system
        ----------------------------------------------------------------------------*/
        echo "<br>";
        echo "Total number of customers in the system: " . customer::$customerCount;
        echo "<br>";
        echo "Total number of accounts in the system: " . account::$accountCount;
        echo "<br>";
        echo "<br>";

        /* ---------------------------------------------------------------------------
        The table
        ----------------------------------------------------------------------------*/
        echo "<table>";
            for($x = 0; $x < $customersArrayLength; $x++) {
                echo "<tr>";
                    echo "<th colspan='5'>";
                        echo "Information about costumer " . $customersArray[$x]->get_name();
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
                        echo $customersArray[$x]->get_name();
                    echo "</td>";
                    echo "<td>";
                        echo $customersArray[$x]->get_surname();
                    echo "</td>";
                    echo "<td>";
                        echo $customersArray[$x]->get_birthdate();
                    echo "</td>";
                    echo "<td>";
                        $nrAccounts = array();
                        for($y = 0; $y < $accountArrayLength; $y++) {

                            if($accountArray[$y]->get_id() ===  $customersArray[$x]->get_id()) {
                                $var = $accountArray[$y]->get_id();
                                $nrAccounts[] = $var;
                            }
                        }
                        $occurences = array_count_values($nrAccounts);
                        if (count($occurences) == 0) {
                            echo "0";
                        }else {
                            echo $occurences[$customersArray[$x]->get_id()];
                        }

                    echo "</td>";
                    echo "<td>";
                        $totalAssets = 0;
                        for($y = 0; $y < $accountArrayLength; $y++) {
                             if($accountArray[$y]->get_id() ===  $customersArray[$x]->get_id()) {
                                $totalAssets += $accountArray[$y]->get_balance();
                                $customersArray[$x]->set_totalAssets($totalAssets);

                                $arrlength = count($customersArray);
                                $text = "id,name,surname,birthdate,address,totalAssets" . "\n";
                                for($a = 0; $a < $arrlength; $a++) {
                                    $text .=  $customersArray[$a]->get_id() . "," .
                                    $customersArray[$a]->get_name() . "," .
                                    $customersArray[$a]->get_surname() . "," .
                                    $customersArray[$a]->get_birthdate() . "," .
                                    $customersArray[$a]->get_address() . "," .
                                    $customersArray[$a]->get_totalAssets() . "\n";
                                }
                                open_file("data/customers.csv", $text);
                            }
                        }
                        echo $totalAssets;
                    echo "</td>";
                echo "</tr>";

                if (!count($occurences) == 0) {
                    echo "<tr>";
                        echo "<th class='tableHeader' colspan='5'>";
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
                        echo "<td>";
                            echo "Number of transactions";
                        echo "</td>";
                    echo "</tr>";

                        for($y = 0; $y < $accountArrayLength; $y++) {
                            if($accountArray[$y]->get_id() ===  $customersArray[$x]->get_id()) {
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
                                    echo "<td>";
                                        $transactions = 0;
                                        $transactions = $accountArray[$y]->get_withdrawals() + $accountArray[$y]->get_deposits();
                                        if ($transactions == 0) {
                                            echo "0";
                                        } else {
                                            echo $transactions;
                                        }

                                    echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                }
            echo "</table>";
         ?>
    </body>
</html>
