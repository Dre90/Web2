<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <?php
            require 'functions/get_uploaded_account_function.php';
            require 'functions/get_accounts_function.php';
            require_once 'functions/open_file_function.php';
            require 'functions/get_customers_function.php';

            /* ---------------------------------------------------------------------------
            Getting all the customers, accounts and transactions and puts them in arrays
            ----------------------------------------------------------------------------*/
            $customersArray = get_customers();
            $accountsArray = get_accounts();

            /* ---------------------------------------------------------------------------
            Counting the arrays
            ----------------------------------------------------------------------------*/
            $customersArrayLength = count($customersArray);
            $accountsArrayLength = count($accountsArray);


            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $uploaded = 3;
            $exists = 0;

            // Only account.csv files allowed
            if (basename($_FILES["fileToUpload"]["name"]) != "account.csv") {
                echo "Sorry, only 'account.csv' files allowed. <br>";
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
                    $account = get_uploaded_account("uploads/" . basename( $_FILES["fileToUpload"]["name"])); //gets the account

                    for($x = 0; $x < $customersArrayLength; $x++) {
                        //Check if customer exist in the system
                        if (!$customersArray[$x]->get_id() == $account[0]->get_id() ) {
                            echo $account[0]->get_accountHolder() ." is not a customer in our system.";
                        } else {
                            for($y = 0; $y < $accountsArrayLength; $y++) {
                                if ( $accountsArray[$y]->get_accountNumber() == $account[0]->get_accountNumber() ) {
                                    $exists = 1;
                                }
                             }
                        }
                    }

                    if ($exists == 0) {
                        array_push($accountsArray, $account[0]); //puts the new account on the end of the accounts array

                        $arrlength = count($accountsArray);

                        $text = "id,accountHolder,accountNumber,currencyType,balance,withdrawals,deposits" . "\n";
                        for($z = 0; $z < $arrlength; $z++) {
                            $text .=  $accountsArray[$z]->get_id() . "," .
                            $accountsArray[$z]->get_accountHolder() . "," .
                            $accountsArray[$z]->get_accountNumber() . "," .
                            $accountsArray[$z]->get_currencyType() . "," .
                            $accountsArray[$z]->get_balance() . "," .
                            $accountsArray[$z]->get_withdrawals() . "," .
                            $accountsArray[$z]->get_deposits() . "\n";
                        }
                        open_file("data/accounts.csv", $text);

                        $uploaded = 1;

                        /* ---------------------------------------------------------------------------
                        Deletes the file
                        ----------------------------------------------------------------------------*/
                        if( file_exists("uploads/" . basename( $_FILES["fileToUpload"]["name"])) ) {
                            $file = "uploads/" . basename( $_FILES["fileToUpload"]["name"]);
                            unlink($file);
                        }

                        for($x = 0; $x < $customersArrayLength; $x++) {
                            //Updates the total assets to the customer
                            if ($customersArray[$x]->get_id() == $account[0]->get_id() ) {
                                $totalAssets = $customersArray[$x]->get_totalAssets() + $account[0]->get_balance();
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
                    }

                    if ($uploaded == 1) {
                        echo "The account was added to " . $account[0]->get_accountHolder();
                    }
                    if ($exists == 1) {
                        echo "Account with account number " . $account[0]->get_accountNumber() . " already exists.";
                    }

                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            echo "<br><br>";
            echo "<a href='data.php' class='myButton'>Back</a>";


        ?>
    </body>
</html>
