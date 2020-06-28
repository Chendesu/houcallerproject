<?php
header('content-type:text/html;charset=utf-8');
session_start();

$_SESSION['username'] = 'king';
$_SESSION['age'] = 23;

echo 'session的名字：'.session_name().'<br>';
echo 'session的ID：'.session_id().'<br>';
setcookie(session_name(),session_id(),time()+3600);// 设置过期时间





















?>