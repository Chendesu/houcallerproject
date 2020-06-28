(function(){
	//选择配送方式
	$(".wrap .con .tab-order-style div").on("tap",function(){
		var index = $(this).index();
		$(this).addClass("sel").siblings().removeClass("sel");
		$(".wrap .con .con-order-style .order-style").eq(index).addClass("show").siblings().removeClass("show");
	});
	//控制备注显示
	$(".wrap .con .order-list .remarks .mui-switch").on("tap",function(){
		var isClass = $(this).hasClass("mui-active");
		if(isClass) {
			$(this).parent().css("height","auto");
		} else {
			$(this).parent().css("height","1rem");
		}
	});
	//打开选择时间的弹窗
	$(".wrap .con .order-style").on("tap",function(){
		$(".poptime").fadeIn(200);
		$("body").css("overflow","hidden");
	});
	$(".poptime .poptime-mask").on("tap",function(){
		$(".poptime").fadeOut(200);
		$("body").css("overflow","auto");
	});

	$(".time-left div").on("tap",function(){
		var index = $(this).index();
		$(this).addClass("sel").siblings().removeClass("sel");
		$(".time-main .time-main-div").eq(index).addClass("show").siblings().removeClass("show");
	})
	$(".time-main-div span").on("tap",function(){
		$(this).addClass("choose").siblings().removeClass("choose");
	})



	//选择优惠券
	$(".popcoupon .popcoupon-con ul li").on("tap",function(){
		var isSel = $(this).hasClass("sel");
		if(isSel) {
			$(this).removeClass("sel");
		} else {
			$(this).addClass("sel");
		}
	});

	//打开优惠券
	$(".wrap .con .order-list .coupon").on("tap",function(){
		$(".popcoupon").fadeIn(200);
		$("body").css("overflow","hidden");
	});
	$(".popcoupon .popcoupon-mask").on("tap",function(){
		$(".popcoupon").fadeOut(200);
		$("body").css("overflow","auto");
	});


	//打开发票
	var ele = document.getElementById("mySwitch");
	ele.addEventListener("toggle",function(event){
	  if(event.detail.isActive){
	    $(this).parent().css("height","auto");
	  }else{
	    $(this).parent().css("height","1rem");
	  }
	})
	

})();
