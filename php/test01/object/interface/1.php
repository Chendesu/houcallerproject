<?php
interface Person
{
  public function eat();

  public function sleep();
}

class Man implements Person
{
  public function eat(){
    echo "吃海鲜大餐……";
  }

  public function sleep(){
    echo "半夜睡觉……";
  }
}

class Woman implements Person
{
  public function eat()
  {
    echo "吃水果……";
  }

  public function sleep()
  {
    echo "十点睡觉……";
  }
}

class L
{
  public static function factory(Person $user){
    return $user;
  }
}
$user = L::factory(new Woman());
$user->eat();
$user->sleep();

