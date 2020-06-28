<?php 
header("content-type:text/html;charset=utf-8");
// 构造方法
class Computer{
  public function __construct($high = 0)
  {
    if($high){
      echo "高配的CPU就绪……";
      echo "高配的主板就绪……";
      echo "高配的内存就绪……";
    } else {
      echo "CPU就绪……";
      echo "主板就绪……";
      echo "内存就绪……";
    }
  }

  public function game()
  {
    echo "-----完成-----";
  }
}

$computer = new Computer(1);// 1是构造函数的参数
$computer->game();


?>