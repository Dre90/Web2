<?php require_once"include/head.php"; ?>
    <body>
        <ul>
            <div class="center">
                <li><a href="index.php">Home</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a class="active" href="data.php">Upload data</a></li>
            </div>
        </ul>
    </div>
        <div class="wrapper">
            <div class="center">
                <?php
                    require 'functions/get_uploaded_customer_function.php';
                    require 'functions/get_customers_function.php';
                    require 'functions/open_file_function.php';

                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $FileType = pathinfo($target_file,PATHINFO_EXTENSION);

                    $uploaded = 3;
                    $exists = 0;

                    // Only customer.csv files allowed
                    if (basename($_FILES["fileToUpload"]["name"]) != "customer.csv") {
                        echo "Sorry, only 'customer.csv' files allowed. <br>";
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["fileToUpload"]["size"] > 20000) {
                        echo "Sorry, your file is too large. <br>";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($FileType != "csv") {
                        echo "Sorry, only .csv text files are allowed. <br>";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Your file was not uploaded. <br>";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                            // Gets the uploaded customer
                            $customer = get_uploaded_customer("uploads/" . basename( $_FILES["fileToUpload"]["name"]));

                            // Gets the customers in the database
                            $customersArray = get_customers();

                            // And counts the array
                            $customersArrayLength = count($customersArray);

                            //Check if customer already exist in the system
                            for($x = 0; $x < $customersArrayLength; $x++) {
                                if ($customersArray[$x]->get_id() == $customer[0]->get_id() ) {
                                    $exists = 1;
                                    $uploaded = 0;
                                }
                            }

                            if ($exists == 0) {
                                // adds the customer to the end of customersArray
                                array_push($customersArray, $customer[0]);

                                $arrlength = count($customersArray);

                                $text = "id,name,surname,birthdate,address,totalAssets" . "\n";

                                for($z = 0; $z < $arrlength; $z++) {
                                    $text .=  $customersArray[$z]->get_id() . "," .
                                    $customersArray[$z]->get_name() . "," .
                                    $customersArray[$z]->get_surname() . "," .
                                    $customersArray[$z]->get_birthdate() . "," .
                                    $customersArray[$z]->get_address() . "," .
                                    $customersArray[$z]->get_totalAssets() . "\n";
                                }
                                open_file("data/customers.csv", $text);

                                $uploaded = 1;
                                $customer = $customer[0]->get_name() . " ".$customer[0]->get_surname();
                                /* ---------------------------------------------------------------------------
                                Deletes the file
                                ----------------------------------------------------------------------------*/
                                if( file_exists("uploads/" . basename( $_FILES["fileToUpload"]["name"])) ) {
                                    $file = "uploads/" . basename( $_FILES["fileToUpload"]["name"]);
                                    unlink($file);
                                }
                            }

                        } else {
                            echo "Sorry, there was an error uploading your file. ";
                        }
                    }

                    if ($uploaded == 1) {
                        echo $customer . " was added too the system.";
                    } elseif ($uploaded == 0) {
                        echo $customer . " already exists";
                    }

                    echo "<br><br>";
                    echo "<a href='data.php' class='myButton'>Back</a>";


                ?>
            </div>
        </div>
    </body>
</html>
