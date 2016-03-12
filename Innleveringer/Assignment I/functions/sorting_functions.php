<?php
	//Amount in ascending order
	function sort_value_ascending($a, $b) {
		if($a->get_value() == $b->get_value()){ return 0 ; }
		return ($a->get_value() < $b->get_value()) ? -1 : 1;
	}
	//Amount in descending order
	function sort_value_descending($a, $b) {
		if($a->get_value() == $b->get_value()){ return 0 ; }
		return ($a->get_value() > $b->get_value()) ? -1 : 1;
	}
	//Date in ascending order
	function sort_date_ascending($a, $b) {
		if($a->get_date() == $b->get_date()){ return 0 ; }
		return ($a->get_date() < $b->get_date()) ? -1 : 1;
	}
	//Date in descending order
	function sort_date_descending($a, $b) {
		if($a->get_date() == $b->get_date()){ return 0 ; }
		return ($a->get_date() > $b->get_date()) ? -1 : 1;
	}
?>
