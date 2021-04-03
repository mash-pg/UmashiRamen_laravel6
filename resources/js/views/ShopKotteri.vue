<template>
<div>
<h1>
	
	<div class="main-home-h1">
		<div class="main-home-h1-1">
			<h1>こってり一覧</h1>
		</div>
	</div>
	<!-- <li v-for="shop in shops" v-bind:key="shop.id" > -->
		<li v-for="(shop ) in shops" :key="shop.id" >
		<div class="reserve-rank">
			<div><img :src="`/img/main/${shop.img}`"></div>
			<div class="reserve-rank-1">{{ shop.category_type }}
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
			axios.get('/api/user/category/tonkotu?category=kotteri')
			.then(response => {
				this.shops = response.data.shops;
			})
				.catch(error => {
				console.log(error)
			});
		} 

	}
</script>