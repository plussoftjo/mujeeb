<template>
	<div class="catg">
		<div class="container">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCity">اضافة مدينة جديدة</button>
		</div>
		
		
		<!-- MODEL  -->
		<div class="modal fade" id="newCity" tabindex="-1" role="dialog" aria-labelledby="newCity" aria-hidden="true">
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
				    <input type="text" class="form-control" v-model="city.title" id="title" aria-describedby="emailHelp" placeholder="اسم المدينة">
				</div>
				  <div class="form-group">
				    <label for="catgs">اختيار الدولة</label>
				    <select class="form-control" id="catgs" v-model="city.country_id">
				      <option v-for="(c,index) in countrys" :value="c.id">{{c.title}}</option>
				    </select>
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
		<div class="modal fade" id="editCity" tabindex="-1" role="dialog" aria-labelledby="editCity" aria-hidden="true" v-if="editCity">
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
				  تتم التعديل بنجاح
				</div>
		        <div class="form-group">
				    <label for="title">العنوان</label>
				    <input type="text" class="form-control" v-model="editCity.title" id="title" aria-describedby="emailHelp" placeholder="اسم المدينة">
				</div>
				  <div class="form-group">
				    <label for="catgs">اختيار الدولة</label>
				    <select class="form-control" id="catgs" v-model="editCity.country_id">
				      <option v-for="(c,index) in countrys" :value="c.id">{{c.title}}</option>
				    </select>
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
		      <th scope="col">Title</th>
		      <th scope="col">Edit</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(c,index) in citys" :key="index">
		      <th scope="row">{{c.id}}</th>
		      <td>{{c.title}}</td>
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
			city:{},
			citys:[],
			countrys:[],
			error:false,
			success:false,
			editCity:null
			}
		},
		methods:{
			save() {
				const vm = this;
				vm.error = false;
				axios.post('/city/store',vm.city).then(response => {
					vm.citys.push(response.data);
					vm.success = true;
					setTimeout(function() {
						$('#newCity').modal('hide');
						vm.success = false;
						vm.city = {}
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			},
		   install() {
		   	const vm = this;
		   	axios.get('/city/index').then(response => {
		   		vm.countrys = response.data.countrys;
		   		vm.citys = response.data.citys;
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
		   destroy(id,index) {
		   	const vm = this;
		   	var index = index;
		   	confirm('هل تريد الحذف  ؟ ') && axios.get('/city/destroy/' + id.id).then(response => {
		   		vm.citys.splice(index,1);
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
			update() {
				const vm = this;
				vm.error = false;
				axios.post('/city/update/' + vm.editCity.id ,vm.editCity).then(response => {
					vm.success = true;
					setTimeout(function() {
		   			$('#editCity').modal('hide')
					vm.editCity = null;
					vm.success = false;		
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			},
			openEdit(c) {
				const vm = this;
				vm.editCity = c;
				$('#editCity').modal('show');
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