<?php
header('content-type:text/html;charset=utf-8');

echo time();
echo '<hr>';
echo date('Y-m-d H:i:s') . '<br>';
echo date('Y-m-d H:i:s',time()) . '<br>';
echo '<hr>';
echo '一天之后的这个时间为：'. date('Y-m-d H:i:s', time()+24*3600). '<br>';
echo mktime(0,0,0,8,12);
echo '<br>';
echo date('Y-m-d H:i:s',mktime(0,0,0,8,12));
echo '<hr>';
$birth = mktime(0,0,0,12,7,1994);
$time=time();
$age = floor(($time-$birth)/(24*3600));
echo $age;
echo '<hr>';
echo '<hr>';
echo time();
echo strtotime('now').'<br>';
date('Y-m-d H:i:s',time()+24*3600).'<br>';
echo date('Y-m-d H:i:s', strtotime('+1 day')).'<br>';
echo date('Y-m-d H:i:s', strtotime('-1 day')) .'<br>';
echo date('Y-m-d H:i:s', strtotime('+5 days')) . '<br>';
echo date('Y-m-d H:i:s', strtotime('+1 month')) . '<br>';
echo date('Y-m-d H:i:s', strtotime('+2 years 3months 12 days')) . '<br>';
