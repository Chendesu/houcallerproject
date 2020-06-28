<?php
header('content-type:text/html;charset=utf-8');
// 在函数体内使用全局变量
$i=1;
$j=2;
function test(){
  var_dump($i,$j);
}
test();
echo '<hr>';
function test1(){
  global $i, $j;
  var_dump($i, $j);//1 2
  $i=3;
  $j=5;
}
test1();
var_dump($i,$j); // 3 5
echo '<hr>';
function test2(){
  global $m,$n;
  $m=3;
  $n=6;
}
test2();
var_dump($m,$n); // 3 6
echo '<hr>';

$username = 'chen';
$age=18;
function test3(){
  echo $GLOBALS['username'];
}
test3(); // chen


echo '<hr>';
function test4(&$j){
  $j+=20;
  var_dump($j);
}
$m=5;
test4($m); // 25
var_dump($m);  // 25
// test4(3); //Only variables can be passed by reference in
