(function(){
	mui.init();
	/******左侧菜单侧滑-start******/
	var offCanvasWrapper = mui('#offCanvasWrapper');
	 //移动效果是否为整体移动
	var moveTogether = false;
	//主界面按钮的点击事件
	var offCanvasShow = document.getElementById('offCanvasShow');
	if(offCanvasShow!=null) {
		offCanvasShow.addEventListener('tap', function() {
			offCanvasWrapper.offCanvas('show');
		});
	}
	/******左侧菜单侧滑-end******/
	
	 /******主界面和侧滑菜单界面均支持区域滚动-start******/
	mui('#offCanvasSideScroll').scroll();
	mui('#offCanvasContentScroll').scroll();
	 //实现ios平台原生侧滑关闭页面；
	if (mui.os.plus && mui.os.ios) {
		mui.plusReady(function() { //5+ iOS暂时无法屏蔽popGesture时传递touch事件，故该demo直接屏蔽popGesture功能
			plus.webview.currentWebview().setStyle({
				'popGesture': 'none'
			});
		});
	}

	//轮播图
	mui.init();
	var slider = mui("#slider");
	slider.slider({
		interval: 30000
	});

	//mui下a标签的href失效
	mui('body').on('tap', 'a', function() {
		document.location.href = this.href;
	});

	//滚动区域
	mui('.mui-scroll-wrapper').scroll({
		scrollY: true, //是否竖向滚动
		scrollX: false, //是否横向滚动
		startX: 0, //初始化时滚动至x
		startY: 0, //初始化时滚动至y
		indicators: true, //是否显示滚动条
		deceleration:0.0006, //阻尼系数,系数越小滑动越灵敏
		bounce: false //是否启用回弹
	});

})();
//增加、减少数量功能
;(function($){
	$.fn.cartShopCount = function(option) {
		var defaultSeting = {
			addEl: ".add", //增加
			divEl: ".div", //减少
			numEl: ".num",  //存放数字的标签
			isShow: "hidden",//当值小于1的时候，是否显示弹窗
			remove: "false", //当值小于0的时候，是否移除该条信息
			removeEl: "", //被移除的元素
			removeElP: "" //被移除的元素的父级
		};
		var setting = $.extend(defaultSeting,option);
		
		var _this = this;
		var count = _this.find(setting.numEl).text();
		if(count <= 0) {
			_this.find(setting.divEl).css("visibility","hidden");
			_this.find(setting.numEl).css("visibility","hidden");
		}
		//增加
		_this.find(setting.addEl).on("tap",function(){
			count = _this.find(setting.numEl).text();
			_this.find(setting.divEl).css("visibility","visible");
			_this.find(setting.numEl).css("visibility","visible");
			count++;
			_this.find(setting.numEl).text(count);
		});
		//减少
		_this.find(setting.divEl).on("tap",function(){
			count = _this.find(setting.numEl).text();
			count--;
			if(count < 1) {
				//弹窗
				if(setting.isShow == "show") {
					count = 1;
					var btnArray = ['取消', '删除'];
					mui.confirm('是否删除该菜品', '友情提示', btnArray, function(e) {
						if(e.index == 1) {
							count = 0;
							_this.find(setting.divEl).css("visibility","hidden");
							_this.find(setting.numEl).css("visibility","hidden");
							_this.find(setting.numEl).text(count);
							if(setting.remove == "true") {
								$(setting.removeEl).remove();
							}
						} else {
							count = 1;
							_this.find(setting.divEl).css("visibility","visible");
							_this.find(setting.numEl).css("visibility","visible");
							_this.find(setting.numEl).text(count);
						}
					});
					
				} else {
					count = 0;
					// console.log(1);
					_this.find(setting.divEl).css("visibility","hidden");
					_this.find(setting.numEl).css("visibility","hidden");
					_this.find(setting.numEl).text(count);
					if(setting.remove == "true") {
						$(setting.removeEl).remove();
						// console.log(2);
					}
				}
			}
			
			_this.find(setting.numEl).text(count);

		});
		
		return this;
	}
}(jQuery));




