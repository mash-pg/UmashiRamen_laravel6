<template>
<div>
    <div class="row justify-content-center" style="margin-top:4vw;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お気に入り登録</div>
				<form @submit.prevent="createOkini">
					<div class="card-body">
						<input type="hidden" v-model="shop.shop_name">
						<input type="hidden" v-model="shop.shop_id">
						{{shop.shop_id}}
						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary" >
									お気に入り登録する
								</button>
							</div>
						</div>
						<p id="error-link" style="color:red;"> {{okini.error}} </p>
                	</div>
				</form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
/* eslint-disable no-console */
import moment from 'moment'
let now = moment().format('YYYY-MM-DDThh:mm')

	export default {

		data(){
			return {
				id: this.$route.params.id,
				errors: [],
				shop: {
					id:'',
					shop_id: '',
				},
				okini:{
					shop_id:'',
					user_id:'',
					error:''
				}
			}
		},
		methods:{
			createOkini(){
				if(this.shop.shop_name === undefined){
					console.log("start");
					var elm = document.getElementById('error-link');
					console.log(elm);
					elm.innerHTML = "<a href='http://ramenumashi/login'>ログイン</a>をしてからお気に入り登録してください";
					console.log("End");
					this.reserve.error= "ログインをしてからお気に入り登録してください";
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
					error => this.okini.error = "すでにお気に入り登録されています"
				);
			},
		},
		created(){
			axios.get('/api/user/shops/okini/' + this.id)
			.then
			(
				response => this.shop = response.data.shop,
				console.log(this.id)
			)
			.catch(
				erorr => console.log(error),
			);
		}
	}
</script>
