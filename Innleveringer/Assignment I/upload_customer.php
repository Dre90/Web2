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
require 'functions/get_uploaded_customer_function.php';
require 'functions/get_customers_function.php';
require 'functions/open_file_function.php';

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
        $customer = get_uploaded_customer("uploads/" . basename( $_FILES["fileToUpload"]["name"]));
        $customersArray = get_customers();
        array_push($customersArray, $customer[0]);

        $customersArrayLength = count($customersArray);
        $customerArrayLength = count($customer);
        for($x = 0; $x < $customersArrayLength; $x++) {
            for($y = 0; $y < $customerArrayLength; $y++) {
                if ($customersArray[$x]->get_id() == $customer[$y]->get_id() ) {
                    echo $customer[0]->get_name() . " ".$customer[0]->get_surname() . "already exists";
                } else {
                    $arrlength = count($customersArray);
                    $text = "id,name,surname,birthdate,address,totalAssets" . "\n";
                    for($z = 0; $z < $arrlength; $z++) {
                        $text .=  $customersArray[$z]->get_id() . "," .
                        $customersArray[$z]->get_name() . "," .
                        $customersArray[$z]->get_surname() . "," .
                        $customersArray[$z]->get_birthdate() . "," .
                        $customersArray[$z]->get_address() . "," .
                        $customersArray[$z]->get_totalAssets() . "\n";
                    }
                    open_file("data/customers.csv", $text);

                    echo $customer[0]->get_name() . " ".$customer[0]->get_surname() . " was added too the system.";
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
