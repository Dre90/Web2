<?php
    require_once"include/head.php";
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

?>
    <body>

        <ul>
            <div class="center">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="customers.php">Customers</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="data.php">Upload data</a></li>
            </div>
        </ul>
    </div>
        <div class="wrapper">
            <div class="center">
                <div class='numbersOuter'>
                    <h1>Number of customers and accounts in the system </h1>
                    <div class='numbersInner'>
                        <p class='number'><span class='count'> <?php echo customer::$customerCount; ?> </span> </p>
                        <p class='numberDescription'> Customers </p>
                    </div>
                    <div>
                        <p class='number'><span class='count'> <?php echo account::$accountCount; ?></span></p>
                        <p class='numberDescription'> Accounts </p>
                    </div>
                </div>
        <?php
            /* ---------------------------------------------------------------------------
            The table
            ----------------------------------------------------------------------------*/
            echo "<table>";
                for($x = 0; $x < $customersArrayLength; $x++) {
                    $costumerid = $customersArray[$x]->get_id() - 1;
                    echo "<tr>";
                        echo "<th colspan='5'>";
                            echo "<h2>" . "Information about costumer  <a href='account.php?customer_id=" . $costumerid . "'>" . $customersArray[$x]->get_name() . " " .  $customersArray[$x]->get_surname() . "</a></h2>";
                        echo "</th>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<h3>" . "Name" . "</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>" . "Surname" . "</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>" . "Birthdate" . "</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>" . "Number of accounts" . "</h3>";
                        echo "</td>";
                        echo "<td>";
                            echo "<h3>" . "Total amount of assets" . "</h3>";
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
                                echo "<h2>" . "Accounts" . "</h2>";
                            echo "</th>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>";
                                echo "<h3>" . "Account Holder". "</h3>";
                            echo "</td>";
                            echo "<td>";
                                echo "<h3>" . "Account Number". "</h3>";
                            echo "</td>";
                            echo "<td>";
                                echo "<h3>" . "Balance". "</h3>";
                            echo "</td>";
                            echo "<td>";
                                echo "<h3>" . "Currency Type". "</h3>";
                            echo "</td>";
                            echo "<td>";
                                echo "<h3>" . "Number of transactions". "</h3>";
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
         </div>
     </div>
     <script>
         $('.count').each(function () {
             $(this).prop('Counter',0).animate({
             Counter: $(this).text()
         }, {
             duration: 1000,
             easing: 'swing',
             step: function (now) {
                 $(this).text(Math.ceil(now));
             }
             });
         });
     </script>
    </body>
</html>
