<?php 
class Person
{
  public static $hand = "手";//静态属性
  public static $foot = "脚";

  public $a = 1;

  public static function work(){ // 静态方法
    echo self::$hand; // 调用静态属性用self
    return "单纯的工作";
  }
}

class Imooc extends Person
{
  public function play(){ 
    // 子类调用父类的属性/方法
    // return parent::work();
    return parent::$hand;
  }
}

// $imooc = new Imooc();
// echo $imooc->play();

// echo Person::$hand; //属性
echo Person::work();  //方法


?>