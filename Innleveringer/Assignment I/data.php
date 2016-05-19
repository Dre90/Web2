<?php require_once"include/head.php" ?>
    <body>
        <ul>
            <div class="center">
                <li><a href="index.php">Home</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a class="active" href="data.php">Upload data</a></li>
            </div>
        </ul>
        <div class="wrapper">
            <div class="center">
                <h1>Upload</h1>
                <h2 id="error"></h2>
                <div class="form">
                    <h2>Customer</h2>
                    <form action="upload_customer.php" method="post" enctype="multipart/form-data" onsubmit="return validateUpload(this);">
                        Select customer file to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload" name="submit" class="myButton">
                    </form>
                    <p class="formComment">
                        * Only "customer.csv" files allowed.
                    </p>

                </div>
                <div class="form">
                    <h2>Account</h2>
                    <form action="upload_account.php" method="post" enctype="multipart/form-data" onsubmit="return validateUpload(this);">
                        Select account file to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload" name="submit" class="myButton">
                    </form>
                    <p class="formComment">
                        * Only "account.csv" files allowed.
                    </p>
                </div>
                <div class="form">
                    <h2>Transaction</h2>
                    <form action="upload_transaction.php" method="post" enctype="multipart/form-data" onsubmit="return validateUpload(this);">
                        Select transaction file to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload" name="submit" class="myButton">
                    </form>
                    <p class="formComment">
                        * Only "transaction_deposit.csv" and "transaction_withdrawal.csv" files allowed.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
