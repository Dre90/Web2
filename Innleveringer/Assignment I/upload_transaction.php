<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
$transactionArray = get_transactions();
/* ---------------------------------------------------------------------------
Counting the arrays
----------------------------------------------------------------------------*/
$customersArrayLength = count($customersArray);
$accountsArrayLength = count($accountsArray);
$transactionArrayLength = count($transactionArray);


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists. ";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 20000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
}

// Allow certain file formats
if($FileType != "csv") {
    echo "Sorry, only .csv text files are allowed. ";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. ";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        // echo file_get_contents($target_file);
        $transaction = get_uploaded_transaction("uploads/" . basename( $_FILES["fileToUpload"]["name"]));

        array_push($transactionsArray, $transaction[0]);

        $transactionArrayLength = count($transaction);

        for($x = 0; $x < $accountsArrayLength; $x++) {
            for($y = 0; $y < $transactionArrayLength; $y++) {
                if (!$accountsArray[$x]->get_accountNumber() == $transaction[$y]->get_associatedAccount() ) {
                    echo $transaction[0]->get_associatedAccount() ." is not a account in our system.";
                } else {
                    $arrlength = count($transactionsArray);
                    $text = "id,accountHolder,accountNumber,currencyType,balance,withdrawals,deposits" . "\n";
                    for($z = 0; $z < $arrlength; $z++) {
                        $text .=  $transactionsArray[$z]->get_type() . "," .
                        $transactionsArray[$z]->get_value() . "," .
                        $transactionsArray[$z]->get_currencyType() . "," .
                        $transactionsArray[$z]->get_associatedAccount() . "," .
                        $transactionsArray[$z]->get_date() . "\n";
                    }
                    open_file("data/transactions.csv", $text);
                }
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

                }elseif ($accountsArray[$x]->get_accountNumber() == $transaction[0]->get_associatedAccount() && $transaction[0]->get_type() == "withdrawal") {
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
        }
        echo "<br><br>";
        echo "The account was added to " . $account[0]->get_accountHolder();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
echo "<br><br>";
echo "<a href='data.php' class='myButton'>Back</a>";

?>
</body>
</html>
