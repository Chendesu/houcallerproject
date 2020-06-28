<?php
header('Content-type: text/html; charset=utf-8');
$userErr = $pwdErr = $repwdErr = "";
$user = $_POST["user"];
$pwd = $_POST["pwd"];
$repwd = $_POST["repwd"];

// $user = "Chen";
// $pwd = "123";
// $repwd = "123";


$arr = array();


$conn = new mysqli('127.0.0.1', 'root', '', 'db');
if($conn->connect_error) {
  echo '数据库连接失败';
  exit(0);
} else {

  if($user == "") {
    $userErr = "用户名不为空";
    $arr = ["userErr"=> $userErr];
  } 
  if($pwd == "") {
    $pwdErr = "密码不为空";
    $arr = $arr + ["pwdErr"=> $pwdErr];
  }
  if($pwd != $repwd) {
    $repwdErr = "密码不一致";
    $arr = $arr + ["repwdErr"=> $repwdErr];
  } else {
    $repwdErr = "";
    $arr = $arr + ["repwdErr" => $repwdErr];
  }

    $sql = "select name from user where name = '$user'";
    $result = $conn->query($sql);
    $number = mysqli_num_rows($result);
    if($number){
      $userErr = "用户名已存在";
      $arr = $arr + ["userErr" => $userErr];
    } else {
      $userErr = ""; //该用户名可注册
      $arr = $arr + ["userErr" => ""];
  
      $sql_insert = "insert into user (name, password) values('$user', '$pwd')";
      $res_insert = $conn->query($sql_insert);
      if ($res_insert) {
        $arr = $arr + ["status"=>"success"];
      } else {
        $arr = $arr + ["status" => "fail"];
      }
  
    }



  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  
    

}


