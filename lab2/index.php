<html>
    <body>
        <div>
            <h2>Lab 2 / Task 1</h2>
            <?php
                echo "Twinkle, Twinkle little star.";

                $var1 = "Twinkle ";
                $var2 = "star";
                echo "<br>";
                echo $var1 . $var2;

                $var1 = "Hello ";
                $var2 = "world!";

                echo "<br>" . $var1 . $var2;
            ?>
        </div>
        <div>
            <h2>Lab 2 / Task 2</h2>
            <p>
                <?php
                    $x = 10;
                    $y = 7;

                    $result = $x + $y;
                    echo "$x + $y = $result";
                ?>
            </p>
            <p>
                <?php
                    $result = $x - $y;
                    echo "$x - $y = $result";
                ?>
            </p>
            <p>
                <?php
                    $result = $x * $y;
                    echo "$x * $y = $result";
                ?>
            </p>
            <p>
                <?php
                    $result = $x / $y;
                    echo "$x / $y = $result";
                ?>
            </p>
            <p>
                <?php
                    $result = $x % $y;
                    echo "$x % $y = $result";
                ?>
            </p>
        </div>
        <div>
            <h2>Lab 2 / Task 3</h2>
            <p>
                <?php
                    $variable = 8;
                    echo "Value is now $variable <br>" ;
                    $variable += 2;
                    echo "Add 2. Value is now $variable <br>";
                    $variable -= 4;
                    echo "Subtract 4. Value is now $variable <br>";
                    $variable *= 5;
                    echo "Multiply by 5. Value is now $variable<br>";
                    $variable /= 3;
                    echo "Divide by 3. Value is now $variable<br>";
                    ++$variable;
                    echo "Increment value by one. Value is now $variable<br>";
                    --$variable;
                    echo "Decrement value by one. Value is now $variable<br>";
                ?>
        </div>
        <div>
            <h2>Lab 2 / Task 4</h2>
            <p>
                <?php
                    $around="around";
                    echo "What goes $around comes $around. \"\"";
                    echo "<br>";
                    echo 'What goes $around comes $around. \'\'';
                ?>
            </p>
        </div>
        <div>
            <h2>Lab 2 / Task 5</h2>
            <p>
                <?php
                    $whatsit = "Tekst";
                    echo "Value is " . gettype($whatsit) . "<br>";
                    $whatsit = 12.2;
                    echo "Value is " . gettype($whatsit) . "<br>";
                    $whatsit = true;
                    echo "Value is " . gettype($whatsit) . "<br>";
                    $whatsit = 12;
                    echo "Value is " . gettype($whatsit) . "<br>";
                    $whatsit = NULL;
                    echo "Value is " . gettype($whatsit) . "<br>";

                ?>
            </p>
        </div>
        <div>
            <h2>Lab 2 / Task 6</h2>
            <p>
                <?php
                    $weather = array("rain", "sunshine", "clouds", "hail", "sleet", "snow", "wind");
                    echo 'We\'ve seen all kinds of weather this month. At the beginning of the month, we had ' . $weather[5] . ' and ' . $weather[6] . '.
                    Then came ' . $weather[1] .' with a few ' . $weather[2] . ' and some ' . $weather[0] . '.
                    At least we didn\'t get any ' . $weather[3] . ' or ' . $weather[4] . '<br> <br>';

                    echo "We've seen all kinds of weather this month. At the beginning of the month, we had $weather[5] and $weather[6].
                    Then came $weather[1] with a few $weather[2] and some $weather[0].
                    At least we didn't get any $weather[3] or $weather[4].";
                ?>
            </p>
        </div>
    </body>
</html>
