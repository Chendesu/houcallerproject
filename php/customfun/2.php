<?php
// 局部变量——动态变量
function test(){
  $i=1;
  $j=2;
  echo $i . '<br>';
  echo $j . '<br>';
}
test(); // 1  2
var_dump($i,$j);// null null
echo '<hr>';
// 局部变量——静态变量
function test1(){
  static $i=1;
  echo  $i.'<br>';
  ++$i;
}
test1();// 1
test1();// 2
test1();// 3
test1();// 4
var_dump($i); // null
$i = 1;
$j = 2;
function test2(){
  global $i,$j;
  var_dump($i, $j);
  $i=3;
  $j=5;
}
test2();

