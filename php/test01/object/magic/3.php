<?php
class Test
{
  private $abc = 'abc';

  public function __unset($var){
    echo "__unset:".$var;
    unset($this->$var);
  }
}

$test = new Test();
unset($test->abc);