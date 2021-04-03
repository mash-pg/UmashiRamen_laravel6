<template>
<div>
    <div class="row justify-content-center" style="margin-top:4vw;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">予約取消</div>
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
				okinis: {
					okinis_id:'',
					shop_id: '',
					error:''
				},
				reserve:{
					id:'',
					shop_id: ''
				}
			}
		},
		methods:{
		},
		created(){
			const url  = "http://localhost/user/list";
			setTimeout(function(){
				window.location.href = url;
			}, 1000);
			axios.get('/api/user/shops/delete/' + this.id)
			.then
			(
				response => this.reserve = response.data.reserve,
				console.log(this.id)
			)
			.catch(
				erorr => console.log(error),
			);
		}
	}
</script>
