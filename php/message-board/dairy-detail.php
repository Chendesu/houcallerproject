<?php
header('content-type:text/html;charset=utf-8');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="js/dialog/dialog.css">
  <link rel="stylesheet" href="css/dairy-detail.css">
  <script src="js/vue.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/dialog/dialog.js"></script>
</head>

<body>
  <div class="wrap" id="app" v-clock>
    <div class="hd">
      <ul class="nav">
        <li class="sel"><a href="dairy.php"><b class="dairy"></b>日志</a></li>
        <li><a href="album.php"><b class="album"></b>相册</a></li>
        <li><a href="index.php"><b class="msg"></b>留言板</a></li>
      </ul>
      <div class="user">
        <strong>欢迎您：</strong>
        <a href="#">{{username}}</a>
        <a>退出</a>
      </div>
    </div>
    <div class="main">
      <div class="main-hd">
        <span class="edit">
          <i></i>修改
        </span>
      </div>
      <div class="tit">{{dairy.title}}</div>
      <div class="tit-small">
        <span class="user"><b></b>{{dairy.username}}</span>
        <span class="time"><b></b>{{dairy.time}}</span>
        <span class="read"><b></b>{{dairy.read}}</span>
      </div>
      <div class="txt" v-html="dairy.content"></div>
    </div>
  </div>

  <script>
    new Vue({
      el: "#app",
      data: {
        username: "<?php echo $_SESSION['username'] ?>",
        dairy: "",
      },
      mounted: function() {
        var _this = this;
        var url = window.location.href;
        var index = url.lastIndexOf("id");
        var id = url.slice(index + 3);
        // console.log(id);
        $.ajax({
          type: "post",
          url: "php/doDairyDetail.php",
          data: {
            "id": id
          },
          success: function(data) {
            console.log(JSON.parse(data));
            _this.dairy = JSON.parse(data);
          },
          error: function(error) {
            console.log(error);
          }
        });


      },
      methods: {

      }
    });
  </script>
</body>

</html>