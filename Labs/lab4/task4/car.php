<?php
class car {
    private $plate_number, $owner;

    public function set_plate_number($plate_number){
        $this->plate_number = $plate_number;
    }

    public function set_owner($owner){
        $this->owner = (string)$owner;
    }

    public function get_plate_number(){
        return $this->plate_number;
    }

    public function get_owner(){
        return $this->owner;
    }

    function __construct($p1, $p2){
        $this->plate_number = $p1;
        $this->owner = $p2;
    }
}
?>
