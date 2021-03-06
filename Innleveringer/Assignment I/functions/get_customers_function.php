<?php
    require_once 'classes/customer_class.php';

    function get_customers() {
        $csv_data = file_get_contents('data/customers.csv'); // Get the file content
        $lines = explode("\n", $csv_data); // Get the lines
        $head = str_getcsv(array_shift($lines)); // Get the head

        foreach ($lines as $line) {
            $row = array_pad(str_getcsv($line), count($head), '');
            $array[] = array_combine($head, $row);
        }

        array_pop($array); //removes the last empty element of the array

        //Creates the customers array
        $customersArray = array();
        $tall = 0;
        foreach ($array as $value) {
            $customer = new customer($array[$tall]["id"],$array[$tall]["name"], $array[$tall]["surname"], $array[$tall]["birthdate"], $array[$tall]["address"], $array[$tall]["totalAssets"]);

            array_push($customersArray, $customer);
            $tall++;
        }
        return $customersArray;
    }
?>
