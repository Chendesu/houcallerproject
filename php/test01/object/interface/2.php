<?php
interface Ia
{
  const ABC = "只是测试 ";
  public function eat();
}

interface Ib
{
  public function sleep();
}

class Test implements Ia, Ib
{
  public function eat(){
    echo "吃烧鸡 ";
  }

  public function sleep(){
    echo "学代码 不睡觉 ";
  }
}
$test = new Test();
$test->eat();
$test->sleep();
echo Ia::ABC; // 常量