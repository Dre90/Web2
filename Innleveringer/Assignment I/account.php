<html>
    <head>
        <meta charset="UTF-8">
        <title>Assignment I - Account management system - Accounts</title>
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
            require_once 'functions/sorting_functions.php';

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
            To sort just remove the comment in front of the one you want to sort by and comment out the others
            ----------------------------------------------------------------------------*/
            //Amount in ascending order
            //usort($transactionArray, 'sort_value_ascending');
            //Amount in descending order
            //usort($transactionArray, 'sort_value_descending');
            //Date in ascending order
            //usort($transactionArray, 'sort_date_ascending');
            //Date in descending order
            usort($transactionArray, 'sort_date_descending');

            /* ---------------------------------------------------------------------------
            Selecting customer
            To change customer switch out the number in $customerNR variable
            ----------------------------------------------------------------------------*/
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
    </body>
</html>
