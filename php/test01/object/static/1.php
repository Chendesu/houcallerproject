<?php
class A {
  public static function who() {
    echo "A类的who方法";
  }
  public static function test() {
    static::who();// 后期绑定，告诉PHPstatic指向的是哪个类
    // self::who();
  }
}

class B extends A {
  public static function who() {
    echo "B类的who方法";
  }
}

B::test();

// A类的test方法里是用static::who();这里的static告诉PHP指向的是哪个类；B::test()指向的是B类，因此这里输出的信息是“B类的who方法”。