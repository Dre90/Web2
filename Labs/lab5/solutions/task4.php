<?php
/* PROGRAMMING FOR WEB II
 LAB 5 / TASK 4 ANSWER */

// Person class
class Person {
	protected $name;
	protected $surname;
	protected $age;
	protected $balance;

	// constructor
	function __construct($n, $s, $a, $b) {
		$this -> name = $n;
		$this -> surname = $s;
		$this -> age = $a;
		$this -> balance = $b;
	}

	// setter and getter methods
	function set_name($n) {
		$this -> name = $n;
	}

	function get_name() {
		return $this -> name;
	}

	function set_surname($s) {
		$this -> surname = $s;
	}

	function get_surname() {
		return $this -> surname;
	}

	function set_age($a) {
		$this -> age = $a;
	}

	function get_age() {
		return $this -> age;
	}

	function set_balance($b) {
		return $this -> balance = $b;
	}

	function get_balance() {
		return $this -> balance;
	}

}

// Student class
class Student extends Person {
}

// Employee class
class Employee extends Person {
}

// initiate objects
$person[] = new Student("Mark", "Weiser", 21, 120.65);
$person[] = new Student("Alice", "Karl", 20, 200.122);
$person[] = new Employee("Jony", "White", 25, 12.522);
$person[] = new Student("Ida", "Red", 25, 40.98);
$person[] = new Employee("June", "Green", 18, 70);

// open file for write
$file = fopen("data.txt", "w") or die("Can not open the file!");

// loop thrpugh object array and save content
for ($i = 0; $i < count($person); $i++) {
	fwrite($file, strtolower(get_class($person[$i])) . ", ");
	fwrite($file, $person[$i] -> get_name() . ", ");
	fwrite($file, $person[$i] -> get_surname() . ", ");
	fwrite($file, $person[$i] -> get_age() . ", ");
	fwrite($file, $person[$i] -> get_balance() . "\n");
}

// close the file
fclose($file);
?>
