<?php
header("Content-type: text/html; charset=utf-8");
$username = $_POST['username'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$img = $_FILES['img'];
echo '<script>alert('.$img. ');history.go(-1);</script>';

$conn = new mysqli('127.0.0.1', 'root', '', 'db');
if ($conn->connect_error) {
  echo "数据库连接失败！";
  exit(0);
} else {
  if($username == ''){
    echo '<script>alert("请输入用户名！");history.go(-1);</script>';
    exit(0);
  }
  if($password == ''){
    echo '<script>alert("请输入密码！");history.go(-1);</script>';
    exit(0);
  }
  if($password != $repassword){
    echo '<script>alert("密码不一致！");history.go(-1);</script>';
    exit(0);
  }

  $sql = "select name from user where name = '$_POST[username]' ";
  $result = $conn->query($sql);
  $number = mysqli_num_rows($result);
  if($number){
    echo '<script>alert("用户名已存在");history.go(-1);</script>';
  } else {
    $sql_insert = "insert into user (name, password) values('$_POST[username]','$_POST[password]')";
    $res_insert = $conn->query($sql_insert);
    if($res_insert){
      echo '<script>window.location="login.html"</script>';
    } else {
      echo "<script>alert('系统繁忙，请稍候！');</script>";
    }
  }

}
