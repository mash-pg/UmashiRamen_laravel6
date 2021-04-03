<template>
<div>
<h1>
	
	<div class="main-home-h1">
		<div class="main-home-h1-1">
			<h1>豚骨ラーメン一覧</h1>
		</div>
	</div>
	<!-- <li v-for="shop in shops" v-bind:key="shop.id" > -->
		<li v-for="(shop , index) in shops" :key="shop.id" >
		<div class="reserve-ranking">{{index + 1}} 位</div>
		<div class="reserve-rank">
			<div><img :src="`/img/main/${shop.img}`"></div>
			<div class="reserve-rank-1">
				{{ shop.comments }}
				<p style="font-size:2vw;">カテゴリー：{{ shop.category_type }}</p>
				<td><span class="btn btn-success" @click="shopReserve(index, shop.id)">予約</span></td>
				<td><span style="margin-left:1vw;" class="btn btn-success" @click="shopReserve(index, shop.id)">お気に入り登録</span></td>
			</div>
		</div>
	</li>
</h1>
</div>
</template>
<script>
/* eslint-disable no-console */
	export default {
		data(){
			return{
				shops:[],
			}
		},
		created(){
			axios.get('/api/user/category/tonkotu?category=tonkotu')
			.then(response => {
				this.shops = response.data.shops;
			})
				.catch(error => {
				console.log(error)
			});
		} 

	}
</script>