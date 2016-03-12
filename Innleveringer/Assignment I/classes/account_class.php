<?php
    class account  {
        protected $id;
        protected $accountHolder;
    	protected $currencyType;
    	protected $balance;
        protected $accountNumber;
        protected $withdrawals = 0;
        protected $deposits = 0;
        static $accountCount = 0;

    	// constructor
    	function __construct($id, $ah, $an, $ct, $b, $w, $d) {
            $this -> id = $id;
    		$this -> accountHolder = $ah;
            $this -> accountNumber = $an;
    		$this -> currencyType = $ct;
    		$this -> balance = $b;
            $this -> withdrawals = $w;
            $this -> deposits = $d;

            self::$accountCount++;
    	}

        // destructor
        function __destruct() {
    		self::$accountCount--;
    	}

    	// setter and getter methods
        public function set_id($id) {
            $this -> id = $id;
        }

    	public function get_id() {
    		return $this -> id;
    	}
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

        public function set_withdrawals($w) {
    		return $this -> withdrawals += $w;
    	}

    	public function get_withdrawals() {
    		return $this -> withdrawals;
    	}

        public function set_deposits($d) {
    		return $this -> deposits += $d;
    	}

    	public function get_deposits() {
    		return $this -> deposits;
    	}
    }
?>
