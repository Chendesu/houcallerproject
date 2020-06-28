<?php
header("content-type:text/html;charset=utf-8");
session_start();
$_SESSION['a'] = 'aaa';
$_SESSION['b'] = 'bbb';
echo "<a href='dump.php?".session_name()."=".session_id()."'>查看信息</a>";
// 当用户手动禁止掉浏览器的cookie时，此时的session还能继续用，可以用url进行传递参数