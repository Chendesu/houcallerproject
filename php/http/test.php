<?php
echo "http";
/*
 * 1、请求行 POST/http/test.php HTTP/1.1
 * 2、首部
 *        HOST:localhost
 *        Content-type:application/x-www-form-urlencoded
 *        content-length:20
 * 
 *        act=query&name=ghost
 * 
 */
/*
  POST/http/test.php HTTP/1.1
  HOST:localhost
  Content-type:application/x-www-form-urlencoded
  content-length:20
  act=query&name=ghost
 */
// $n = array("a","b","c");
// $str = implode($_POST, "\n");
// echo $str;