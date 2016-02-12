<?php
/* PROGRAMMING FOR WEB II
   LAB 4 / TASK 5 ANSWER */

class Shape {
	private $area;
	//static values to keep track of objects
	static $num_rect = 0;
	static $num_circ = 0;

	//constructor method counts number of objects for each type
	function __construct() {
		if (get_class($this) == "Rectangle")
			self::$num_rect++;
		else if (get_class($this) == "Circle")
			self::$num_circ++;
	}

	//destruct method subsracts deleted objects from the count
	function __destruct() {
		if (get_class($this) == "Rectangle")
			self::$num_rect--;
		else if (get_class($this) == "Circle")
			self::$num_circ--;
	}

	//set area
	protected function set_area($a) {
		$this -> area = $a;
	}

	//get area
	protected function get_area() {
		return $this -> area;
	}

	//default calc method
	protected function calc_area() {
		$this -> area = 0;
	}

}

class Rectangle extends Shape {
	protected $height, $width;

	//call the parents construct method
	function __construct() {
		parent::__construct();
	}

	//override calc_area method
	public function calc_area() {
		$this -> set_area($this -> height * $this -> width);
	}

	//override get area method
	//NB: get_eare method of parent is protected
	//for outside access we override it as public
	public function get_area() {
		return parent::get_area();
	}

	//setter methods
	public function set_height($h) {
		$this -> height = $h;
	}

	public function set_width($w) {
		$this -> width = $w;
	}

	//getter methodds
	public function get_height($h) {
		return $this -> height;
	}

	public function get_width($w) {
		return $this -> width;
	}

}

class Circle extends Shape {
	protected $radius;
	const PI = 3.14;

	//call the parents construct method
	function __construct() {
		parent::__construct();
	}

	//override calc_area method
	public function calc_area() {
		$this -> set_area($this -> radius / 2 * self::PI);
	}

	//override get area method
	//NB: get_eare method of parent is protected
	//for outside access we override it as public
	public function get_area() {
		//access parent's protected method
		return parent::get_area();
	}

	//set radius
	public function set_radius($r) {
		$this -> radius = $r;
	}

	//get radius
	public function get_radius($r) {
		return $this -> radius;
	}

}

$rect = new Rectangle();
$rect -> set_height(5);
$rect -> set_width(4);
$rect -> calc_area();
echo "This object is a " . get_class($rect) . " and has an area of " . $rect -> get_area();
echo "<br>";

$circ = new Circle();
$circ -> set_radius(4);
$circ -> calc_area();
echo "This object is a " . get_class($circ) . " and has an area of " . $circ -> get_area();
echo "<br>";

$circ2 = new Circle();
$circ2 -> set_radius(6);
$circ2 -> calc_area();
echo "This object is a " . get_class($circ2) . " and has an area of " . $circ2 -> get_area();
echo "<br>";

echo "We now have " . Shape::$num_rect . " rectangles and " . Shape::$num_circ . " circles! <br>";

$circ2 = NULL;

echo "We now have " . Shape::$num_rect . " rectangles and " . Shape::$num_circ . " circles! <br>";
?>   
