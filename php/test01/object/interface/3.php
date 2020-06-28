<?php
abstract class AB
{
  public function holiday(){
    echo "5月1号放假等等……";
  }
  public function eat(){}
  public function sleep(){}
}

class Test extends AB
{
  public function eat()
  {
    echo "吃烧鸡 ";
  }

  public function sleep()
  {
    $this->holiday();
    echo "学代码 不睡觉 ";
  }
}
$test = new Test();
$test->eat();
$test->sleep();
