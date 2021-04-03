<template>
<div>
    <div class="row justify-content-center" style="margin-top:4vw;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お気に入り解除</div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
/* eslint-disable no-console */
	export default {

		data(){
			return {
				id: this.$route.params.id,
				errors: [],
				okini: {
					id:'',
					shop_id: '',
					error:''
				}
			}
		},
		methods:{
			session(){

			}
		},
		created(){
			const url  = "http://localhost/user/list";
			setTimeout(function(){
				window.location.href = url;
			}, 1000);

			axios.get('/api/user/shops/okini/delete/' + this.id)
			.then
			(
				response => this.okini = response.data.okini,
				console.log(this.id)
			)
			.catch(
				erorr => console.log(error),
			);

		}
	}
</script>
