<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 3</title>
</head>
<style>
    table {
        border: solid 1px black;
    }
    td {
        border: solid 1px black;
        padding: 5px;
        text-align: center;
    }

</style>
<body>
    <h1>LAB 3</h1>
    <div>
        <h2>TASK 1</h2>
        <?php
            if (date('F', time()) == "August") {
                echo "It's August, so it's really hot.";
            } else {
                echo "Not August, so at least not in the peak of the heat.";
            }
        ?>
    </div>

    <div>
        <h2>TASK 2</h2>
        <p>
            <?php
                $abc = 1;

                while($abc <= 9) {
                    echo "abc ";
                    $abc++;
                }
            ?>
        </p>
        <p>
            <?php
                $xyz = 1;
                do {
                    echo "xyz ";
                    $xyz++;
                } while($xyz <= 9);
            ?>
        </p>
        <p>
            <?php
                for ($count = 1; $count <= 9; $count++) {
                    echo "$count ";
                }
            ?>
        </p>
        <p>
            <?php
                for ($letters = A; $letters <= F; $letters++) {
                    echo "Item $letters <br>";
                }
            ?>
        </p>
    </div>
    <div>
        <h2>TASK 3</h2>
        <p>
            <?php
                for ($i=1; $i <= 12; $i++) {
                    echo "$i * $i = " . $i * $i . "<br>";
                }
            ?>
        </p>
    </div>
    <div>
        <h2>TASK 4</h2>
        <table>
            <?php
                for ($x=1; $x <= 7 ; $x++) {
                    echo "<tr>";
                    for ($y=1; $y <= 7 ; $y++) {
                        echo "<td>" . $x * $y . "</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
