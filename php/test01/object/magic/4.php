<?php
class Test
{
  public function __call($func, $arguments){
    echo $func;
    echo "<br>";
    print_r($arguments);

  }
}

$test = new Test();
$test->go(1,'ok');