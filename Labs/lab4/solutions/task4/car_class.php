<?php
class Car {
	//define protected properties
	protected $plate_number;
	protected $owner;

	//this construct method accepts all the two parameters
	public function __construct($p, $o) {
		$this -> plate_number = $p;
		$this -> owner = $o;
	}

	//setter methods
	public function set_plate_number($p) {
		$this -> plate_number = $p;
	}
	public function set_owner($o) {
		$this -> owner = $o;
	}

	//getter methods
	public function get_plate_number() {
		return $this -> plate_number;
	}
	public function get_owner() {
		return $this -> owner;
	}

}
?>
