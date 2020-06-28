<?php
header('content-type:text/html;charset=utf-8');
function test($i){
  echo $i.'<br>';
  if($i>=0){
    $func = __FUNCTION__;
    $func($i-1);
  }
  echo $i.'<br>';
}
test(3);