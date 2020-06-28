<?php
header("content-type:text/html;charset=utf-8;");
session_start();
date_default_timezone_set("PRC"); // 设置时区

$query = $_GET["query"];
// echo $query;
// exit;

$conn = new mysqli("127.0.0.1","root","","test");
if($conn->connect_error){
  exit("数据库连接失败");
} 
mysqli_query($conn,"set names 'utf8'");

if($query== 'insert') {
    $username = $_SESSION['username']; // 用户名
    $title = $_POST["title"]; //标题
    $content = $_POST["content"]; // 正文
    $time = date("Y-m-d H:i:s"); // 发布时间
    $read = 0; // 点击数，默认0
      $sql_insert = "INSERT INTO `daily`( `username`, `title`, `content`, `time`, `read`) VALUES ('$username','$title','$content','$time','$read')";
      $result_insert = $conn->query($sql_insert);
      if($result_insert){
        echo "提交成功"; exit;
      } else {
        echo "提交失败，请稍后重试"; exit;
      }
}
if($query== 'query'){
  $sql = "SELECT * FROM daily ";
  $result = $conn->query($sql);
  $arr = array();
  while($row = mysqli_fetch_array($result)){
    $array = array(
      'id'=>$row['id'],
      'user'=>$row['username'],
      'title'=>$row['title'],
      'content'=>$row['content'],
      'time'=>$row['time'],
      'read'=>$row['read']
    );
    array_push($arr,$array);
  }
  print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
  mysqli_close($conn);
}

