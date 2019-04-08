<template>
	<div class="catg">
		<div class="container">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCatg">اضافة فئة جديدة</button>
			
		</div>
		
		<!-- CONTAINER WITH CATGORAY DATA -->
		<div class="container" style="padding-top: 15px;">
			<div class="row">
				<div class="col-md-3" v-for="(c,index) in catgs" :key="index"  style="padding-top: 7px;">
					<div class="card">
						<img :src="c.image" alt=""  height="150px">
							<div class="editBtn">
								<div class="btn-group" role="group" aria-label="Basic example">
									<button type="button" class="btn btn-secondary btn-sm" data-target="#editCatg" @click="openEdit(c)">تعديل</button>
									<button type="button" class="btn btn-danger btn-sm" @click="destroy(c.id,index)">حذف</button>
								</div>
							</div>
							<h5 class="card-title" style="text-align: center; font-weight: 700;">{{c.title}}</h5>
					</div> 
				</div>
			</div>
		</div>
		
		<!-- MODEL  -->
		<div class="modal fade" id="newCatg" tabindex="-1" role="dialog" aria-labelledby="newCatg" aria-hidden="true">
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
				    <input type="text" class="form-control" v-model="catg.title" id="title" aria-describedby="emailHelp" placeholder="الرجاء ادخال اسم الفئة">
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

		<!-- MODEL  -->
		<div class="modal fade" id="editCatg" tabindex="-1" role="dialog" aria-labelledby="editCatg" aria-hidden="true" v-if="editCatg">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
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
				    <input type="text" class="form-control" v-model="editCatg.title" id="title" aria-describedby="emailHelp" placeholder="الرجاء ادخال اسم الفئة">
				</div>
				<div class="form-group">
					<div class="card">
						<img :src="editCatg.image" alt="">
						<h5 class="card-title" style="cursor: pointer; text-align: center;" @click="changeImage">تغير الصورة</h5>
					</div>
					<div class="inputF">
				  	  <input type="file" ref="image" class="form-control-file" v-on:change="onFileChangeU" id="photo">
					</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" @click="update">Update changes</button>
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
				catg:{title:'',image:''},
				catgs:[],
				error:false,
				success:false,
				editCatg:null
			}
		},
		methods:{
			save() {
				const vm = this;
				vm.error = false;
				axios.post('/catg/store',vm.catg).then(response => {
					vm.catgs.push(response.data);
					vm.success = true;
					setTimeout(function() {
						$('#newCatg').modal('hide');
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
		          vm.catg.image = e.target.result;
		      };
		      reader.readAsDataURL(file);
		   },
		   install() {
		   	const vm = this;
		   	axios.get('/catg/index').then(response => {
		   		vm.catgs = response.data
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
		   destroy(id,index) {
		   	const vm = this;
		   	var index = index;
		   	confirm('هل تريد الحذف  ؟ ') && axios.get('/catg/destroy/' + id).then(response => {
		   		vm.catgs.splice(index,1);
		   	}).catch(err => {
		   		console.log(err)
		   	});
		   },
		   changeImage() {
		   	const vm = this;
		   	vm.$refs.image.click();
		   },
		   openEdit(catg) {
		   	const vm = this;
		   	$('#editCatg').modal('show')
		   	vm.editCatg = catg; 
		   },
		   onFileChangeU(e) {
		   	let files = e.target.files || e.dataTransfer.files;
	        if (!files.length)
	          return;
	        this.createImageU(files[0]);
		    },
		    createImageU(file) {
		     let reader = new FileReader();
		      let vm = this;
		      reader.onload = (e) => {
		          vm.editCatg.image = e.target.result;
		          vm.updateImage();
		      };
		      reader.readAsDataURL(file);
			},
			updateImage() {
				const vm = this;
				axios.post('/catg/update/image/' + vm.editCatg.id, {image:vm.editCatg.image}).then(response => {
					vm.success = true;
				}).catch(err => {
					vm.error = true;

				});
			},
			update() {
				const vm = this;
				vm.error = false;
				axios.post('/catg/update/title/' + vm.editCatg.id ,{title:vm.editCatg.title}).then(response => {
					vm.success = true;
					setTimeout(function() {
		   			$('#editCatg').modal('hide')
					vm.editCatg = null;
					vm.success = false;		
					}, 1000);
				}).catch(err => {
					vm.error = true;
				});
			}
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