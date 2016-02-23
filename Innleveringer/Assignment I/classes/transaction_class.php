<?php
/**
 *
 */
class transaction extends account {
    protected $type;
    protected $value;
    protected $associatedAccount;
    protected $date;

    // constructor
    function __construct($t, $v, $a, $d) {
		$this -> type = $t;
		$this -> value = $v;
		$this -> associatedAccount = $a;
        $this -> date = $d;

        parent::$withdrawals++;
        parent::$deposits++;
	}

    // destructor
    function __destruct() {
		parent::$withdrawals--;
        parent::$deposits--;
	}

    // setter and getter methods
    public function set_type($t) {
		return $this -> type = $t;
	}

	public function get_type() {
		return $this -> type;
	}

    public function set_value($v) {
		return $this -> value = $v;
	}

	public function get_value() {
		return $this -> value;
	}

    public function set_associatedAccount($a) {
		return $this -> associatedAccount = $a;
	}

	public function get_associatedAccount() {
		return $this -> associatedAccount;
	}

    public function set_date($d) {
		return $this -> date = $d;
	}

	public function get_date() {
		return $this -> date;
	}
}

 ?>
