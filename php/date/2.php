<?php
header("content-type:text/html;charset=utf-8");
echo date('Y年m月d日');
echo "<br>";
echo date('Y-m-d');
echo "<br>";
echo date('Y^\o^m^\o^d');
echo "<br>";
echo date('Y/m/d h:i:s');

echo '<br>';
$year = date('Y');
if($year%4==0&&($year%100!=0||$year%400==0)){
  echo $year.'是闰年';
} else {
  echo $year . '是平年';
}
echo '<br>';
echo date('L')? date('Y').'是闰年': date('Y').'是平年';

echo '<br>';
echo '全年中的第'.date('W').'周';

echo '<br>';
echo '当天是全年的第'.date('z').'天';

echo '<br>';
echo '当前月总共有' . date('t') . '天';
