index.html is the front page and from here you have access to every page on the site through the navigation.

customers.php
    No interaction needed

account.php page
    Sorting on the account.php page see line 38 to 48.
    To sort just remove the comment in front of the one you want to sort by and comment out the others

Selecting customer
    To change customer switch out the number in $customerNR variable line 54

data.php
    To upload a data push the "choose file" button and go to the folder named "test data to be uploaded"

Upload customer
    test data to be uploaded/customer_test.csv

Upload account to the new customer
    test data to be uploaded/new_customer_account_test.csv

Upload account to an old customer
    test data to be uploaded/account_test.csv

Upload transactions
    Deposit
        test data to be uploaded/transaction_test1_deposit.csv
    Withdrawal
        test data to be uploaded/transaction_test1_withdrawal.csv

    test data to be uploaded/fail test.txt
        This is just a file to test that only .csv files is allowed to be uploaded.
        test data to be uploaded/fail test.txt


Note
"OTHER REQUIREMENTS
• Data which needs to be calculated (total assets, the number of transactions etc.) should
be calculated and then needs to be written back to data files every time one calls the
’customer.php’ or ’account.php’."

This is been calculated when things get uploaded.
