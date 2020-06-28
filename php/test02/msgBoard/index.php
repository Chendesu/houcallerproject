<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    ul,
    li {
      list-style: none;
    }

    html {
      background: #ffe1e7;
    }

    .board,
    form {
      width: 80%;
      margin: 50px auto;
    }

    form textarea {
      display: block;
      width: 100%;
      height: 100px;
      padding: 10px;
      /* border: 1px solid #999; */
      border: 0;
      border-radius: 10px;
      box-shadow: 2px 2px 5px #999;
      box-sizing: border-box;
      outline: none;
    }

    form input {
      float: right;
      padding: 5px 10px;
      margin: 10px 0 0;
      border: 0;
      border-radius: 5px;
      font-size: 14px;
      color: #fff;
      background-color: #999;
      box-shadow: 2px 2px 5px #999;
      cursor: pointer;
    }

    .board ul li {
      padding: 20px;
      border-bottom: 2px dashed #999;
    }

    .board ul li .li-hd {
      height: 26px;
      margin-bottom: 8px;
    }

    .board ul li .li-hd strong {
      float: left;
    }

    .board ul li .li-hd em {
      float: right;
      font-size: 12px;
      color: #aaa;
      font-style: normal;
    }
  </style>
</head>

<body>
  <form method="get" action="<?php $_SERVER["PHP_SELF"] ?>">
    <textarea name="" id="" cols="30" rows="10" name="p"></textarea>
    <input type="submit" value="发表">
  </form>

  <?php
  $txt = $_GET['p'];
  
  $host = "127.0.0.1";
  $username = "root";
  $password = "";
  $db = "db";

  $conn = new mysqli($host, $username, $password, $db);
  mysqli_query($conn, "set names 'utf8'");
  if ($conn->connect_error) {
    die("数据库连接失败");
  }


  // echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
  // echo "<textarea placeholder='请输入...' name='p'></textarea>";
  // echo "<input type='submit' value='发表'>";
  // echo "</form>";

  $sql = "select * from msg";
  $result = $conn->query($sql);

  echo "<div class='board'>";
  echo "<ul>";

  while ($row = mysqli_fetch_array($result)) {
    echo "<li>";
    echo "<div class='li-hd'><strong>" . $row['name'] . "</strong><em>" . $row['time'] . "</em></div>";
    echo "<div class='li-con'>" . $row['msg'] . "</div>";
    echo "</li>";
  }

  echo "</ul>";
  echo "</div>";

  ?>
</body>

</html>