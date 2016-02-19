<?php
/* PROGRAMMING FOR WEB II
 LAB 5 / TASK 1 ANSWER */

$ceu = array("Italy" => "Rome", "Luxembourg" => "Luxembourg", "Belgium" => "Brussels", "Denmark" => "Copenhagen", "Finland" => "Helsinki", "France" => "Paris", "Slovakia" => "Bratislava", "Slovenia" => "Ljubljana", "Germany" => "Berlin", "Greece" => "Athens", "Ireland" => "Dublin", "Netherlands" => "Amsterdam", "Portugal" => "Lisbon", "Spain" => "Madrid", "Sweden" => "Stockholm", "United Kingdom" => "London", "Cyprus" => "Nicosia", "Lithuania" => "Vilnius", "Czech Republic" => "Prague", "Estonia" => "Tallin", "Hungary" => "Budapest", "Latvia" => "Riga", "Malta" => "Valetta", "Austria" => "Vienna", "Poland" => "Warsaw");

// sort by value ascending
asort($ceu);
foreach ($ceu as $country => $capital) {
	echo "The capital of $country is $capital <br />";
}

echo "<br>";

// sort by key descending
krsort($ceu);
foreach ($ceu as $country => $capital) {
	echo "The capital of $country is $capital <br />";
}

echo "<br>";

// sort by value descending
arsort($ceu);
foreach ($ceu as $country => $capital) {
	echo "The capital of $country is $capital <br />";
}

// sort by key ascending
ksort($ceu);
foreach ($ceu as $country => $capital) {
	echo "The capital of $country is $capital <br />";
}
?>
