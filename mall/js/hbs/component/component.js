
//底部导航栏
Vue.component('navbar', {
	props: ["preurl","icon","idx"],//图片路径前缀
	template: `
		<div class="navbar" >
			
			<ul class="clearfix">
				<li v-for="(item, index) in navbarList" :key="index" :class="[item.cla, {'sel':index==idx}]" @click="idx = index;">
          <a :href="item.url">
            <div class="cir"></div>
						<span></span>
						<strong>{{item.text}}</strong>
					</a>
				</li>
			</ul>
		</div>
	`,
	data: function() {
		return { 
			navbarList: [
				{
					text: "首页",
					url: "index.html",
					cla: "home"
				},
				{
					text: "试试手气 ",
					url: "turntable.html",
					cla: "turntable"
				},
				{
					text: "我的",
					url: "my.html",
					cla: "my"
				}
			]
		}
	}
});


//轮播图
Vue.component('banner', {
	props: ["imglist"],
	template: `
	<div class="banner">
		<div class="swiper-container"> 
		    <div class="swiper-wrapper">
		    	<div class="swiper-slide" 
		    		v-for="(item,index) in imglist"
		    		:key="index" 
		    	>
		    		<a v-if="item.alink==true" @click="imgPop">
		    			<img :data-src="item.imgUrl" class="swiper-lazy">
		    			<div class="swiper-lazy-preloader"></div>	
		    		</a>
		    		<a v-if="item.alink==false" :href="item.url">
		    			<img :data-src="item.imgUrl" class="swiper-lazy">
		    			<div class="swiper-lazy-preloader"></div>
		    		</a>
        		</div>
		    </div>
		    <div class="swiper-pagination"></div>
		</div>
		<div class="pop" v-show="showPop">
		    <div class="error-pop" >
				<div class="error-hd">
					温馨提示
					<span @click="closePop"></span>
				</div>
				<div class="error-main">
					<input class="copy" type="text" v-model="msg" />
					<div class="btn-div">
						<button class="btn-copy" @click="doCopy">复制</button>
						<a :href="url" class="btn-copy">前往兑换</a>
					</div>
				</div>
			</div>
	    </div>
	</div>
	`,
	data:function() {
		return {
			showPop: false,
			msg: "这是一段话",
			url: "#"
		}
	},
	mounted: function() {
		var mySwiper = new Swiper ('.swiper-container', {
		    loop: true, // 循环模式选项
		    autoplay: {
		    	delay: 5000,
		    	stopOnLastSlide: false,
		    	disableOnInteraction: true
		    },
		    lazy: {
		    	loadPrevNext: true
		    },
		    // 如果需要分页器
		    pagination: {
		      	el: '.swiper-pagination',
		      	dynamicBullets: true,
		      	dynamicMainBullets: 1
		    }
		});   
	},
	methods: {
		imgPop: function() {
			this.showPop = true;
		},
		closePop: function() {
			this.showPop = false;
		},
	    doCopy: function () {
	        this.$copyText(this.msg).then(function (e) {
	          	$(document).dialog({
			        type : 'notice',
			        infoText: '复制成功',
			        autoClose: 2500,
			        position: 'center'  // center: 居中; bottom: 底部
			    });
	        }, function (e) {
	          	$(document).dialog({
			        type : 'notice',
			        infoText: '复制失败',
			        autoClose: 2500,
			        position: 'center'  // center: 居中; bottom: 底部
			    });
	        })
      	}
	}
});

//空页面
Vue.component("nullpage",{
	props: ["info"],
	template: `
		<div class="nullPage">
			<div class="nullPage-main">
				<img src="images/hbs/null.png" alt="" />
				<div v-html="info"></div>
				<a href="javascript:history.go(-1)">返回上一页</a>
			</div>
		</div>
	`,

});

// 图片预加载
Vue.component("imgload",{
  props: ["imglist"],
  template:`
    <div class="cover" v-show="coverStatus">
      <span>{{percent}}</span>
    </div>
  `,
  data: function(){
    return {
      percent: 0,
      count: 0,
      coverStatus: true,
      imgLen: '',
      imgs: this.imglist
    }
  },
  watch: {
    count: function (val) {
      if (val === this.imgLen) {
        setTimeout(() => {
          this.coverStatus = false;
        }, 60);
      }
    }
  },
  mounted: function(){
    this.preload();
    this.pushHistory();
  },
  methods: {
    preload: function () {
      var imgs = this.imgs;
      this.imgLen = imgs.length;
      for (var img of imgs) {
        var image = new Image();
        image.src = img;
        image.onload = () => {
          this.count++;
          var percentNum = Math.floor(this.count / this.imgLen * 100);
          this.percent = percentNum + "%";
        }
      }
    },
    pushHistory() {
      window.addEventListener("popstate", function (e) {
        self.location.reload();
      }, false);
      var state = {
        title: "",
        url: "#"
      };
      window.history.replaceState(state, "", "#");
    }
  }
});
