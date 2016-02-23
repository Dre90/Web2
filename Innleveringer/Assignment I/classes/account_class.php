<?php
/**
 * The account class
 */
class account  {
    protected $accountHolder;
	protected $currencyType;
	protected $balance;

    static $accountNumber = 10000;
    static $accountCount = 0;
    static $withdrawals = 0;
    static $deposits = 0;

	// constructor
	function __construct($ah, $ct, $b) {
		$this -> accountHolder = $ah;
		$this -> currencyType = $ct;
		$this -> balance = $b;

        self::$accountNumber++;
        self::$accountCount++;
	}

    // destructor
    function __destruct() {
		self::$accountCount--;
	}

	// setter and getter methods
	public function set_accountHolder($ah) {
        $this -> accountHolder = $ah;
    }

	public function get_accountHolder() {
		return $this -> accountHolder;
	}

	public function set_accountNumber($an) {
		$this -> accountNumber = $an;
	}

	public function get_accountNumber() {
		return $this -> accountNumber;
	}

	public function set_currencyType($ct) {
		$this -> currencyType = $ct;
	}

	public function get_currencyType() {
		return $this -> currencyType;
	}

	public function set_balance($b) {
		return $this -> balance = $b;
	}

	public function get_balance() {
		return $this -> balance;
	}


    // transactions
    public function transaction($type, $value, $associatedAccount, $date) {


        // if type = $withdrawal, $withdrawals ++
        //     balance + $value
        //
        // if type = $deposit, $deposits ++
        //     balance - $value

        // Skriv til file
    }
}
?>
