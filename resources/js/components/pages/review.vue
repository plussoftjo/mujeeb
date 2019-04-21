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
		      <th scope="col">الحالة</th>
		      <th scope="col">تعديل</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(i,index) in users" :key="index">
		      <th scope="row">{{i.id}}</th>
		      <td>{{i.name}}</td>
		      <td>{{i.phone}}</td>
		      <td>غير مفعل بعد</td>
		      <td >
				  	<button type="button" class="btn btn-info" @click="show(i.id)">
				  		متابعه
				  	</button>
		      </td>
		    </tr>
		  </tbody>
		</table>
		</div>


		
		<!-- MODEL  -->
		<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="showUser" aria-hidden="true" v-if="user.supplier">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">اضافة جديد</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="show" dir="rtl" style="width: 100%; text-align: right;">
		      		<div class="body-show">
		      			<div>
		      			<span>اسم المؤسسة</span> <span>{{user.name}}</span>
		      			</div>
		      			<div>
		      			<span>رقم الهاتف</span> <span>{{user.phone}}</span>
		      			</div>
		      			<div>
		      			<span>الدولة</span> <span>{{user.supplier.country.title}}</span>
		      				
		      			</div>
		      			<div>
		      			<span>المدينة</span> <span>{{user.supplier.city.title}}</span>
		      				
		      			</div>

		      			<h3>
		      				مرفقات
		      			</h3>
		      			<div>
		      				<h4>رسالة :</h4> <p>{{review.title}}</p>
		      			</div>
		      			<img :src="review.image" alt="">
		      		</div>
		      	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" @click="block(user.id)">رفض</button>
		        <button type="button" class="btn btn-success" @click="enable(user.id)">موافقة</button>
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
				users:[],
				user:{},
				review:{}
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('admin/user/suppliers/review/index').then(response => {
					vm.users = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			block(i) {
				const vm = this;
				axios.get('/admin/user/suppliers/review/ban/' + i).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			enable(i) {
				const vm = this;
				axios.get('/admin/user/suppliers/review/enable/' + i).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			show(id) {
				const vm =this;
				$('#showUser').modal('show');
				axios.get('admin/user/suppliers/review/show/' + id).then(response => {
					vm.user = response.data.user;
					vm.review = response.data.review;
				}).catch(err => {
					console.log(err);
				});
			}
		},
		mounted() {
			const vm = this;
			vm.install();
		}
	}
</script>