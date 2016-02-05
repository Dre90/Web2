<?php

class shape {
    private $area;
    // protected $countRek = 0;
    // protected $countCir = 0;

    protected function set_area($area) {
        $this->$area = $area;
    }

    protected function get_area() {
        return $this->$area;
    }

    protected function areacalc() {
        $this->set_area(0);
    }
}

/**
 *
 */
class rectangle extends shape {
    private $length, $width;

    public function set_lenght($x) {
        $this->length = $x;
    }

    public function set_width($y) {
        $this->width = $y;
    }

    public function get_lenght() {
        return $this->length;
    }

    public function get_width() {
        return $this->width;
    }

    public function areacalc() {
        $area = $this->get_lenght() * $this->get_width();
        return $area;
    }

    function __construct() {
        parent::areacalc();
        //parent::$countRek++;
    }

    function __destruct() {
        //parent::$countRek--;
    }
}

/**
 *
 */
// class circle extends shape {
//     function __construct() {
//         # code...
//     }
// }

$rek1 = new rectangle;
$rek1->set_lenght(10);
$rek1->set_width(10);
$rek1->areacalc();
print($rek1->areacalc());
//print($rek1->area);
?>
