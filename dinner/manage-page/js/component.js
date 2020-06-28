//导航栏
Vue.component("navbar", {
	props: ["idx"],
	template: `
		<div id="navbar">
			<ul class="clearfix">
				<li v-for="(item,index) in list"
					:key="index"
					:class="[item.cla,{'sel':index==idx}]"
					@click="idx=index"
				>
					<a :href="item.url">
						<span>
							<b v-if="item.status"></b>
						</span>
						<strong>{{item.name}}</strong>
					</a>
				</li>
				
			</ul>
		</div>
	`,
	data: function() {
		return {
			list: [
				{
					name: "门店运营",
					url: "store-operation.html",
					cla: "operation"
				},
				{
					name: "待处理",
					url: "handle.html",
					cla: "handle",
					status: 1
				},
				{
					name: "顾客管理",
					url: "client.html",
					cla: "client"
				},
				{
					name: "订单管理",
					url: "order.html",
					cla: "order"
				},
				{
					name: "门店设置",
					url: "set.html",
					cla: "set"
				}
			]
		}
	},
	mounted: function() {

	}
});
//顾客管理导航栏
Vue.component("navbar-client", {
	props: ["clientidx"],
	template: `
		<div id="navbar_client">
			<ul class="clearfix">
				<li v-for="(item,index) in list"
					:key="index"
					:class="[item.cla,{'sel':index==clientidx}]"
					@click="clientidx=index"
				>
					<a :href="item.url">
						<span></span>
						<strong>{{item.text}}</strong>
					</a>
				</li>
			</ul>
		</div>
	`,
	data: function() {
		return {
			list: [
				{
					text: "顾客管理",
					url: "client.html",
					cla: "manage"
				},
				{
					text: "顾客分析",
					url: "client-analysis.html",
					cla: "analysis"
				}
			]
		}
	}
});
//帮助信息弹窗
Vue.component("pop-help", {
	props: ["popshow","tit","helpcon"],
	template:`
		<div class="pop" v-show="popshow==true">
			<div class="pop-mask"></div>
			<div class="pop-con">
				<div class="pop-con-hd">
					{{tit}}
					<i class="icon-close" v-on:click="closepop"></i>
				</div>
				<div class="pop-con-main">
					{{helpcon}}
				</div>
			</div>
		</div>
	`,
	data: function() {
		return {
			popshow: this.popshow
		}
	},
	methods: {
		closepop: function() {
			this.popshow = false;
			this.$emit("closepop");
		},
	}
})
