<template>
	<div class="userreg">
		<div class="container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newUser">اضافة مستخدم جديد</button>
			

			<!-- MODEL  -->
		<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">مستخدم جديد</h5>
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
				    <label for="name">الاسم</label>
				    <input type="text" class="form-control" v-model="user.name" id="name" aria-describedby="emailHelp" placeholder="الاسم">
				</div>
				<div class="form-group">
				    <label for="phone">رقم الهاتف</label>
				    <input type="text" class="form-control" v-model="user.phone" id="phone" aria-describedby="emailHelp" placeholder="رقم الهاتف">
				</div>
				<div class="form-group">
				    <label for="password">رمز المرور</label>
				    <input type="password" class="form-control" v-model="user.password" id="password" placeholder="رمز المرور">
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
		<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">تعديل المستخدم</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="alert alert-danger" role="alert" v-if="error">
				  هناك خطأ في الادخال او الشبكة
				</div>
				<div class="alert alert-success" role="alert" v-if="success">
				  تم تعديل المادة
				</div>
		        <div class="form-group">
				    <label for="namee">الاسم</label>
				    <input type="text" class="form-control" v-model="usere.name" id="namee" aria-describedby="emailHelp" placeholder="الاسم">
				</div>
				<div class="form-group">
				    <label for="phonee">رقم الهاتف</label>
				    <input type="text" class="form-control" v-model="usere.phone" id="phonee" aria-describedby="emailHelp" placeholder="رقم الهاتف">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
		        <button type="button" class="btn btn-primary" @click="update">حفظ</button>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- TABLE -->

		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">الاسم</th>
		      <th scope="col">رقم الهاتف</th>
		      <th scope="col">عدد التسجيلات</th>
		      <th scope="col">تعديل</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(i,index) in users" :key="index">
		      <th scope="row">{{i.id}}</th>
		      <td>{{i.name}}</td>
		      <td>{{i.phone}}</td>
		      <td>0</td>
		      <td>
				  	<button type="button" class="btn btn-primary" @click="openEdit(i)">
				  		<i class="fas fa-edit"></i> Edit
				  	</button>
				  	<button type="button" class="btn btn-danger" @click="destroy(i,index)">
				  		<i class="fas fa-trash-alt"></i> remove
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
		methods:{
			save() {
				const vm = this;
				vm.error = false;
				axios.post('admin/user/marketing/store',vm.user).then(response => {
					vm.success = true;
					vm.users.push(response.data)
					setTimeout(function() {
						$('#newUser').modal('hide');
						vm.success = false;
						vm.user = {};
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			},
			install() {
				const vm = this;
				axios.get('admin/user/marketing/index').then(response => {
					vm.users = response.data;
				});
			},
			openEdit(e) {
				const vm = this;
				vm.usere = e;
				$('#editUser').modal('show');
			},
			update() {
				const vm = this;
				vm.error = false; 
				axios.post('admin/user/marketing/update/' + vm.usere.id, vm.usere).then(response => {
					vm.success  = true;
					setTimeout(function() {
						vm.success = false;
						vm.usere = false;
						$('#editUser').modal('hide');
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			},
			destroy(i,index) {
				const vm = this;
				const item = i;
				var indexx = index;
				confirm('هل تريد الحذف ؟') && axios.get('admin/user/marketing/destroy/' + item.id).then(response => {
					vm.users.splice(indexx,1);
				}).catch(err => {
					console.log(err);
				});
			}
		},
		data() {
			return {
				error:false,
				users:[],
				user:{},
				editUser:{},
				success:false,
				usere:{}
			}
		},
		mounted() {
			const vm = this;
			vm.install();
		}
	}
</script>