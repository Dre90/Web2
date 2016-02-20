<!-- The second php file is named ’account.php’, and when called it should first display the number
of deposits, the number of withdrawals, and the balance for a specific customer, then a
table of transactions. Each transaction should include at least the date, type, amount, and
currency. One can define and change the customer by manipulating a parameter in the code. -->

<?php
require 'classes/account_class.php';

$account1 = new account("Dag-Roger", "NOR", 1000);
print_r($account1);

echo "We now have " . account::$accountCount;

$account2 = new account("Dag", "NOR", 1000);
echo "We now have " . account::$accountCount;
 ?>
