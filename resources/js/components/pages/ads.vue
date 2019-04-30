<template>
	<div class="catg">
		<div class="container">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAds">اضافة  اعلان جديد</button>
			
		</div>
		
		<!-- CONTAINER WITH CATGORAY DATA -->
		<div class="container" style="padding-top: 15px;">
			<div class="row">
				<div class="col-md-6" v-for="(c,index) in adss" :key="index"  style="padding-top: 7px;">
					<div class="card">
						<img :src="c.image" alt=""  height="150px">
							<div class="editBtn">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-danger btn-sm" @click="destroy(c.id,index)">حذف</button>
								</div>
							</div>
							<h5 class="card-title" style="text-align: center; font-weight: 700;">{{c.title}}</h5>
					</div> 
				</div>
			</div>
		</div>
		
		<!-- MODEL  -->
		<div class="modal fade" id="newAds" tabindex="-1" role="dialog" aria-labelledby="newAds" aria-hidden="true">
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
				    <input type="text" class="form-control" v-model="ads.title" id="title" aria-describedby="emailHelp" placeholder="الرجاء ادخال اسم الفئة">
				</div>
				<div class="form-group">
				    <label for="photo">ادخال صورة</label>
				    <input type="file" class="form-control-file" v-on:change="onFileChange" id="photo">
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
		        <button type="button" class="btn btn-primary" @click="save">حفظ</button>
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
				ads:{title:'',image:''},
				adss:[],
				error:false,
				success:false,
				editCatg:null
			}
		},
		methods:{
			save() {
				const vm = this;
				vm.error = false;
				axios.post('/ads/store',vm.ads).then(response => {
					vm.catgs.push(response.data);
					vm.success = true;
					setTimeout(function() {
						$('#newAds').modal('hide');
						vm.success = false;
						vm.catg = {title:'',image:''}
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			},
			onFileChange(e) {
		    	let files = e.target.files || e.dataTransfer.files;
		        if (!files.length)
		          return;
		        this.createImage(files[0]);
		    },
		    createImage(file) {
		     let reader = new FileReader();
		      let vm = this;
		      reader.onload = (e) => {
		          vm.ads.image = e.target.result;
		      };
		      reader.readAsDataURL(file);
		   },
		   install() {
		   	const vm = this;
		   	axios.get('/ads/index').then(response => {
		   		vm.adss = response.data
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
		   destroy(id,index) {
		   	const vm = this;
		   	var index = index;
		   	confirm('هل تريد الحذف  ؟ ') && axios.get('/ads/destroy/' + id).then(response => {
		   		vm.adss.splice(index,1);
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
		   changeImage() {
		   	const vm = this;
		   	vm.$refs.image.click();
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