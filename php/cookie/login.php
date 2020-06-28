<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>登录</title>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    html,
    body,
    .wrap {
      width: 100%;
      height: 100%;
      background-color: #efefef;
    }

    .main {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 400px;
      padding: 20px;
      border-radius: 5px;
      background: #fff;
      box-shadow: 0 0 10px #aaa;
      transform: translate(-50%, -50%);
    }

    .main h2 {
      padding: 0 0 20px;
      font-size: 20px;
      color: #575757;
      text-align: center;
    }

    .main form div {
      margin-bottom: 20px;
      font-size: 14px;
      color: #666;
    }

    .main form div label {
      display: inline-block;
      width: 100px;

    }

    .main form div input {
      display: inline-block;
      width: 180px;
      height: 25px;
      padding: 0 10px;
      border: 1px solid #aaa;
      box-sizing: border-box;
    }

    .main form div button {
      display: block;
      width: 180px;
      height: 30px;
      margin-left: 100px;
      border: 1px solid #aaa;
      /* border-radius: 10px; */
      background: #efefef;
    }

    .main form div em {
      font-size: 12px;
      color: #f00;
      font-style: normal;
    }

    .main form div.auto {
      display: flex;
      justify-content: left;
      align-items: center;
    }

    .main form div.auto input {
      width: auto;
      height: auto;
      margin-left: 100px;
      margin-right: 10px;
    }
  </style>
</head>

<body>
  <div class="wrap">
    <div class="main">
      <h2>登录界面</h2>
      <form action="doLogin.php" method="post">
        <div>
          <label for="username">用户名：</label>
          <input type="text" id="username" name="username" placeholder="请输入用户名">
        </div>
        <div>
          <label for="password">密码：</label>
          <input type="password" id="password" name="password" placeholder="请输入密码">
        </div>
        <div class="auto">
          <input type="checkbox" name="autologin" id="autologin" value="1">
          <label for="autologin">记住密码</label>
        </div>
        <div>
          <button type="submit">立即登录</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>