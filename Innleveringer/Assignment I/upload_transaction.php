<?php require_once"include/head.php"; ?>
    <body>
        <ul>
            <div class="center">
                <li><a href="index.php">Home</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a class="active" href="data.php">Upload data</a></li>
            </div>
        </ul>
    </div>
        <div class="wrapper">
            <div class="center">
                <?php
                    require 'functions/get_uploaded_transaction_function.php';
                    require_once 'functions/open_file_function.php';
                    require 'functions/get_accounts_function.php';
                    require 'functions/get_customers_function.php';
                    require 'functions/get_transactions_function.php';

                    /* ---------------------------------------------------------------------------
                    Getting all the customers, accounts and transactions and puts them in arrays
                    ----------------------------------------------------------------------------*/
                    $customersArray = get_customers();
                    $accountsArray = get_accounts();
                    $transactionsArray = get_transactions();
                    /* ---------------------------------------------------------------------------
                    Counting the arrays
                    ----------------------------------------------------------------------------*/
                    $customersArrayLength = count($customersArray);
                    $accountsArrayLength = count($accountsArray);
                    $transactionsArrayLength = count($transactionsArray);


                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $FileType = pathinfo($target_file,PATHINFO_EXTENSION);

                    $fileName = basename($_FILES["fileToUpload"]["name"]);

                    // Only account.csv files allowed
                    if ( $fileName == "transaction_deposit.csv" OR $fileName == "transaction_withdrawal.csv" ) {

                    } else {
                        echo "Sorry, only 'transaction_withdrawal.csv' or 'transaction_deposit.csv' files allowed. <br>";
                        $uploadOk = 0;
                    }


                    // Check file size
                    if ($_FILES["fileToUpload"]["size"] > 20000) {
                        echo "Sorry, your file is too large. <br>";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($FileType != "csv") {
                        echo "Sorry, only .csv text files are allowed. <br>";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Your file was not uploaded. ";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $transaction = get_uploaded_transaction("uploads/" . basename( $_FILES["fileToUpload"]["name"]));

                            array_push($transactionsArray, $transaction[0]);

                            $transactionArrayLength = count($transaction);

                            for($x = 0; $x < $accountsArrayLength; $x++) {
                                // for($y = 0; $y < $transactionArrayLength; $y++) {
                                    //Check if the account exist in the system
                                    if (!$accountsArray[$x]->get_accountNumber() == $transaction[0]->get_associatedAccount() ) {
                                        echo $transaction[0]->get_associatedAccount() ." is not a account in our system.";
                                    } else {
                                        $arrlength = count($transactionsArray);
                                        $text = "type,value,currencyType,associatedAccount,date" . "\n";
                                        for($z = 0; $z < $arrlength; $z++) {
                                            $text .=  $transactionsArray[$z]->get_type() . "," .
                                            $transactionsArray[$z]->get_value() . "," .
                                            $transactionsArray[$z]->get_currencyType() . "," .
                                            $transactionsArray[$z]->get_associatedAccount() . "," .
                                            $transactionsArray[$z]->get_date() . "\n";
                                        }
                                        open_file("data/transactions.csv", $text);

                                        /* ---------------------------------------------------------------------------
                                        Deletes the file
                                        ----------------------------------------------------------------------------*/
                                        if( file_exists("uploads/" . basename( $_FILES["fileToUpload"]["name"])) ) {
                                            $file = "uploads/" . basename( $_FILES["fileToUpload"]["name"]);
                                            unlink($file);
                                        }

                                        //Updates the balance and adds a deposit too the account
                                        if ($accountsArray[$x]->get_accountNumber() == $transaction[0]->get_associatedAccount() && $transaction[0]->get_type() == "deposit" ) {
                                            $balance = $accountsArray[$x]->get_balance() + $transaction[0]->get_value();
                                            $accountsArray[$x]->set_balance($balance);
                                            $accountsArray[$x]->set_deposits(1);

                                            $arrlength = count($accountsArray);
                                            $text = "id,accountHolder,accountNumber,currencyType,balance,withdrawals,deposits" . "\n";
                                            for($a = 0; $a < $arrlength; $a++) {
                                                $text .=  $accountsArray[$a]->get_id() . "," .
                                                $accountsArray[$a]->get_accountHolder() . "," .
                                                $accountsArray[$a]->get_accountNumber() . "," .
                                                $accountsArray[$a]->get_currencyType() . "," .
                                                $accountsArray[$a]->get_balance() . "," .
                                                $accountsArray[$a]->get_withdrawals() . "," .
                                                $accountsArray[$a]->get_deposits() . "\n";
                                            }
                                            open_file("data/accounts.csv", $text);

                                            for($b = 0; $b < $customersArrayLength; $b++) {
                                                if ($customersArray[$b]->get_id() == $accountsArray[$x]->get_id() ) {
                                                    $totalAssets = $accountsArray[$x]->get_balance();
                                                    $customersArray[$b]->set_totalAssets($totalAssets);

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
                                        //Updates the balance and adds a withdrawal too the account
                                        }elseif ($accountsArray[$x]->get_accountNumber() == $transaction[0]->get_associatedAccount() && $transaction[0]->get_type() ==  "withdrawal")    {
                                            $balance = $accountsArray[$x]->get_balance() - $transaction[0]->get_value();
                                            $accountsArray[$x]->set_balance($balance);
                                            $accountsArray[$x]->set_withdrawals(1);

                                            $arrlength = count($accountsArray);
                                            $text = "id,accountHolder,accountNumber,currencyType,balance,withdrawals,deposits" . "\n";
                                            for($a = 0; $a < $arrlength; $a++) {
                                                $text .=  $accountsArray[$a]->get_id() . "," .
                                                $accountsArray[$a]->get_accountHolder() . "," .
                                                $accountsArray[$a]->get_accountNumber() . "," .
                                                $accountsArray[$a]->get_currencyType() . "," .
                                                $accountsArray[$a]->get_balance() . "," .
                                                $accountsArray[$a]->get_withdrawals() . "," .
                                                $accountsArray[$a]->get_deposits() . "\n";
                                            }
                                            open_file("data/accounts.csv", $text);
                                        }
                                    }
                                // }
                            }
                            echo "<br><br>";
                            echo "The transaction was added to account " . $transaction[0]->get_associatedAccount();
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    echo "<br><br>";
                    echo "<a href='data.php' class='myButton'>Back</a>";


                ?>
            </div>
        </div>
    </body>
</html>
