<?php
/* PROGRAMMING FOR WEB II
   LAB 3 / TASK 5 ANSWER */

//define cities array
$cities = array(
	array("Istanbul","14000000","5461"),
	array("Oslo","634463","8900"),
	array("Ghent","284242","156.18"),
	array("Paris","2273305","17174.4")
);

//set min to an empty value
$min = "";

for($i=0;$i<=3;$i++){

	//calculate density
	$density = (int) ($cities[$i][1] / $cities[$i][2]);

	//print city information
	echo $cities[$i][0] . "<br>";
	echo "Population: " . $cities[$i][1] . "<br>";
	echo "Area: " . $cities[$i][2] . "<br>";
	echo "Density: " . $density;
	echo "<br><br>";

	//compare min density against current city's density
	if($min == ""){
		$min = $density;
	} else if($min>$density){
		$min = $density;
	}

}

//print the min density
echo "The minimum density is: ". $min;

?>   
