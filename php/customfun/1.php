<?php
echo phpinfo();
/**
 * 获取文件扩展名
 *
 * @param string $name 文件名
 * @return 返回文件类型
 */
function substrFun($name){
  $str = $name;
  $arr = explode('.',$str);
  $len = count($arr);
  return $arr[$len-1];
}
echo substrFun('1.php.txt');
echo '<hr>';
echo pathinfo('1.html',PATHINFO_EXTENSION);
echo '<hr>';
echo '<hr>';
// echo mt_rand(1,10);
echo '<br>';
var_dump(range(0, 9));
echo '<br>';
var_dump(array_rand(range(0, 9),5));
echo '<br>';
var_dump(array_rand(array_flip(array_merge(range('a', 'z'), range('A', 'Z'))), 4));