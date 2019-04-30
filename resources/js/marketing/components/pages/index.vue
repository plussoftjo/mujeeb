<template>
	<div class="index">
		<v-container>
			<div class="font-weight-black" style="text-align: right;">
				{{user.name}}
			</div>	
		</v-container>
		
		<v-container>
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header">
							<div class="title">
								تسجيلات اليوم
							</div>
							<div class="title">
								0 
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header">
							<div class="title">
								الجميع
							</div>
							<div class="title">
								0
							</div>
						</div>
					</div>
				</div>
			</div>
		</v-container>

		<v-container text-xs-right>
			<v-btn class="green darken-2 font-weight-black" dark @click="$router.push({name:'newEntry'})">اضافة  مزود جديد	</v-btn>
		</v-container>
	<!-- 	<v-card class="grey">
			<v-card-title class="font-weight-black white--text">
				اضافة مزود جديد
			</v-card-title>
		</v-card>
		<v-card v-for="i in 4" :key="i" class="mt-2">
			<v-container>
				<v-layout row wrap>
					<v-flex xs3>
						img
					</v-flex>
					<v-flex xs9>
						<div class="title">
							Name
						</div>
						<div class="font-weight-black">
							Catgoray
						</div>
					</v-flex>
				</v-layout>	
			</v-container>
		</v-card> -->
	</div>
</template>
<script>
	export default {
		data() {
			return {
				user:{}
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('/marketing/main/index').then(response => {
					vm.user = response.data.user;
				});
			}
		},
		mounted() {
			const vm = this;
			vm.install();
		}
	}
</script>
<style>
	.card-header .title {text-align: center; font-weight: 700;}
</style>