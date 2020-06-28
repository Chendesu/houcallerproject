<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC'); // 设置当前时区
session_start();

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != 1 || !isset($_SESSION['username'])) {
  // exit("<script>
  //       alert('请先登录');
  //       location.href='login.php';
  //     </script>");
  $array=array(
    'status'=>0,
    'remark'=>'请先登录'
  );
} else {
  // $array = array(
  //   'status' => 1,
  //   'remark' => '登录成功',
  //   'username'=> $_SESSION['username']
  // );
  $dbArr = connDB();
  $array = $dbArr;

}
print_r(json_encode($array, JSON_UNESCAPED_UNICODE));

/**
 * 连接数据库
 *
 * @return void
 */
function connDB(){
  $conn=new mysqli('127.0.0.1','root','','test');
  if($conn->connect_error){
    return array(
      'dbStatus' => 'fail'
    );
  } else {
    return array(
      'dbStatus'=>'success',
      'conn'=>$conn
    );
  }
}