<?php
// 单例模式
// class Test 
// {
//   private static $_instance = null;

//   private function __construct()
//   {

//   }

//   private function __clone()
//   {

//   }

//   public static function getInstance()
//   {
//     //判断对象是否是当前类的实例
//     if(!(self::$_instance instanceof self)){
//       // 若不是，则实例化当前对象
//       self::$_instance = new self();
//     }
//     // 若是，则返回实例化的对象
//     return self::$_instance;
//   }
// }

// $test1 = Test::getInstance();
// $test2 = Test::getInstance();
// $test3 = Test::getInstance();
// $test4 = Test::getInstance();

// var_dump($test1);
// var_dump($test2);
// var_dump($test3);
// var_dump($test4);


// 工厂模式

class Memcache
{
  public function set($k,$v)
  {
    echo $k;
    echo "<br>";
    echo $v;
  }
  public function get($k)
  { 

  }
  public function delete($k)
  {

  }
}

class Cache
{
  public static function factory()
  {
    return new Memcache();
  }
}

$cache = Cache::factory();
$cache->set(1,2);