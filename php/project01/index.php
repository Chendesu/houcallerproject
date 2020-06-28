<?php
//连接数据库
mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('db');
mysql_query("set names 'utf-8'");

$page = 2;
$pagesize = 2;
$offset = ($page - 1) * $pagesize;
$sql = "select * from user limit $offset, $pagesize";
$result = mysql_query($sql);
$data = array();
while($row = mysql_fecth_array($result, MYSQL_ASSOC)){
    $data[] = $row;
}
echo '<pre>';
print_r($data);
echo '</pre>';