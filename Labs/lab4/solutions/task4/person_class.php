<?php
class Person {
	//define protected properties
	protected $name;
	protected $owned_car;

	//this construct method only accepts name
	public function __construct($n){
		$this -> name = $n;
	}

	//setter methods
	public function set_name($n) {
		$this -> name = $n;
	}
	public function set_owned_car($c) {
		$this -> owned_car = $c;
	}

	//getter methods
	public function get_name() {
		return $this -> name;
	}
	public function get_owned_car() {
		return $this -> owned_car;
	}

}
?>
