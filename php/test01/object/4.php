<?php 
header("content-type:text/html;charset=utf-8");

class Dad{
  public function Kungfu()
  {
    echo "hahah 2333";
  }
}
class CoolGuy extends Dad{
  public function run()
  {
    $this->Kungfu();
  }
}
$coolguy = new CoolGuy();
$coolguy->run();















?>