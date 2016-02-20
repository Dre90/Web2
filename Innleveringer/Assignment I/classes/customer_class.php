<?php
/**
 * The customer class
 */
class customer {
    protected $name;
	protected $surname;
	protected $birthdate;
	protected $address;
    protected $totalAssets;
    static $customerCount = 0;

	// constructor
	function __construct($n, $s, $b, $a) {
		$this -> name = $n;
		$this -> surname = $s;
		$this -> birthdate = $b;
		$this -> address = $a;

        self::$customerCount++;
	}

    // destructor
    function __destruct() {
		self::$customerCount--;
	}

	// setter and getter methods
	public function set_name($n) {
        $this -> name = $n;
    }

	public function get_name() {
		return $this -> name;
	}

	public function set_surname($s) {
		$this -> surname = $s;
	}

	public function get_surname() {
		return $this -> surname;
	}

	public function set_birthdate($b) {
		$this -> birthdate = $b;
	}

	public function get_birthdate() {
		return $this -> birthdate;
	}

	public function set_address($a) {
		return $this -> address = $a;
	}

	public function get_address() {
		return $this -> address;
	}
}

 ?>
