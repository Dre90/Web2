<?php
    require_once"include/head.php";


$customerNR = isset($_GET['customer_id']) && !empty( $_GET['id'] ) ? $_GET['customer_id'] : 0;

    // if ($_GET['customer_id'] == null) {
    //     $customerNR = 0;
    // } else {
    //     $customerNR = $_GET['customer_id'];
    // }

?>
    <body>
        <ul>
            <div class="center">
                <li><a href="index.php">Home</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a class="active" href="account.php">Account</a></li>
                <li><a href="data.php">Upload data</a></li>
            </div>
        </ul>
        <div class="wrapper">
            <div class="center">
                <a href="customers.php">Back to customers list</a>
                <div class="sortDiv">
                    <h3>Sort</h3>
                    <form action="">
                        <select name="customers" onchange="showCustomer(this.value, <?php echo $customerNR;?>)">
                            <option value="sort_date_descending">Date descending</option>
                            <option value="sort_date_ascending">Date ascending</option>
                            <option value="sort_value_ascending">Value ascending</option>
                            <option value="sort_value_descending">Value descending</option>
                        </select>
                    </form>
                </div>

                <div id="customer">
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
                        // $customerNR = $_GET['customer_id'];



                        echo "<table>";
                            echo "<tr>";
                                echo "<th colspan='4'>";
                                    echo "<h1>" . $customersArray[$customerNR]->get_name() . " " . $customersArray[$customerNR]->get_surname() . "</h1>" ;
                                echo "</th>";
                            echo "</tr>";

                            for($y = 0; $y < $accountArrayLength; $y++) {
                                if($accountArray[$y]->get_id() ===  $customersArray[$customerNR]->get_id()) {
                                    echo "<tr>";
                                        echo "<th colspan='4'>";
                                        echo "<h2>" . "Overview of account" . " " . $accountArray[$y]->get_accountNumber() . "</h2>";
                                        echo "</th>";
                                    echo "</tr>";

                                    echo "<tr>";
                                        echo "<td>";
                                            echo "<h3>" . "Account number". "</h3>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<h3>" . "Number of deposits". "</h3>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<h3>" . "Number of withdrawals". "</h3>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<h3>" . "Total Balance". "</h3>";
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
                                        echo "<h2>" . "Transactions" . "</h2>";
                                        echo "</th>";
                                    echo "</tr>";

                                    echo "<tr>";
                                        echo "<td>";
                                            echo "<h3>" . "Transaction date". "</h3>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<h3>" . "Transaction type". "</h3>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<h3>" . "Transaction amount". "</h3>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<h3>" . "Currency type". "</h3>";
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


                </div>
        </div>
    </div>
    <script>
        function showCustomer(str,customerNR) {

          if (str == "") {
            document.getElementById("customer").innerHTML = "";
            return;
        } else {

          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("customer").innerHTML = xmlhttp.responseText;
            }
          };
          xmlhttp.open("GET", "customer_with_account2.php?sort="+str+"&customer_id="+customerNR, true);
          xmlhttp.send();
        }
        }
        </script>
    </body>
</html>
