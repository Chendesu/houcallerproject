<?php
header("Content-type: text/html;charset=utf-8");
if (!isset($_COOKIE['username'])) {
  exit("<script>
        alert('请您先登录');
        location.href='login.php';
      </script>");
}
if (isset($_COOKIE['auth'])) {
  // 校验用户登录凭证
  $auth = $_COOKIE['auth'];
  $resArr = explode(':', $auth);
  $userId = end($resArr);
  $link = mysqli_connect('localhost', 'root', '') or die('Connect Error');
  mysqli_set_charset($link, 'utf8');
  mysqli_select_db($link, 'test') or die('Database Open Error');
  $sql = "select id,username,password from user where id='$userId'";
  $result = $link->query($sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $password = $row['password'];
    $salt = 'king';
    $authStr = md5($username . $password . $salt);
    if ($authStr != $resArr[0]) {
      exit("<script>
            alert('请您先登录之后再进行访问');
            location.href='login.php';
          </script>");
    }
  } else {
    exit("<script>
          alert('请您先登录之后再进行访问');
          location.href='login.php';
        </script>");
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>网站首页</title>
  <style>
    * {
      padding: 0;
      margin: 0
    }

    .wrap header {
      width: 100%;
      padding: 0 20px;
      height: 34px;
      background: #333;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      font-size: 1px;
      color: #fff;
      box-sizing: border-box;
    }

    .wrap nav {
      background: #ffe627;
    }

    .wrap nav ul {
      width: 960px;
      margin: 0 auto;
    }

    .wrap nav ul li {
      display: inline-block;
    }

    .wrap nav ul li a {
      display: inline-block;
      padding: 20px;
      font-size: 16px;
      color: #18165f;
      text-decoration: none;
      font-weight: bold;
      border-bottom: 4px solid #ffe627;
    }

    .wrap nav ul li a:hover {
      border-bottom: 4px solid #18165f;
    }
  </style>
</head>

<body>


  <div class="wrap">
    <header>欢迎您！<?php echo $_COOKIE['username']; ?></header>
    <nav>
      <ul>
        <li><a href="#">首页</a></li>
        <li><a href="#">导航一</a></li>
        <li><a href="#">导航二</a></li>
        <li><a href="#">导航三</a></li>
        <li><a href="#">导航四</a></li>
      </ul>
    </nav>
  </div>
</body>

</html>