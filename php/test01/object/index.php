<?php
header("content-type:text/html;charset=utf-8;");

class Computer {
  public $cpu = 'amd 5000';
  public $mainboard = '华硕9000x';
  private $hd = 512;

  public function game($gameName='')
  {
    // echo $this->hd;
    if($this->getHdSize() < 1024){
      echo "硬盘太小，玩不了游戏";
      return false;
    }
    return true;
  }

  public function job($work='写代码')
  {
    echo ($this->game());
  }

  private function getHdSize()
  {
    return $this->hd;
  }
}

// 实例
$computer = new Computer();
$computer->job();


?>