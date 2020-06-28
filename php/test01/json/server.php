<?php
// 连接数据库进行数据读取
$inAjax = $_GET('inAjax');
$do = $_GET('do');
$do = $do ? $do : "default";

if(!$inAjax) return false;

switch($do) {
  case "checkMember":
    echo time();
    break;
  case "default": 
    die("nothing");
    break;
}


// 将数据库查询返回的对象，转换成json格式，然后返回给客户端

?>