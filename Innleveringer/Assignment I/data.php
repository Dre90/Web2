<!-- The third php file is named ’data.php’ and should allow you to upload new
     - customers,
     - transactions,
     - or accounts (i.e., from a file).

You should check the validity of data (e.g., a transaction
should indeed belong to an account that exists).


One should be able to sort the records by date or amount in ascending or descending order bymanipulating a parameter in your code. -->


<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select text file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

</body>
</html>
