<?php 
header('content-type:text/html;charset=utf-8');
session_start();
if(!isset($_SESSION['isLogin'])||$_SESSION['isLogin']!=1 || !isset($_SESSION['username'])) {
  exit("<script>
        alert('请先登录');
        location.href='login.php';
      </script>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>网站首页</h1>
  <h2>欢迎您：<?php echo $_SESSION['username']; ?></h2>
  <h3><a href="userCenter.php">个人中心</a></h3>
</body>
</html>