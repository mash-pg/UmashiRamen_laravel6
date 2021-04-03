<template>
	<div class="shop-wrapper">
		<label id="category-title">ラーメンカテゴリー</label>
		<div class="shop-category">
			
			<router-link :to="`/user/category/tonkotu`" >豚骨ラーメン</router-link>
			<router-link :to="`/user/category/shoyu`" >醤油ラーメン</router-link>
			<router-link :to="`/user/category/homekei`" >家系ラーメン</router-link>
			<router-link :to="`/user/category/assari`" >あっさりラーメン</router-link>
			<router-link :to="`/user/category/kotteri`" >こってりラーメン</router-link>
			<router-link :to="`/user/category/origin`" >オリジナルラーメン</router-link>
		</div>
		<div class="search-shop">
			<input type="text" v-model="keyword">
			<input type="submit" @click="created(keyword)" value="検索">
		</div>

		<ul id="paginato" class="pagination">
			<li
				class="inactive"
				:class="(current_page == 1) ? 'disabled' : ''"
				@click="changePage(current_page-1)"
			>«</li>
			<li
				v-for="page in frontPageRange"
				:key="page"
				@click="changePage(page)"
				:class="(isCurrent(page)) ? 'active' : 'inactive'"
			>{{ page }}</li>
			<li v-show="front_dot" class="inactive">...</li>
			<li
				v-for="page in middlePageRange"
				:key="page"
				@click="changePage(page)"
				:class="(isCurrent(page)) ? 'active' : 'inactive'"
			>{{ page }}</li>
			<li v-show="end_dot" class="inactive">...</li>
			<li
				v-for="page in endPageRange"
				:key="page"
				@click="changePage(page)"
				:class="(isCurrent(page)) ? 'active' : 'inactive'"
			>{{ page }}</li>
			<li
				class="inactive"
				:class="(current_page >= last_page) ? 'disabled' : ''"
				@click="changePage(current_page+1)"
			>»</li>
		</ul>
		<h1>お店一覧</h1>
		<table class="table">
			<thead>
				<tr>
					<th>店舗名</th>
					<th>お店情報</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="shop in shops" v-bind:key="shop.id">
					<td>		
					<h3>{{ shop.shop_name }}</h3>
						<div @click="kousin()">
							<router-link  :to="`/user/shops/${shop.id}`">
								<img :src="`/img/main/${shop.img}`">
							</router-link>
						</div>
					</td>
					<td>
						<tr>{{ shop.comments }}</tr>
						<br><br><br><br><br><br><br>
						<div class="btn-flex">
								<div @click="kousin()">
									<router-link class="btn btn-success" :to="`/user/shops/reserve/${shop.id}`">
										予約
									</router-link>
								</div>
								<router-link class="btn btn-info"  :to="`/user/shops/${shop.id}`">
									予約状況または詳細情報
								</router-link>
								<div>
									<router-link class="btn btn-danger" :to="`/user/shops/okini/${shop.id}`">
										お気に入り登録
									</router-link>
								</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
/* eslint-disable no-console */

//更新
export default {
	
		data(){
			return{
				keyword:'',
				
				//ページャー機能
				shops:[],
				current_page: 1,
				last_page: "",
				range: 5,
				front_dot: false,
    			end_dot: false,
				async getUsers() {
					const result = await axios.get(`/api/user/shops?page=${this.current_page}`);
					const shops = result.data;
					this.current_page = shops.current_page;
					this.last_page = shops.last_page;
					this.shops = shops.data;
    			},


				okini : {
					shop_name:'',
					shop_id:''
				},

			}
			
		},
		methods:{
			created(keyword){
			axios.get('/api/user/shops?name='+ keyword)
				.then(response => {
					this.shops = response.data.shops;
				})
				.catch(error => {
				});
			},

			//ページャー機能
			calRange(start, end) {
				const range = [];
				for (let i = start; i <= end; i++) {
					range.push(i);
				}
				return range;
			},
			changePage(page) {
				if (page > 0 && page <= this.last_page) {
					this.current_page = page;
					this.getUsers();
				}
			},
			isCurrent(page) {
  				return page === this.current_page;
			},
			middlePageRange() {
				let start = "";
				let end = "";
				if (this.current_page <= this.range) {
					start = 3;
					end = this.range + 2;
					this.front_dot = false;
					this.end_dot = true;
				} else if (this.current_page > this.last_page - this.range) {
					start = this.last_page - this.range - 1;
					end = this.last_page - 2;
					this.front_dot = true;
					this.end_dot = false;
				} else {
					start = this.current_page - Math.floor(this.range / 2);
					end = this.current_page + Math.floor(this.range / 2);
					this.front_dot = true;
					this.end_dot = true;
				}
				return this.calRange(start, end);
			},
			
			
			//日付更新の為
			kousin(){
				window.location.reload();
			},

  		},
		computed: {
			//ページャー機能
			frontPageRange() {
				return this.calRange(1, 2);
			},
			middlePageRange() {
				let start = "";
				let end = "";
			if (this.current_page <= this.range) {
				start = 3;
				end = this.range + 2;
			} else if (this.current_page > this.last_page - this.range) {
				start = this.last_page - this.range - 1;
				end = this.last_page - 2;
			} else {
				start = this.current_page - Math.floor(this.range / 2);
				end = this.current_page + Math.floor(this.range / 2);
			}
				return this.calRange(start, end);
			},
			endPageRange() {
				return this.calRange(this.last_page - 1, this.last_page);
			}
		},	 
		created() {
			//ページャー機能
			this.getUsers();
		}
		
}
</script>