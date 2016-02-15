<?php
$ceu = array(
    "Italy"=>"Rome",
    "Luxembourg"=>"Luxembourg",
    "Belgium"=> "Brussels",
    "Denmark"=>"Copenhagen",
    "Finland"=>"Helsinki",
    "France" => "Paris",
    "Slovakia"=>"Bratislava",
    "Slovenia"=>"Ljubljana",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Ireland"=>"Dublin",
    "Netherlands"=>"Amsterdam",
    "Portugal"=>"Lisbon",
    "Spain"=>"Madrid",
    "Sweden"=>"Stockholm",
    "United Kingdom"=>"London",
    "Cyprus"=>"Nicosia",
    "Lithuania"=>"Vilnius",
    "Czech Republic"=>"Prague",
    "Estonia"=>"Tallin",
    "Hungary"=>"Budapest",
    "Latvia"=>"Riga",
    "Malta"=>"Valetta",
    "Austria" => "Vienna",
    "Poland"=>"Warsaw"
) ;

echo "<h1>LAB 5 / TASK 1</h1>";

echo "<h2>Unsortet array</h2>";
foreach($ceu as $key => $item)
    echo "The capital of $key is $item<br>";
echo "<br>";
echo "<br>";

echo "<h2>Sort the list by the name of the country in ascending</h2>";
ksort($ceu);
foreach($ceu as $key => $item)
    echo "The capital of $key is $item<br>";
echo "<br>";
echo "<br>";

echo "<h2>Sort the list by the name of the country in descending</h2>";
krsort($ceu);
foreach($ceu as $key => $item)
    echo "The capital of $key is $item<br>";
echo "<br>";
echo "<br>";

echo "<h2>Sort the list by the name of city in ascending</h2>";
asort($ceu);
foreach($ceu as $key => $item)
    echo "The capital of $key is $item<br>";
echo "<br>";
echo "<br>";

echo "<h2>Sort the list by the name of city in descending.</h2>";
arsort($ceu);
foreach($ceu as $key => $item)
    echo "The capital of $key is $item<br>";
echo "<br>";
echo "<br>";


 ?>
