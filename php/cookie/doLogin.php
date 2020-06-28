<?php
header("Content-type: text/html;charset=utf-8");
$username = $_POST['username'];
$password = md5($_POST['password']);
$autologin = $_POST['autologin'];

$link = mysqli_connect('localhost','root','') or die('Connect Error');
mysqli_set_charset($link,'utf8');
mysqli_select_db($link,'test') or die('Database Open Error');
$sql = "select id,username,password from user where username='$username' and password='$password'";
$result = $link->query($sql);
$num = mysqli_num_rows($result);

if($num==1){
  if($autologin==1){
    $row = mysqli_fetch_assoc($result);
    setcookie('username',$username, strtotime('+7 days'));
    $salt='king';
    $auth = md5($username.$password.$salt).":".$row['id'];
    setcookie('auth',$auth,strtotime('+7 days'));
  } else {
    setcookie('username',$username);
  }
 exit("<script>
  alert('登录成功');
  location.href='index.php';
 </script>");
} else {
  exit("<script>
    alert('登录失败');
    location.href='login.php';
  </script>");
}

?>