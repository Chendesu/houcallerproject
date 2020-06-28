<?php
class Test
{
  public static function __callStatic($name, $arguments)
  {
    echo $name;
    echo "<br>";
    print_r($arguments);
  }
}

Test::go(1,'ok');