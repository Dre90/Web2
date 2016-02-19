<?php
/* PROGRAMMING FOR WEB II
 LAB 5 / TASK 5 ANSWER */

$file = fopen("data.txt", "r") or die("Can not open the file!");
$data = array();

$s_index = 0;
$e_index = 0;

// read data file
while (!feof($file)) {
	$row = explode(",", fgets($file));

	// maintain index number for student and employee categories
	if ($row[0] == "student") {
		$index = $s_index;
		$s_index++;
	} else {
		$index = $e_index;
		$e_index++;
	}

	// add data into array structure
	$data[$row[0]][$index]["name"] = $row[1];
	$data[$row[0]][$index]["surname"] = $row[2];
	$data[$row[0]][$index]["age"] = $row[3];
	$data[$row[0]][$index]["balance"] = $row[4];
}
fclose($file);

echo <<<_END
<html>
	<head>
		<title>People</title>
	</head>
	<body>
		<table border=1>
_END;

// iterate over the data array
foreach ($data as $category) {
	foreach ($category as $person) {
		echo "<tr>";
		foreach ($person as $key => $value) {
			if ($key != "balance")
				echo "<td>$value</td>";
			else
				printf("<td>%.1f</td>", $value);
		}
		echo "</tr>";
	}
}

echo <<<_END
		</table>
	</body>
</html>
_END;
?>
