<?php
require_once 'classes/transaction_class.php';

function get_uploaded_transaction($path) {
    $csv_data = file_get_contents($path); // Get the file content
    $lines = explode("\n", $csv_data); // Get the lines
    $head = str_getcsv(array_shift($lines)); // Get the head

    foreach ($lines as $line) {
        $row = array_pad(str_getcsv($line), count($head), '');
        $array[] = array_combine($head, $row);
    }

    array_pop($array); //removes the last empty element of the array

    $transactionArray = array();
    $tall = 0;
    foreach ($array as $value) {
        $transaction = new transaction($array[$tall]["type"],$array[$tall]["value"], $array[$tall]["currencyType"], $array[$tall]["associatedAccount"], $array[$tall]["date"]);

        array_push($transactionArray, $transaction);
        $tall++;
    }
    return $transactionArray;
}
?>
