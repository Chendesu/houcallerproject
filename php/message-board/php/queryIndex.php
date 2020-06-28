<?php

$conn = new mysqli('127.0.0.1', 'root', '', 'test');
if ($conn->connect_error) {
  exit("<script>
    alert('数据库连接失败');
    location.href='../index.php';
  </script>");
}
mysqli_query($conn, "set names 'utf8'");
$sql="select * from message order by id desc";
$result=$conn->query($sql);
$arr=array();
while($row = mysqli_fetch_array($result)){
  $array = array(
    'id'=>$row['id'],
    'username' => $row['username'],
    'time' => $row['time'],
    'text' => $row['text'],
    'image' => $row['image']
  );
  array_push($arr,$array);
}

print_r(json_encode($arr, JSON_UNESCAPED_UNICODE));

mysqli_close($conn);

