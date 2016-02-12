<?php
class person {
    protected $name, $surname, $age, $balance;

    public function set_name($name){
        $this->name = $name;
    }

    public function set_surname($surname){
        $this->surname = $surname;
    }

    public function set_age($age){
        $this->age = $age;
    }

    public function set_balance($balance){
        $this->balance = $balance;
    }

    public function get_name(){
        return $this->name;
    }

    public function get_surname(){
        return $this->surname;
    }

    public function get_age(){
        return $this->age;
    }

    public function get_balance(){
        return $this->balance;
    }

    function __construct($n, $sn, $a, $b){
        self::set_name($n);
        self::set_surname($sn);
        self::set_age($a);
        self::set_balance($b);
    }

}

class employee extends person {
    public $title = "Employee" ;

    public function set_title(){
        $this->title = $title;
    }

    public function get_title(){
        return $this->title;
    }
}

class student extends person {
    public $title = "Student";

    public function set_title(){
        $this->title = $title;
    }

    public function get_title(){
        return $this->title;
    }
}
 ?>
