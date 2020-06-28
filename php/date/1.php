<?php

header('content-type:text/html;charset=utf8');
/**
 * date_default_timezone_set();
 * date_default_timezone_get();得到当前时区
 * 亚洲时区：
 * PRC 中华人民共和国
 * 
 */
// echo '当前时区：'.date_default_timezone_get();

echo ini_get('date.timezone');
ini_set('date.timezone','Asia/Shanghai');
echo ini_get('date.timezone');