<?php 
class Test
{
  private $abc = '';

  public function __set($var,$val){
    $this->$var = $val;
  }

  public function __get($var) {
    return $this->$var;
  }

}

$test = new Test();
$test->abc = 'abc';
var_dump($test->abc);



?>