mui.ready(function(){
	$(".order-tab span").on("tap",function(){
		var index = $(this).index();
		$(this).addClass("sel").siblings().removeClass("sel");
		$(".con .con-list").eq(index).addClass("show").siblings().removeClass("show");
		if(index == 1 || index == 2) {
			$(".footer").css("display","none");
		} else {
			$(".footer").css("display","block");
		}
	});

	$(".order-list-nav span").on("tap",function(){
		$(this).addClass("order-sel").siblings().removeClass("order-sel");
		var val = $(this).text();
		$(".order-list-main-tit").text(val);
	});

	var w1 = $("#offCanvasContentScroll").height();
	var b = $(".banner").height();
	var s = $(".store").height();
	var o = $(".order-tab").height();
	var f = $(".footer").height();
  // 	var h = $(".order-list-main-tit").height();
  	var m = $("#prmtInfo").height();
	// var l = w1-o-f-h;
	// console.log(l);
	// $(".order-list-main").find(".mui-scroll-wrapper").css({
	// 	"top": "1.07rem",
	// 	"height": l + "px"
	// });
	// $(".order-list").css({
	// 	"height": w1-o-f-m +"px"
	// });
	// $(".order-list .order-list-nav").css({
	// 	"height": w1-o-f-m +"px"
  // });
  $('.con').css({
    height: w1 - o - f - m + 'px'
  });
  var scroll = mui('#offCanvasContentScroll').scroll();
  document.querySelector('#offCanvasContentScroll').addEventListener('scroll', function (e) {
    console.log(scroll.y);
    if (scroll.y<=-(b+s)){
      $('.order-tab').addClass('order-tab-fixed');
      $('.con').addClass('con-fixed');
      
    } else {
      $('.order-tab').removeClass('order-tab-fixed');
      $('.con').removeClass('con-fixed');
      
    }
  });

	$(".order-list-pro").find("dl").each(function(){
		$(this).find(".pro-count").cartShopCount({
			addEl: ".pro-count-add",
			divEl: ".pro-count-minus",
			numEl: ".pro-count-num"
		});
	});
	$(".order-list-pro").find("dl").each(function(){
		$(this).find(".pro-btn").on("tap",function(){
			$(".popup").fadeIn(200);
		})
	});
	$(".popup .popup-close").on("tap",function(){
		$(".popup").fadeOut(200);
	});
	$(".popup .popup-shoppingcart").on("tap",function(){
		$(this).css("display","none");
		$(this).parent().find(".pro-count").css("display","block");
	});
	$(".popup .pro-count").cartShopCount({
		addEl: ".pro-count-add",
		divEl: ".pro-count-minus",
		numEl: ".pro-count-num"
	});
	$(".popup .pro-count").find(".pro-count-minus").on("tap",function(){
		var num = $(this).parent().find(".pro-count-num").text();
		if(num <= 0) {
			$(".popup .popup-shoppingcart").css("display","block");
			$(".popup .pro-count").css("display","none")
		}
	});
	$(".popup-con span").on("tap",function(){
		$(this).addClass("sel").siblings().removeClass("sel");
	});
	//打开购物车
	//若当前的购物车不为空，打开购物车
	if(!$(".wrap").find(".footer").hasClass("noSel")) {
		$(".openCart").on("tap",function(){
			$(".wrap .footer .menu-cart").fadeIn(100);
			function test() {
				$(".wrap .footer .menu-cart .menu-list").css({"height": "auto"});
			}
			setTimeout(test(),1000);
		});
	} else {
		//禁止打开购物车事件
		$(".openCart").css("pointer-events", "none");
	}
	//关闭打开购物车
	$(".menu-cart").find(".menu-cart-mask").on("tap",function(){
		$(".wrap .footer .menu-cart").fadeOut(100);
		$(".wrap .footer .menu-cart .menu-list").css({"height": "0"});
	});
	//购物车菜单增加/减少数量
	$(".wrap .footer .menu-cart .menu-list ul li").each(function(){
		var _this = $(this);
		$(this).find(".pro-count").cartShopCount({
			addEl: ".pro-count-add",
			divEl: ".pro-count-minus",
			numEl: ".pro-count-num",
			isShow: "show",
			remove: "true",
			removeEl: _this,
			removeElP: _this.parent()
		});
	});

	//评价
	$(".con-evaluate .con-evaluate-main .con-evaluate-tb span").on("tap",function(){
		$(this).addClass("tb-sel").siblings().removeClass("tb-sel");
	});
	$(".con-evaluate .con-evaluate-main .con-evaluate-list .con-evaluate-classify span").on("tap",function(){
		$(this).addClass("sel-classify").siblings().removeClass("sel-classify");
	});
	//店铺图片左右滑动
	mui('.con-store .con-store-img .mui-scroll-wrapper').scroll({
		scrollY: false, //是否竖向滚动
		scrollX: true, //是否横向滚动
		startX: 0, //初始化时滚动至x
		startY: 0, //初始化时滚动至y
		indicators: true, //是否显示滚动条
		deceleration:0.0006, //阻尼系数,系数越小滑动越灵敏
		bounce: true //是否启用回弹
	});

	// 打开产品详情弹窗
	$(".order-list-pro dl .pro-info .pro-tit").on("tap",function(){
		$(".popup-pro").fadeIn(200);
	});
	$(".order-list-pro dl .pro-img").on("tap",function(){
		$(".popup-pro").fadeIn(200);
	});
	$(".popup-pro .pop-pro-close").on("tap",function(){
		$(".popup-pro").fadeOut(200);
	});


});

