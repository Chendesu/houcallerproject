<?php
/**
 * 截取文件扩展名
 *
 * @param string $filename
 * @return string
 */
function getExt($filename){
  return strtolower(pathinfo($filename,PATHINFO_EXTENSION));
}
/**
 * 计算机
 *
 * @param numner $num1
 * @param number $num2
 * @param string $op
 * @return string
 */
function calc($num1,$num2,$op='+'){
  if(!is_numeric($num1)||!is_numeric($num2)){
    exit('非法输入...<br>');
  }
  switch($op){
    case "+":
      $res = $num1 + $num2;
      break;
    case "-":
      $res = $num1 - $num2;
      break;
    case "*":
      $res = $num1 * $num2;
      break;
    case "/":
      if($num2!=0){
        $res = num1/num2;
      } else {
        exit('0不能当做除数');
      }
      break;
    case "%":
      $res = $num1 % $num2;
      break;
  }
  return '{$num1}{$op}{$num2}={$res}';
}
/**
 * 获取时间，格式化时间
 *
 * @param string $del1 分隔符，默认年
 * @param string $del2 分隔符，默认月
 * @param string $del3 分隔符，默认日
 * @return string
 */
function getDateStr($del1='年',$del2='月',$del3='日'){
  $dayArr = array('日','一','二','三','四','五','六');
  $day = date('w');
  echo date('Y{$del1}m{$del2}d{$del3} 星期').$dayArr[$day];
}