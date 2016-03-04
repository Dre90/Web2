<html><!-- form.php -->
<head>
    <title>Form Test</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
        }
        div {
            width: 30%;
        }
        input, select {
            width: 100%;
        }
        select {
            padding: 12px 20px;
            margin: 8px 0 20px 0;
            box-sizing: border-box;
        }
        input[type=text] {
            padding: 12px 20px;
            margin: 8px 0 20px 0;
            box-sizing: border-box;
        }

        input[type=submit] {
            padding: 9px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="">
        <h1>Registration</h1>
        <form method="post" action="data.php">
            <label for="username">Username</label>
                <input type="text" name="username">
            <label for="name">Name</label>
                <input type="text" name="name">
            <label for="Surname">Surname</label>
                <input type="text" name="surname">
            <label for="Gender">Gender</label>
                <select name="Gender">
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            <label for="password">Password</label>
                <input type="text" name="password">
            <label for="tos">Agree to terms of service</label>
            <input type="radio" name="tos" value="1">Agree
            <input type="radio" name="tos" value="0">Not agree
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
