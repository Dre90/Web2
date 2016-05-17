<?php require_once"include/head.php" ?>
    <body>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a class="active" href="data.php">Upload data</a></li>
        </ul>
        <div class="wrapper">
            <h1>Upload</h1>
            <h2 id="error"></h2>
            <h2>Customer</h2>
            <form action="upload_customer.php" method="post" enctype="multipart/form-data" onsubmit="return validateUpload(this);">
                Select customer file to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload" name="submit" class="myButton">
            </form>
            <h2>Account</h2>
            <form action="upload_account.php" method="post" enctype="multipart/form-data" onsubmit="return validateUpload(this);">
                Select account file to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload" name="submit" class="myButton">
            </form>
            <h2>Transaction</h2>
            <form action="upload_transaction.php" method="post" enctype="multipart/form-data" onsubmit="return validateUpload(this);">
                Select transaction file to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload" name="submit" class="myButton">
            </form>
        </div>
    </body>
</html>
