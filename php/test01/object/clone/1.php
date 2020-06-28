<?php
// class A
// {
//   public $age = 0;
//   public $username = "";

//   public $obj = null;

//   public function __clone(){
//     $this->obj = clone $this->obj;
//   }
  
// }

// class B 
// {
//   public $sex = 0;
// }

// $a = new A();

// $a->obj = new B();

// $b = clone $a;// 深拷贝
// $b->obj->sex = 1;

// var_dump($a->obj->sex);


// 类型约束
class C
{
  public $name = "";
  public function go(){
    echo "gogogo...";
  }
}
function test(C $a){ // $a的类型必须是类C的对象
  $a->go();
}
test(new C());