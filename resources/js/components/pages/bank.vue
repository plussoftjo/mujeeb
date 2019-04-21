<template>
	<div class="catg">
		<div class="container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newBank">اضافة حساب جديد</button>
		</div>
		
		
		<!-- MODEL  -->
		<div class="modal fade" id="newBank" tabindex="-1" role="dialog" aria-labelledby="newBank" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">اضافة جديد</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="alert alert-danger" role="alert" v-if="error">
				  هناك خطأ في الادخال او الشبكة
				</div>
				<div class="alert alert-success" role="alert" v-if="success">
				  تم اضافة المادة
				</div>
		        <div class="form-group">
				    <label for="title">العنوان</label>
				    <input type="text" class="form-control" v-model="bank.account_number" id="title" aria-describedby="emailHelp" placeholder="رقم الحساب">
				</div>
				<div class="form-group">
				    <label for="title">العنوان</label>
				    <input type="text" class="form-control" v-model="bank.bank_name" id="title" aria-describedby="emailHelp" placeholder="اسم البنك">
				</div>
				<div class="form-group">
				    <label for="title">العنوان</label>
				    <input type="text" class="form-control" v-model="bank.place" id="title" aria-describedby="emailHelp" placeholder="الفرع">
				</div>
				<div class="form-group">
				    <label for="title">العنوان</label>
				    <input type="text" class="form-control" v-model="bank.account_name" id="title" aria-describedby="emailHelp" placeholder="الحساب مسجل باسم">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" @click="save">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
		

		<!-- MODEL  -->
		<div class="modal fade" id="editBank" tabindex="-1" role="dialog" aria-labelledby="editBank" aria-hidden="true" v-if="editBank">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">تعديل المدينة </h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="alert alert-danger" role="alert" v-if="error">
				  هناك خطأ في الادخال او الشبكة
				</div>
				<div class="alert alert-success" role="alert" v-if="success">
				  	تم تعديل المادة بنجاح
				</div>
		        <div class="form-group">
				    <label for="title">رقم الحساب</label>
				    <input type="text" class="form-control" v-model="editBank.account_number" id="title" aria-describedby="emailHelp" placeholder="رقم الحساب">
				</div>
				<div class="form-group">
				    <label for="title">سم البنك</label>
				    <input type="text" class="form-control" v-model="editBank.bank_name" id="title" aria-describedby="emailHelp" placeholder="اسم البنك">
				</div>
				<div class="form-group">
				    <label for="title">لفرع</label>
				    <input type="text" class="form-control" v-model="editBank.place" id="title" aria-describedby="emailHelp" placeholder="الفرع">
				</div>
				<div class="form-group">
				    <label for="title">لحساب مسجل باسم</label>
				    <input type="text" class="form-control" v-model="editBank.account_name" id="title" aria-describedby="emailHelp" placeholder="الحساب مسجل باسم">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" @click="update">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>


		<!-- TABLE -->
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">رقم الحساب</th>
		      <th scope="col">اسم البنك</th>
		      <th scope="col">الفرع</th>
		      <th scope="col">اسم الحساب</th>
		      <th scope="col">تعديل</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(c,index) in banks" :key="index">
		      <th scope="row">{{c.id}}</th>
		      <td>{{c.account_number}}</td>
		      <td>{{c.bank_name}}</td>
		      <td>{{c.place}}</td>
		      <td>{{c.account_name}}</td>
		      <td>
				  	<button type="button" class="btn btn-primary btn-sm" @click="openEdit(c)">
				  		<i class="fas fa-edit"></i> Edit
				  	</button>
				  	<button type="button" class="btn btn-danger btn-sm" @click="destroy(c,index)">
				  		<i class="fas fa-trash-alt"></i> remove
				  	</button>
		      </td>
		    </tr>
		  </tbody>
		</table>
	</div>
</template>
<script>
	export default {
		data() {
			return {
			bank:{},
			banks:[],
			error:false,
			success:false,
			editBank:null
			}
		},
		methods:{
			save() {
				const vm = this;
				vm.error = false;
				axios.post('/bank/store',vm.bank).then(response => {
					vm.banks.push(response.data);
					vm.success = true;
					setTimeout(function() {
						$('#newBank').modal('hide');
						vm.success = false;
						vm.bank = {}
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			},
		   install() {
		   	const vm = this;
		   	axios.get('/bank/index').then(response => {
		   		vm.banks = response.data;
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
		   destroy(id,index) {
		   	const vm = this;
		   	var index = index;
		   	confirm('هل تريد الحذف  ؟ ') && axios.get('/bank/destroy/' + id.id).then(response => {
		   		vm.banks.splice(index,1);
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
			update() {
				const vm = this;
				vm.error = false;
				axios.post('/bank/update/' + vm.editBank.id ,vm.editBank).then(response => {
					vm.success = true;
					setTimeout(function() {
		   			$('#editBank').modal('hide')
					vm.editBank = null;
					vm.success = false;		
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			},
			openEdit(c) {
				const vm = this;
				vm.editBank = c;
				$('#editBank').modal('show');
			},

		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>
<style>
	.editBtn{position: absolute; right: 0px; top: 0px;}
	.inputF{position: fixed; left: -9999999px;}
</style>