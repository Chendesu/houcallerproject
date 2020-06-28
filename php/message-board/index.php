<?php
header('content-type:text/html;charset=utf-8');
session_start();

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != 1 || !isset($_SESSION['username'])) {
  exit("<script>
        alert('请先登录');
        location.href='login.php';
      </script>");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>留言</title>
  <link rel="stylesheet" href="js/dialog/dialog.css">
  <link rel="stylesheet" href="css/index.css">
  <script src="js/vue.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/dialog/dialog.js"></script>
</head>

<body>
  <div class="wrap" id="app" v-clock>
    <div class="hd">
      <ul class="nav">
        <li><a href="dairy.php"><b class="dairy"></b>日志</a></li>
        <li><a href="album.php"><b class="album"></b>相册</a></li>
        <li class="sel"><a href=""><b class="msg"></b>留言板</a></li>
      </ul>
      <div class="user">
        <strong>欢迎您：</strong>
        <a href="#">{{username}}</a>
        <a @click="layout">退出</a>
      </div>
    </div>
    <div class="main">
      <form action="php/doIndex.php" method="post" class="clearfix" enctype="multipart/form-data">
        <div>
          <textarea id="" cols="30" rows="10" name="content"></textarea>
        </div>
        <div>
          <strong class="pic-btn">
            <input type="file" name="myFile" id="upload" @change="chooseImage" accept="image/gif, image/jpeg, image/png">
            <span> 图片</span>
            <i v-show="choose==true">{{fileName}}</i>
          </strong>
          <input type="submit" value="发表">
        </div>
      </form>
      <div class="msg" v-for="(item,index) in list">
        <div class="msg-user">
          <strong>{{item.username}}</strong>
          <span v-if="item.username==username">
            <!-- <i>编辑</i> -->
            <i @click="delectMsg(index)">删除</i>
          </span>
        </div>
        <div class="msg-time">{{item.time}}</div>
        <div class="msg-txt">
          {{item.text}}
        </div>
        <div class="msg-img" v-if="item.image!=''">
          <ul class="clearfix">
            <li>
              <div class="msg-img-con">
                <img :src="item.image" alt="">
              </div>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
  <script>
    new Vue({
      el: "#app",
      data: {
        content: '',
        choose: false,
        fileName: '未选择',
        formData: {},
        imgData: '',
        list: [],
        username: "<?php echo $_SESSION['username'] ?>",
      },
      mounted: function() {

        var _this = this;
        $.ajax({
          type: 'post',
          url: 'php/queryIndex.php',
          data: {},
          success: function(res) {
            _this.list = JSON.parse(res);
            // console.log(_this.list);
          },
          error: function(res) {

          }
        });

      },
      methods: {
        chooseImage: function(e) {
          this.choose = true;
          var _this = this;
          var el = e.target;
          var str = $(el).val();

          var reader = new FileReader();
          reader.readAsDataURL(el.files[0]);
          reader.onload = function(evt) {
            // console.log(evt.target.result);
            _this.imgData = evt.target.result;
          }

          if ($(el).val() == '') {
            _this.fileName = '未选择';
          } else {
            var arr = str.split('\\');
            var len = arr.length;
            _this.fileName = arr[len - 1];
          }
        },
        layout: function() {
          $(document).dialog({
            type: 'confirm',
            content: '确定退出登录吗？',
            onClickConfirmBtn: function() {
              location.href = 'php/doLogin.php?act=layout';
            }
          })
        },
        delectMsg: function(index) {
          var id = this.list[index].id;
          $(document).dialog({
            type: 'confirm',
            content: "确认删除图片？",
            onClickConfirmBtn: function() {
              $.ajax({
                type: 'POST',
                url: 'php/delIndex.php',
                data: {
                  'id': id
                },
                success: function(res) {
                  var status = JSON.parse(res);
                  $(document).dialog({
                    titleShow: false,
                    content: status.status,
                    onClickConfirmBtn: function() {
                      location.reload();
                    }
                  });

                },
                error: function() {

                },
              });

            },
          });


        }
      },
    });
  </script>
</body>

</html>