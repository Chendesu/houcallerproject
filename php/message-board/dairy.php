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
  <title>日志</title>
  <link rel="stylesheet" href="js/dialog/dialog.css">
  <link rel="stylesheet" href="css/dairy.css">
  <script src="js/vue.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/dialog/dialog.js"></script>
  <script src="js/wangEditor/wangEditor.min.js"></script>
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
        <a @click="layout">退出</a>
      </div>
    </div>
    <div class="main">
      <div class="main-hd">
        <span class="edit" @click="addDairy">
          <i></i>添加
        </span>
      </div>
      <ul class="list">
        <li class="clearfix" v-for="item in list">
          <h2 class="li-hd">
            <a :href="'dairy-detail.php?id='+item.id" target="_blank">{{item.title}}</a>
          </h2>
          <div class="txt" :id="item.id" v-html="item.content"></div>
          <a :href="'dairy-detail.php?id='+item.id" target="_blank" class="btn">查看全文</a>
          <div class="ft">
            <span class="time">
              <b></b>{{item.time}}
            </span>
            <span class="user">
              <b></b>{{item.user}}
            </span>
            <span class="read">
              <b></b>{{item.read}}
            </span>
          </div>
        </li>
      </ul>
    </div>
    <div class="pop-edit" v-show="editStatus">
      <div class="pop-edit-main">
        <div class="tit clearfix">
          <label for="">请输入标题：</label>
          <input type="text" id="title" name="title">
        </div>
        <div class="text">
          <label for="">正文:</label>
          <div id="editor"></div>
        </div>
        <div class="btn">
          <span @click="cancelDairy">取消</span>
          <span @click="submitDairy">提交</span>
        </div>
      </div>
    </div>
  </div>
  <script>
    new Vue({
      el: "#app",
      data: {
        username: "<?php echo $_SESSION['username'] ?>",
        list: [],
        editStatus: false,
        E: '',
        editor: '',
      },
      mounted: function() {
        var _this = this;
        this.E = window.wangEditor;
        this.editor = new this.E("#editor");
        this.editor.create();
        $.ajax({
          "type": "post",
          "url": "php/doDairy.php?query=query",
          data: {},
          success: function(data) {
            var data = JSON.parse(data);
            // console.log(data);
            _this.list = data;


          },
          error: function(data) {
            console.log(data);
          }
        });

      },
      methods: {
        addDairy: function() {
          this.editStatus = true;
        },
        submitDairy: function() {
          var title = $("#title").val(); // 标题
          var txt = this.editor.txt.html(); // 正文
          $.ajax({
            type: "post",
            url: "php/doDairy.php?query=insert",
            data: {
              "title": title,
              "content": txt,
            },
            success: function(data) {
              console.log(data);
              alert(data);
            },
            error: function() {

            },
          });
          this.editStatus = false;
          $("#title").val('');
          this.editor.txt.html('');
          window.location.reload();

        },
        cancelDairy: function() {
          this.editStatus = false;
          $("#title").val('');
          this.editor.txt.html('');
        },
        layout: function() {
          $(document).dialog({
            type: 'confirm',
            content: '确定退出登录吗？',
            onClickConfirmBtn: function() {
              location.href = "php/doLogin.php?act=layout";
            }
          })
        },
      }
    });
  </script>
</body>

</html>