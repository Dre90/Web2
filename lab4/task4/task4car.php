<?php
  class car {
    private $plate_number, $owner;

    public function set_plate_number ($plate_number) {
      $this->plate_number = $plate_number;
    }

    public function set_owner ($owner) {
      $this->owner = $owner;
    }

    public function get_plate_number () {
      return $this->plate_number;
    }

    public function get_owner () {
      return $this->owner;
    }

    function __construct ($pl, $o) {
      $this->plate_number = $pl;
      $this->owner = $o;
    }
  }
?>
