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
		      <th scope="col">تعديل</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="(i,index) in payments" :key="index">
		      <th scope="row">{{i.id}}</th>
		      <td>{{i.msg}}</td>
		      <td>{{i.amount}}</td>
		      <td >
				  	<button type="button" class="btn btn-info" @click="show(i)">
				  		متابعه
				  	</button>
		      </td>
		    </tr>
		  </tbody>
		</table>
		</div>


		
		<!-- MODEL  -->
		<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="showUser" aria-hidden="true" >
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
		      			<div class="card">
		      				<div class="card-title" style="background-color: grey; color:white;" >
		      					معلومات الحساب
		      				</div>
		      				<div class="card-body">
		      					<div class="bs">
		      						<span>اسم الحساب</span> - <span>{{user.name}}</span>
		      					</div>
		      					<div class="bs">
		      						<span>رقم الهاتف </span> - <span>{{user.phone}}</span>
		      					</div>
		      					<div class="bs">
		      						<span>الرصيد المطلوب</span> - <span>{{user.supplier.cash}}</span>
		      					</div>
		      				</div>
		      			</div>
		      			<div class="card">
		      				<div class="card-title" style="background-color: grey; color:white;">
		      					معلومات الدفعه 
		      				</div>
		      				<div class="card-body">
		      					<div class="bs">
		      						<span>الرصيد المدفوع</span> - <span>{{payment.amount}}</span>
		      					</div>
		      					<div class="bs">
		      						<span>رسالة من المؤسسة</span> - <span>{{payment.msg}}</span>
		      					</div>
		      					<div class="bs">
		      						<img :src="payment.image" alt="">
		      					</div>
		      				</div>
		      			</div>
		      			<div class="card">
		      				<div class="card-title" style="background-color: grey; color:white;">
		      					خصم من الرصيد المطلوب
		      				</div>
		      				<div class="card-body">
		      					<div class="form-group">
								    <label for="title">خصم مبلغ</label>
								    <input type="number" v-model="cash" class="form-control" id="title"  placeholder="الرجاء ادخال المبلغ المراد خصمه من القيمة المطلوبة  من االمزود">
								</div>
		      				</div>
		      			</div>
		      		</div>
		      	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>
		        <button type="button" class="btn btn-success" @click="enable(payment.id,user.id)">موافقة</button>
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
				payments:[],
				user:{supplier:{}},
				payment:{},
				cash:0
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('admin/user/suppliers/payments/index').then(response => {
					vm.payments = response.data;
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
			enable(payment_id,user_id) {
				const vm = this;
				axios.post('admin/user/suppliers/payments/payment_id/' + payment_id + '/user_id/' + user_id,{cash:vm.cash}).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			show(item) {
				const vm =this;
				$('#showUser').modal('show');
				vm.payment = item;
				axios.get('admin/user/suppliers/payments/show/' + item.id).then(response => {
					vm.user = response.data;
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