<?php
class Test
{
  public function __invoke($arg)
  {
    var_dump($arg);
  }
}

$test = new Test();
$test('go……');