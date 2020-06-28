/* 
 *  雪花飘落特效
 *  调用： createSnow('', 60, 6000);
 *  此函数接受2个参数：
 *  第一个：雪花图片目录的路径；
 *  第二个：雪花的最大数量，请不要将此数字设置为60以上，因为它会影响性能
 *  第三个：若有填写值，则几毫秒之后不再创建图片，值必须大于3000；若无值，则默认雪花一直飘落
 */
(function() {
	var m ;
	function k(a, b, c) {
		if (a.addEventListener) {
			a.addEventListener(b, c, false);
		} else {
			a.attachEvent && a.attachEvent("on" + b, c);
		} 
	}
	function g(a) {
		if (typeof window.onload != "function") {
			window.onload = a;
		} else {
			var b = window.onload;
			window.onload = function() {
				b();
				a()
			}
		}
	}
	function h() {
		var a = {};
		for (type in {Top: "",Left: ""}) {
			var b = type == "Top" ? "Y" : "X";
			if (typeof window["page" + b + "Offset"] != "undefined") {
				a[type.toLowerCase()] = window["page" + b + "Offset"];
			} else {
				b = document.documentElement.clientHeight ? document.documentElement : document.body;
				a[type.toLowerCase()] = b["scroll" + type]
			}
		}
		return a;
	}
	function l() {
		var a = document.body;
		var b;
		if (window.innerHeight) {
			b = window.innerHeight;
		} else if (a.parentElement.clientHeight) {
			b = a.parentElement.clientHeight;
		} else if (a && a.clientHeight) {
			b = a.clientHeight;
		} 
		return b
	}
	function i(a) {
		this.parent = document.body;
		this.createEl(this.parent, a);
		this.size = Math.random() * 80 + 60;
		this.el.style.width = Math.round(this.size)/75 + "rem";
		// this.el.style.height = Math.round(this.size)/75 + "rem";
		this.maxLeft = document.body.offsetWidth - this.size;
		this.maxTop = document.body.offsetHeight - this.size;
		this.left = Math.random() * this.maxLeft;
		this.top = h().top + 1;
		this.angle = 1.4 + 0.2 * Math.random();
		this.minAngle = 1.4;
		this.maxAngle = 1.6;
		this.angleDelta = 0.01 * Math.random();
		// this.speed = 2 + Math.random();
		var dpr = document.getElementsByTagName("html")[0].getAttribute("data-dpr");
		if(dpr=="2") {
			this.speed = 8 + Math.random();
		} else if(dpr=="3") {
			this.speed = 12 + Math.random();
		} else {
			this.speed = 3 + Math.random();
		}
		
	}
	var j = false;
	g(function() {
		j = true
	});
	var f = true;
	window.createSnow = function(a, b, t) {
		console.log(j);
		if (j) {
			var c = [];
			var m = setInterval(function() {
				f && b > c.length && Math.random() < b * 0.0025 && c.push(new i(a));
				!f && !c.length && clearInterval(m);
				for (var e = h().top, n = l(), d = c.length - 1; d >= 0; d--) {
					if (c[d]) {
						if (c[d].top < e || c[d].top + c[d].size + 1 > e + n) {
							c[d].remove();
							c[d] = null;
							c.splice(d, 1);
						} else {
							c[d].move();
							c[d].draw();
						}
					}
				}
			}, 40);
			k(window, "scroll", function() {
				for (var e = c.length - 1; e >= 0; e--) {
					c[e].draw();
				}
			});
			if(t>3000||t!='0'||t!=null||t!=undefined) {

				setTimeout(function () {
					clearInterval(m);
					setInterval(function(){
						for (var e = h().top, n = l(), d = c.length - 1; d >= 0; d--) {
							if (c[d]) {
								if (c[d].top < e || c[d].top + c[d].size + 1 > e + n) {
									c[d].remove();
									c[d] = null;
									c.splice(d, 1);
								} else {
									c[d].move();
									c[d].draw();
								}
							}
						}
					},40)
					return;
				}, t);
			}
		} else {
			g(function () {
				createSnow(a, b, t)
			});
		} 
	};
	window.removeSnow = function() {
		f = false;
	};
	i.prototype = {
		createEl: function(a, b) {
			this.el = document.createElement("img");
			this.el.setAttribute("src", b + "sakura" + Math.floor(Math.random() * 3) + ".png");
			// this.el.setAttribute("src", b + "images/hbs/wow" + Math.floor(Math.random() * 4) + ".png");
			// this.el.setAttribute("src", b + "red.jpg");
			this.el.style.position = "absolute";
			this.el.style.display = "block";
			this.el.style.zIndex = "99999";
			this.parent.appendChild(this.el);
		},
		move: function() {
			if (this.angle < this.minAngle || this.angle > this.maxAngle) {
				this.angleDelta = -this.angleDelta;
			} 
			this.angle += this.angleDelta;
			this.left += this.speed * Math.cos(this.angle * Math.PI);
			this.top -= this.speed * Math.sin(this.angle * Math.PI);
			if (this.left < 0) {
				this.left = this.maxLeft;
			} else if (this.left > this.maxLeft) {
				this.left = 0;
			}
		},
		draw: function() {
			this.el.style.top = Math.round(this.top) + "px";
			this.el.style.left = Math.round(this.left) + "px"
		},
		remove: function() {
			this.parent.removeChild(this.el);
			this.parent = this.el = null
		}
	}
})();