<?php
class Test
{
  public function __toString()
  {
    return "hello……";
  }
}
$test = new Test();
echo $test;