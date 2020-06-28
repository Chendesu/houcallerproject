<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>登录</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="wrap">
    <div class="main">
      <h2>登录界面</h2>
      <form action="php/doLogin.php" method="post">
        <div>
          <label for="username">用户名：</label>
          <input type="text" id="username" name="username" placeholder="请输入用户名">
        </div>
        <div>
          <label for="password">密码：</label>
          <input type="password" id="password" name="password" placeholder="请输入密码">
        </div>
        <!-- <div>
          <label for="verify">验证码</label>
          <input type="text" name="verify" id="verify" placeholder="请输入验证码">
          <img src="./code.php" alt="" />
        </div> -->
        <div>
          <button type="submit">登录</button>
        </div>
      </form>
      <div>
        <span>还没有账号？</span>
        <a href="register.php">注册</a>
      </div>
    </div>
  </div>

</body>

</html>