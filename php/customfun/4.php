<?php
header('content-type: text/html;charset=utf-8');
// 可变函数的使用
$funName = 'md5';// 将md5函数赋给funName
echo $funName('chen');
echo '<br>';
echo md5('chen');
echo '<hr>';
function test(){
  echo 'this is a test<br>';
}
test();
echo '<br>';
$funName = 'test';
$funName();
echo '<hr>';


// 回调函数
function study($username)
{
  echo $username.' is studying...<br>';
}
function play($username)
{
  echo $username . ' is playing...<br>';
}
function doWhat($funcName,$param)
{
  $funcName($param);
}
doWhat('study','chen');
echo '<hr>';
call_user_func('study','julia');

function add($x,$y)
{
  return $x+$y;
}
function reduce($x, $y)
{
  return $x - $y;
}
function calc($funcName, $i, $j)
{
  return $funcName($i,$j);
}
echo calc('add',1, 3);
echo '<hr>';
echo calc('reduce', 1, 3);
echo '<hr>';

$array = array(1,2,3,4);
function test1($var){
  return $var * 2;
}
$res = array_map('test1',$array);
print_r($res);
echo '<hr>';
$array2 = array(1, 2, 3, 4,5,6,7,8,9);
function test2($var){
  $var *= 3;
  return $var;
}
var_dump(array_walk($array2,'test2'));
print_r($array);

echo '<hr>';
$array3 = array(1, 2, 3, 4, 5, 6, 7);
function test3($var){
  if($var%2==1){
    return $var;
  }
}
$res3 = array_filter($array3,'test3');
var_dump($res3);



echo call_user_func('add',4,10);
echo '<hr>';
echo call_user_func_array('add',array(9,25));



