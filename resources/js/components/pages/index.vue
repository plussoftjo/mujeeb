<template>
	<div class="index">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							عدد العملاء المسجلين
						</div>
						<div class="card-body">
							{{state.client_count}}
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							عدد المسجلين
						</div>
						<div class="card-body">
							{{state.supplier_count}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				state:{}
			}
		},
		methods:{
			install() {
				const vm =this;
				axios.get('admin/dashboard/state').then(response => {
					vm.state = response.data;
				}).catch(err => {
					console.log(err);
				});
			}
		},
		mounted() {
			const vm =this;
			vm.install();
		}
	}
</script>