<template>
<div>
	<div class="shop-detail">
		<div class="shop-detail-title">
			<h1>お店詳細と予約一覧</h1>
		</div>
		<table class="table table-dark">
			<tr><th>予約時間</th><th>予約状況</th></tr>
			<tr v-for="(reserve) in reserves" :key="reserve.id">
				<td>{{reserve.reserve_time}}</td>
				<td>予約済</td>
			</tr>
		</table>
		<div class="shop-detail">
			<div class="shop-detail-1">
				<img :src="`/img/main/${shop.img}`">
			</div>
			<ul class="shop-detail-2">
				<li>ご店舗名: {{ shop.shop_name }}</li>
				<li>メールアドレス: {{ shop.email }}</li>
				<li>電話番号: {{ shop.shop_tel }}</li>
				<li>価格帯: {{ shop.avarage_price }}</li>
				<li>コメント:<br>{{ shop.comments }}</li>
			</ul>
		</div>
		<div class="shop-access">
			<div class="shop-access1">
				<div class="shop-access-title">Google Map</div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.1068282200076!2d135.49375655021993!3d34.70248538033804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e68d95e3a70b%3A0x1baec822e859c84a!2z5aSn6Ziq6aeF!5e0!3m2!1sja!2sjp!4v1616087023253!5m2!1sja!2sjp" width="350" height="350" style="border:0;" allowfullscreen="" loading="lazy">
				</iframe>
			</div>
			<div class="shop-access2">
				アクセス: {{ shop.shop_address }}	
			</div>
		</div>
	</div>
</div>
</template>
<script>
	export default {
		data(){
			return {
				id: this.$route.params.id,
				shop: '',
				reserves:[]
			}
		},
		created(){
			axios.get('/api/user/shops/' + this.id)
			.then(response => {
					this.shop = response.data.shop;
					this.reserves = response.data.reserves;
				})
			.catch(erorr => console.log(error));
		}

	}
</script>