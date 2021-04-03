<template>
<div>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/hooper@0.2.1/dist/hooper.css"> -->

	<div class="main-home-h1">
		<div class="main-home-h1-1">
			<h1>予約ランキング</h1>
		</div>
	</div>
	<!-- <li v-for="shop in shops" v-bind:key="shop.id" > -->
		<li v-for="(shop , index) in shops" :key="shop.id" >
		<div class="reserve-ranking">{{index + 1}} 位</div>
		<div class="reserve-rank">

			<div>
				<h3 class="reserve-rank-head">{{shop.shop_name}}</h3>
				<img :src="`/img/main/${shop.img}`">
			</div>
			<div class="reserve-rank-0">
				<div class="reserve-rank-1">{{ shop.comments }}
				</div>
				<div class="reserve-rank-2">予約数：{{ shop.reserve_count }}</div>
				<div class="reserve-rank-3">
					<div class="btn btn-success" @click="kousin()">
					<router-link  :to="`/user/shops/reserve/${shop.id}`">
						予約
					</router-link>
					</div>
					<router-link style="margin-left:2vw;" class="btn btn-danger" id="reload" :to="`/user/shops/okini/${shop.id}`">
						お気に入り
					</router-link>
				</div>
			</div>
		</div>
	</li>

	<div class="main-home-h1">
		<div class="main-home-h1-1">
			<h1>お気に入りランキング</h1>
		</div>
	</div>
	<!-- <li v-for="shop in shops" v-bind:key="shop.id" > -->
		<li v-for="(okini , index) in okinis" :key="okini.id" >
		<div class="reserve-ranking">{{index + 1}} 位</div>
		<div class="reserve-rank">

			<div>
				<h3 class="reserve-rank-head">{{okini.shop_name}}</h3>
				<img :src="`/img/main/${okini.img}`">
			</div>
			<div class="reserve-rank-0">
				<div class="reserve-rank-1">{{ okini.comments }}
				</div>
				<div class="reserve-rank-2">お気に入り数：{{ okini.okini_count }}</div>
				<div class="reserve-rank-3">
					<div class="btn btn-success" @click="kousin()">
					<router-link  :to="`/user/shops/reserve/${okini.id}`">
						予約
					</router-link>
					</div>
					<router-link style="margin-left:2vw;" class="btn btn-danger" id="reload" :to="`/user/shops/okini/${okini.id}`">
						お気に入り
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
				shops:[],
				okinis:[]
			}
		},
		created(){
			axios.get('/api/user/ranking')
			.then(response => {
				this.shops = response.data.shops;
				this.okinis = response.data.okinis;
				console.log(this.shops);
			})
				.catch(error => {
				console.log(error)
			});
		},
		methods:{
			createOkini(){
				if(this.shop.shop_name === undefined){
					console.log("start");
					var elm = document.getElementById('error-link');
					console.log(elm);
					elm.innerHTML = "<a href='http://localhost/user/login'>ログイン</a>をしてから予約してください";
					console.log("End");
					this.reserve.error= "ログインをしてから予約してください";
				}
				axios.post('/api/user/shops/okini/',{
					okini: this.okini,
					shop: this.shop,
				})
				.then(response => {
					this.okini = response.data.okini;
					//下記ULRはrouter.jsのnameに飛ばす
					this.$router.push({ name: 'list'})
				})
				.catch(
					error => console.log(error)
				);
			},
			kousin(){
				window.location.reload();
			}

		}
}
</script>
