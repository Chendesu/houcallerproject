<?php


trait A
{
  public $abc = "abc";
  public function a(){
    echo "hello ";
  }
}

trait B
{
  public function b(){
    echo "world ";
  }
}

/**
 * 
 */
trait C
{
  use A,B;
}


class Test
{
  use C;
  public function c(){
    echo $this->abc;
  }
}

$test = new test();
$test->a();
$test->b();
$test->c();
