<?php
header("Content-type: text/html;charset=utf-8");
$username = $_POST['username'];
$password = $_POST['password'];
$conn = new mysqli('127.0.0.1','root','','db');
if($conn->connect_error){
  echo "数据库连接失败！";
  exit(0);
} else {
  if($username == ''){
    echo '<script>alert("请输入用户名！");history.go(-1);</script>';
    exit(0);
  }
  if ($password == '') {
    echo '<script>alert("请输入密码！");history.go(-1);</script>';
    exit(0);
  }
  $sql = "select name, password from user where name = '$_POST[username]' and password = '$_POST[password]' ";
  $result = $conn->query($sql);
  $number = mysqli_num_rows($result);
  if($number){
    echo '<script>window.location="index.html"</script>';
  } else {
    echo '<script>alert("用户名或密码错误！");history.go(-1);</script>';
  }

}