<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>注册</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="wrap">
    <div class="main">
      <h2>注册界面</h2>
      <form action="php/doRegister.php" method="post">
        <div>
          <label for="username">用户名：</label>
          <input type="text" id="username" name="username" placeholder="请输入用户名">
        </div>
        <div>
          <label for="password">密码：</label>
          <input type="password" id="password" name="password" placeholder="请输入密码">
        </div>
        <div>
          <label for="password">确认密码：</label>
          <input type="password" id="repassword" name="repassword" placeholder="请输入确认密码">
        </div>
        <div>
          <button type="submit">注册</button>
        </div>
      </form>
      <div>
        <span>已有账号？</span>
        <a href="login.php">登录</a>
      </div>
    </div>
  </div>
</body>

</html>