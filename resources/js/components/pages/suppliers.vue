<template>
	<div class="suppliers">
		<div class="container">
			<!-- TABLE -->

		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">الاسم</th>
		      <th scope="col">رقم الهاتف</th>
		      <th scope="col">الكاش المطلوب</th>
		      <th scope="col">الحالة</th>
		      <th scope="col">تعديل</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(i,index) in users" :key="index">
		      <th scope="row">{{i.id}}</th>
		      <td>{{i.name}}</td>
		      <td>{{i.phone}}</td>
		      <td v-if="i.supplier">{{i.supplier.cash}}</td>
		      <td v-if="!i.supplier">0</td>
		      <td v-if="i.approve == 0">غير مفعل</td>
		      <td v-if="i.approve == 1">متاح</td>
		      <td v-if="i.approve == 2">محظور</td>
		      <td v-if="i.approve == 1">
				  	<button type="button" class="btn btn-danger" @click="block(i.id,index)">
				  		<i class="fa fa-ban"></i> Block
				  	</button>
		      </td>
		      <td v-if="i.approve == 0">
				  	<button type="button" class="btn btn-danger" @click="block(i.id,index)">
				  		<i class="fa fa-ban"></i> Block
				  	</button>
		      </td>
		      <td v-if="i.approve == 2">
				  	<button type="button" class="btn btn-success" @click="enable(i.id,index)">
				  		<i class="fa fa-check-square-o"></i> Enaple
				  	</button>
		      </td>
		    </tr>
		  </tbody>
		</table>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				users:[]
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('admin/user/suppliers/index').then(response => {
					vm.users = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			block(i,index) {
				const vm = this;
				var index = index;
				axios.get('/admin/user/suppliers/ban/' + i).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			enable(i,index) {
				const vm = this;
				var index = index;
				axios.get('/admin/user/suppliers/enable/' + i).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			}
		},
		mounted() {
			const vm = this;
			vm.install();
		}
	}
</script>