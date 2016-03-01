<!-- The third php file is named ’data.php’ and should allow you to upload new
     - customers,
     - transactions,
     - or accounts (i.e., from a file).

You should check the validity of data (e.g., a transaction
should indeed belong to an account that exists).


One should be able to sort the records by date or amount in ascending or descending order bymanipulating a parameter in your code. -->


<html>
<body>
<h1>Upload</h1>
<h2>Customer</h2>
<form action="upload_customer.php" method="post" enctype="multipart/form-data">
    Select customer file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
<h2>Account</h2>
<form action="upload_account.php" method="post" enctype="multipart/form-data">
    Select account file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
<h2>Transaction</h2>
<form action="upload_transaction.php" method="post" enctype="multipart/form-data">
    Select transaction file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

</body>
</html>
