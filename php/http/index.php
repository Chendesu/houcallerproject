<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>留言板</title>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    html {
      background: #efefef;
    }
    .wrap {
      width: 600px;
      margin: 0 auto;
    }
    .wrap form {
      display: block;
      width: 600px;
      /* height: 300px; */
      padding: 30px 0;
      margin: 0 auto;
    }

    .wrap form div {
      margin-bottom: 20px;
      display: flex;
      flex: 1 1 auto;
      align-items: center;
    }

    .wrap form div label {
      -webkit-flex: 0 1 auto;
      -ms-flex: 0 1 auto;
      flex: 0 1 auto;
      width: 70px;
      height: 26px;
    }

    .wrap form div input,
    .wrap form div textarea {
      -webkit-flex: 1 0 auto;
      -ms-flex: 1 0 auto;
      flex: 1 0 auto;
      padding: 5px;
    }

    .wrap form div input {
      height: 30px;
    }
    .wrap form div button {
      align-items: right;
    }
  </style>
</head>

<body>
  <?php
// echo phpinfo();
  $host = "127.0.0.1";
  $username = "root";
  $password = "";
  $db = "db";

  $conn = new mysqli($host, $username, $password, $db);
  mysqli_query($conn, "set names 'utf8'");
  if ($conn->connect_error) {
    // die("数据库连接失败");
    echo "<script>alert('数据库连接失败')</script>";
    exit;
  }

  if(isset($_POST["publish"])) {
    $title = htmlspecialchars(trim($_POST["title"]));
    $content = htmlspecialchars(trim($_POST["content"]));
    if(!empty($title)&&!empty($content)){
      $insert_sql = "insert into board (title, content) values('$title','$content')";
      $res = $conn->query($insert_sql);
      if($res){
        echo "<script>alert('发布成功');</script>";
      } else {
        echo "<script>alert('发布失败');</script>";
      }
    }
  }

  

  ?>
  <div class="wrap">
    <form action="" method="post">
      <div>
        <label for="">主题：</label>
        <input type="text" name="title">
      </div>
      <div>
        <label for="">内容：</label>
        <textarea name="content" id="" cols="30" rows="10"></textarea>
      </div>
      <div>
        <label for=""></label>
        <input type="submit" name="publish" value="发布">
      </div>
    </form>

    <?php

    $sql = "select * from board";
    $res1 = $conn->query($sql);
    echo "<ul>";
    while ($row = mysqli_fetch_array($res1)) {
      echo "<li>";
      echo $row["id"]."、".$row["title"]."<br>";
      echo $row["content"];
      echo "</li>";
    }
    echo "</ul>";
    
    ?>

  </div>
</body>

</html>