<?php
header('content-type:text/html;charset=utf-8');

// 匿名函数
$func=function(){
  return 'this is a test';
};
echo $func();
echo '<hr>';
$func = function($username){
  return 'say hi to '. $username;
};
echo $func('chen');
echo '<hr>';

// 通过create_function()
$func = create_function('','echo "this is a 2333";');
$func();
echo '<hr>';
$func1 = create_function('$x,$y','return $x+$y;');
echo $func1(2,5);

echo '<hr>';

$array = [1,2,3,4,5];
$res = array_map(function($var){return $var*2;},$array);
print_r($res);
echo '<hr>';
call_user_func(function($username){echo "hello $username";},'chen');
