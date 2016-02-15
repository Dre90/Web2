<?php
/* PROGRAMMING FOR WEB II
   LAB 4 / TASK 3 ANSWER */

//Create array.
$months = array(array('January', 31),
				array('February', 28),
				array('March', 31), array('April', 30),
				array('May', 31), array('June', 30),
				array('July', 31), array('August', 31),
				array('September', 30),
				array('October', 31),
				array('November', 30),
				array('December', 31));

//print array
function printMonths($arr) {
	echo "I am the first function -- printing months array!<br><br>";

	for ($i = 0; $i < 12; $i++) {
		$txt = "'" . $arr[$i][0] . "'=>" . $arr[$i][1] . " days";
		$txt .= ($i == 11) ? "<br>" : ",";
		$txt .= "<br>";
		echo $txt;
	}
}

//modify the array
function modifyMonths(&$arr) {
	echo "I am the second function -- modifying months array!<br>";

	for ($i = 0; $i < 12; $i++) {
		if($arr[$i][1] == 31)
			$arr[$i][0] = strrev(ucfirst(strrev(strtolower($arr[$i][0]))));
	}
}

printMonths($months);
modifyMonths($months);
printMonths($months);
?>   
