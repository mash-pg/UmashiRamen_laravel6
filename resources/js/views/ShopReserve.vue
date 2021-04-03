<template>
<div>
    <div class="row justify-content-center" style="margin-top:4vw;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">予約</div>
				<form @submit.prevent="createUser">
					<div class="card-body">
						<input type="hidden" v-model="shop.shop_name">
						<input type="hidden" v-model="shop.shop_id">
						<div class="form-group row">
							<label for="number" class="col-md-4 col-form-label text-md-left">人数</label>

							<div class="col-md-3">
								<input type="number" min="1" class="form-control"  v-model="reserve.number">
							</div>
						</div>

						<div class="form-group row">
							<label for="datetime" id="cal" class="col-md-4 col-form-label text-md-left">予約時間</label>
							<div class="col-md-6">
								<input type="datetime-local" class="form-control"  v-model="reserve.datetime">
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary" >
									予約
								</button>
							</div>
						</div>
						<p id="error-link" style="color:red;"> {{reserve.error}} </p>
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
//kkは24時形式
let now = moment().format('YYYY-MM-DDTkk:mm')

	export default {

		data(){
			return {
				id: this.$route.params.id,
				errors: [],
				shop: {
					id:'',
					shop_id: '',
				},
				reserve:{
					number:'',
					datetime:now,
					user_id:'',
					error:''
				}
			}
		},
		methods:{
			createUser(){
					//空白チェック
					if(this.reserve.number === ""){
						this.reserve.error = "人数が空白です";
						return false;
					}
					//日付チェック
					this.reserve.error = "";
					let str = this.reserve.datetime;
					let str1 = now;
					str = str.replace(/T/,' ');
					str1 = str1.replace(/T/,' ');
					let a = moment(str);
					let b = moment(str1);
					//入力した日付より現在時刻がちいさい場合　エラー
					const flag = b.isAfter(a);
					console.log(this.shop.shop_name);
					console.log("test : " + this.shop.seat);

					console.log(this.reserve.reserve_time);
					if(this.shop.shop_name === undefined){
						console.log("start");
						var elm = document.getElementById('error-link');
						console.log(elm);
						elm.innerHTML = "<a href='http://localhost/login'>ログイン</a>をしてから予約してください";
						console.log("End");
						this.reserve.error= "ログインをしてから予約してください";
					}
					try{
						if(flag){
							throw new Error('終了します。');
						}
					}catch (e){
						this.reserve.error = "過去の日付が入力されています。";
						return false;
					}
				axios.post('/api/user/shops/reserve/',{
					reserve: this.reserve,
					shop: this.shop,
				})
				.then(response => {
					this.reserve = response.data.reserve;
					//下記ULRはrouter.jsのnameに飛ばす
					this.$router.push({ name: 'list'})
				})
				.catch(
					error => this.reserve.error = "この日時は予約が被っている為予約できません。"
				);
			},
		},
		created(){
			// console.log("test");
			axios.get('/api/user/shops/reserve/' + this.id)
			.then
			(
				response => this.shop = response.data.shop,
			)
			.catch(
				erorr => console.log(error),
			);
		}
	}
</script>
