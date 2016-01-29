<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 3</title>
</head>
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
</body>
</html>
