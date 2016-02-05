<?php
class person {
    private $name, $owned_car;

    public function set_name($name){
        $this->name = $name;
    }

    public function set_owned_car($owned_car){
        $this->owned_car = $owned_car ;
    }

    public function get_name(){
        return $this->name;
    }

    public function get_owned_car(){
        return $this->owned_car;
    }

    function __construct($p1){
        $this->name = $p1;
    }
}

?>
