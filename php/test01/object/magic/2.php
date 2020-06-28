<?php 
class Test
{
  private $abc = 'abc';

  public function __isset($var)
  {
    return isset($this->$var) ? true : false;
  }
}

$test = new Test();
var_dump(isset($test->abc));

?>