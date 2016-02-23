<?php
require 'classes/account_class.php';

function get_accounts() {
    $csv_data = file_get_contents('data/accounts.csv'); // Get the file content
    $lines = explode("\n", $csv_data); // Get the lines
    $head = str_getcsv(array_shift($lines)); // Get the head

    foreach ($lines as $line) {
        $row = array_pad(str_getcsv($line), count($head), '');
        $array[] = array_combine($head, $row);
    }

    array_pop($array); //removes the last empty element of the array

    $accountArray = array();
    $tall = 0;
    foreach ($array as $value) {
        $account = new account($array[$tall]["accountHolder"], $array[$tall]["accountNumber"], $array[$tall]["currencyType"], $array[$tall]["balance"], $array[$tall]["withdrawals"], $array[$tall]["deposits"]);

        array_push($accountArray, $account);

        $tall++;
    }
    return $accountArray;

}

 ?>
