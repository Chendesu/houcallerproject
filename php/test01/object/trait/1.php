<?php

trait Bt
{
  public function atest(){
    echo "hello ";
  }

  public function btest(){
    echo "world";
  }

  public function ab(){
    $this->atest();
    $this->btest();
  }

}

class Test
{
  use Bt;
}

class Tmp
{
  use Bt;
}

$test = new Test();
$test->ab();