<template>
<div>
		<p style="margin-left:10vw; margin-top:2vw;">※<a href="http://localhost/user/login">ログイン</a>してからご利用して下さい。</p>
		<div class="main-home-h1">
			<div class="main-home-h1-1">
				<h1>予約状況</h1>
			</div>
		</div>
		<li v-for="(reserve ) in reserves" :key="reserve.id" >
		<div class="reserve-rank">

			<div>
				<h3 class="reserve-rank-head">{{reserve.shop_name}}</h3>
				<img :src="`/img/main/${reserve.img}`">
			</div>
			<div class="reserve-rank-0">
				<div class="reserve-rank-1">{{ reserve.comments }}
				</div>
				<div class="reserve-rank-1">予約時間：{{ reserve.reserve_time }}
				</div>
				<div class="reserve-rank-3">
					<router-link style="margin-left:2vw;" class="btn btn-danger" :to="`/user/shops/delete/${reserve.id}`">
						予約取消し
					</router-link>
				</div>
			</div>
		</div>
	</li>

	<div class="main-home-h1">
		<div class="main-home-h1-1">
			<h1>お気に入り状況</h1>
		</div>
	</div>
	<!-- <li v-for="shop in shops" v-bind:key="shop.id" > -->
		<li v-for="(okini) in okinis" :key="okini.id" >
		<div class="reserve-rank">

			<div>
				<h3 class="reserve-rank-head">{{okini.shop_name}}</h3>
				<img :src="`/img/main/${okini.img}`">
			</div>
			<div class="reserve-rank-0">
				<div class="reserve-rank-1">{{ okini.comments }}
				</div>
				<div class="reserve-rank-3">
					<router-link style="margin-left:2vw;" class="btn btn-danger" id="reload" :to="`/user/shops/okini/delete/${okini.id}`">
						お気に入り解除
					</router-link>
					<router-link @click="kousin()" class="btn btn-success" :to="`/user/shops/reserve/${okini.id}`">
						予約
					</router-link>
				</div>
			</div>
		</div>
	</li>
</div>

</template>
<script>
/* eslint-disable no-console */
export default {
		data(){
			return{
				keyword:'',
				okinis:[],
				reserves:[]
			}
		},
		created(){
			axios.get('/api/user/list')
			.then(response => {
				this.reserves = response.data.reserves;
				this.okinis = response.data.okinis;
				console.log(this.reserves);
			})
				.catch(error => {
				console.log(error)
			});
		},
		methods:{
			kousin(){
				window.location.reload();
			},
		}

}
</script>
