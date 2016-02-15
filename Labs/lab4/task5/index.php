<?php

class shape {
    private $area;
    static $shapes = [
        'rectangle' => 0,
        'circle' => 0
    ];
    // protected $countRek = 0;
    // protected $countCir = 0;

    function __construct() {
        self::$shapes[get_class($this)]++;
    }

    protected function set_area($area) {
        $this->$area = $area;
    }

    protected function get_area() {
        return $this->$area;
    }

    public function getShapes(){
        return "We have " . self::$shapes['rectangle'] . " rectangles and " . self::$shapes['circle'] . ' circles!';
    }

    protected function areacalc() {
        $this->set_area(0);
    }

    function __destruct() {
        self::$shapes[get_class($this)]--;
    }
}

/**
 *
 */
class rectangle extends shape {
    private $length, $width;

    function __construct($w, $h){
        $this->width = $w;
        $this->length = $h;
        parent::__construct();
    }
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

    public final function areacalc() {
        $area = $this->get_lenght() * $this->get_width();
        return $area;
    }

        //parent::$countRek++;

}

/**
 *
 */
// class circle extends shape {
//     function __construct() {
//         # code...
//     }
// }

$rek1 = new rectangle(10, 10);
$rek1->areacalc();
$rect2 = new rectangle(20, 5);
print($rek1->areacalc());
echo $rek1->getShapes();
?>
