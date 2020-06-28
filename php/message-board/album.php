<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=相册, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>相册</title>
  <link rel="stylesheet" href="js/dialog/dialog.css">
  <link rel="stylesheet" href="js/swiper/css/swiper.min.css">
  <link rel="stylesheet" href="css/album.css">
  <script src="js/vue.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/dialog/dialog.js"></script>
  <script src="js/swiper/js/swiper.min.js"></script>
</head>

<body>
  <div class="wrap" id="app" v-clock>
    <div class="hd">
      <ul class="nav">
        <li><a href="dairy.php"><b class="dairy"></b>日志</a></li>
        <li class="sel"><a href="#"><b class="album"></b>相册</a></li>
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
        <span class="edit" @click="open">
          <i></i>添加
        </span>
      </div>
      <div class="masonry">
        <div class="item" v-for="(item,index) in list" @click="popImg(index)">
          <div class="item-outer">
            <div class="item-div">
              <img class="lazy" :src="item.url" alt="">
            </div>
            <div class="item-ft">
              <strong>{{item.text}}</strong>
              <span>
                {{item.username}}
              </span>
              <span>
                <i></i>
                {{item.time}}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pop" v-show="pop">
      <div class="pop-main">
        <form action="php/doAlbum.php?act=add" method="post" enctype="multipart/form-data">
          <div>
            <strong>简介：</strong>
            <textarea id="albumTxt" name="albumTxt" id="" cols="30" rows="3"></textarea>
          </div>
          <div>
            <strong>添加图片：</strong>
            <div class="btn">
              <input type="file" name="myFile" class="upload" id="upload" @change="chooseImage" accept="image/gif, image/jpeg, image/png">
              <span class="btn-span"> 图片</span>
              <i>{{imgName}}</i>
            </div>
          </div>
          <div class="ft">
            <input class="add-img" type="button" value="取消" @click="close">
            <input class="add-img" type="submit" value="提交" @click="submit">
          </div>
        </form>
      </div>
    </div>
    <div class="pop-img" v-show="popImgStatus">
      <div class="pop-img-close" @click="popImgClose"></div>
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="(item,index) in list">
            <img :src="item.url" alt="">
            <div class="txt">
              <div>{{item.text}}</div>
              <div>{{item.username}}</div>
              <div>{{item.time}}</div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
        <div class="swiper-button-next swiper-button-white"></div>
      </div>
    </div>
  </div>
  <script>
    new Vue({
      el: "#app",
      data: {
        username: "<?php echo $_SESSION['username'] ?>",
        list: [
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "images/thumb_watermelon.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/0670312851f46ef6eadd992c95edc5ee.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/1643bf9a89a3be47b8699b5d05c6cb93.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/1c70531cad0fc07fde90b8a5f0e90f98.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/3ddfe15e275dd32dadf0e16b92a7a39e.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/40fd529e57f5d640269fdb37a05be6a3.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/43e349b47f9d6a04f6e20cb450e19808.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/499b33f5945302a0bbfe0bb7853d19b7.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/54e1f594ee08e941b89c0627b3c13c7c.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/f741775b3b2c0cf18ecc6a100578e1c1.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/eca6996cfa6b0cb9a07ec5c542d5c65a.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/a0152b3d275ae0c94b6c6abb569e5df2.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/6e53fc8c7008a2271ffb13f5b37f24a4.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/7d0a94966c13bd22b893e759ca74be17.jpg"
          // },
          // {
          //   username: "张三",
          //   text: "这是一段话",
          //   time: "2019-10-21",
          //   url: "uploads/7f51758b28f17f87ca786f2d6842423a.gif"
          // }
        ],
        imgName: '',
        pop: false,
        popImgStatus: false,
      },
      mounted: function() {
        var _this = this;

        $.ajax({
          type: "post",
          url: "php/doAlbum.php?act=query",
          data: {},
          success: function(data) {
            // console.log(JSON.parse(data));
            _this.list = JSON.parse(data);
            // _this.waterFall();
            var img = [];
            var flag = 0;
            var len = _this.list.length;
            for (var i = 0; i < len; i++) {
              img[i] = new Image();
              img[i].src = _this.list[i].url;
              img[i].onload = function() {
                flag++;
                if (flag == len) {
                  _this.waterFall();

                }
              }
            }



          },
          error: function() {

          }
        });






      },
      methods: {
        waterFall: function() {
          // var pageWidth = document.body.clientWidth;
          var pageWidth = $(".masonry").width();
          var columns = 3;
          var itemWidth = parseInt(pageWidth / columns);
          $(".item").css({
            "width": itemWidth + "px",
            "padding": "5px",
            "box-sizing": "border-box"
          });
          var arr = [];
          $(".masonry .item").each(function(i) {
            // var width = $(this).find("img").width();
            // var height = $(this).find("img").height();
            var width = $(this).width();
            var height = $(this).height();
            var bi = itemWidth / width;
            var itemHeight = parseInt(bi * height);
            if (i < columns) {
              $(this).css({
                "top": 0,
                "left": itemWidth * i
              });
              arr.push(itemHeight);

            } else {
              var minHeight = arr[0];
              var index = 0;
              for (var j = 0; j < arr.length; j++) {
                if (minHeight > arr[j]) {
                  minHeight = arr[j];
                  index = j;
                }
              }
              $(this).css({
                "top": arr[index],
                "left": $(".masonry .item").eq(index).css("left")
              });
              arr[index] = arr[index] + itemHeight;
            }

          });
          $(".masonry").height($(document).height() - 64);
        },
        chooseImage: function(e) {
          var el = e.target;
          var val = $(el).val();
          if (val == "") {
            this.imgName = "未选择";
          } else {
            var arr = val.split("\\");
            var len = arr.length;
            this.imgName = arr[len - 1];
          }

        },
        open: function() {
          this.pop = true;
        },
        close: function() {
          this.pop = false;
        },
        submit: function() {
          this.pop = false;
          location.reload();

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
        popImg: function(index) {
          this.popImgStatus = true;
          var swiper = new Swiper('.swiper-container', {
            centeredSlides: true,
            loop: true,
            initialSlide: index,
            pagination: {
              el: ".swiper-pagination",
              type: "fraction"
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            observer: true,
            observeParents: true,
          });

        },
        popImgClose: function() {
          this.popImgStatus = false;
        }
      }
    });
  </script>
</body>

</html>