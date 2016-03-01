<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
require 'functions/get_uploaded_account_function.php';
require 'functions/get_accounts_function.php';
require 'functions/open_file_function.php';
require 'functions/get_costumers_function.php';

$costumersArray = get_costumers();
$accountsArray = get_accounts();

$costumersArrayLength = count($costumersArray);
$accountsArrayLength = count($accountsArray);

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
        $account = get_uploaded_account("uploads/" . basename( $_FILES["fileToUpload"]["name"]));

        array_push($accountsArray, $account[0]);

        $accountArrayLength = count($account);

        for($x = 0; $x < $costumersArrayLength; $x++) {
            for($y = 0; $y < $accountArrayLength; $y++) {
                if (!$costumersArray[$x]->get_id() == $account[$y]->get_id() ) {
                    echo $account[0]->get_accountHolder() ." is not a customer in our system.";
                } else {
                    $arrlength = count($accountsArray);
                    $text = "id,accountHolder,accountNumber,currencyType,balance,withdrawals,deposits" . "\n";
                    for($x = 0; $x < $arrlength; $x++) {
                        $text .=  $accountsArray[$x]->get_id() . "," .
                        $accountsArray[$x]->get_accountHolder() . "," .
                        $accountsArray[$x]->get_accountNumber() . "," .
                        $accountsArray[$x]->get_currencyType() . "," .
                        $accountsArray[$x]->get_balance() . "," .
                        $accountsArray[$x]->get_withdrawals() . "," .
                        $accountsArray[$x]->get_deposits() . "\n";
                    }
                    open_file("data/accounts.csv", $text);

                    $totalAssets = $costumersArray[$x]->get_totalAssets(); 
                    $totalAssets += $account[0]->get_balance();
                    echo $totalAssets;

                    echo "The account was added to " . $account[0]->get_accountHolder();
                }
            }
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
