<template>
	<div class="newEntry">
		<v-container v-if="!success">
			<div class="title">
				اضافة مزود جديد
			</div>
			<v-container>
				<v-card class="mt-2"> 
				<v-card-title class="black lighten-2 white--text">
					معلومات المزود الرئيسية
				</v-card-title>
				<v-card-title>
					<v-layout row wrap>
						<v-flex xs12>
							<v-text-field
							label="اسم المزود"
							solo
							v-model="supplier.name"></v-text-field>
						</v-flex>
						<v-flex xs12>
							<v-text-field
							label="رقم الهاتف"
							solo
							v-model="supplier.phone"></v-text-field>
						</v-flex>
						<v-flex xs12>
							<v-text-field
							solo
							label="رمز المرور للحساب"
							v-model="supplier.password"></v-text-field>
						</v-flex>
						<v-flex xs12>
							<v-select
							solo
							:items="['مؤسسة','فرد']"
							v-model="supplier.type"
							label="نوع"></v-select>
						</v-flex>
						<v-flex xs12>
							<v-btn class="pink darken-3 font-weight-black" dark @click="openImage">اضافة صورة</v-btn>
							<div class="image_form">
								<input type="file" ref="image" @change="onFileChange">
							</div>
						</v-flex>
					</v-layout>
				</v-card-title>
			</v-card>
			</v-container>


			<v-container>
				<v-card>
					<v-card-title class="black lighten-2 white--text">
						معلومات المنطقة
					</v-card-title>
					<v-card-title>
						<v-layout row wrap>
							<v-flex xs12>
								<v-select 
								:items="countrys"
								solo
								item-text="title"
								item-value="id"
								label="الدولة"
								@change="changeCountry"
								v-model="supplier.country_id"></v-select>
							</v-flex>
							<v-flex xs12>
								<v-select
								:items="citys"
							solo
								label="المدينة"
								item-text="title"
								item-value="id"
								@change="changeCity"
								v-model="supplier.city_id"></v-select>
							</v-flex>
							<v-flex xs12>
								<v-select
							solo
								:items="subcitys"
								label="المناطق"
								multiple
								item-text="title"
								item-value="id"
								v-model="supplier.subcity_id"></v-select>
							</v-flex>
						</v-layout>
					</v-card-title>
				</v-card>
			</v-container>

			
			<v-container>
				<v-card>
					<v-card-title class="black lighten-2 white--text">
						الفئات
					</v-card-title>
					<v-card-title>
						<v-layout row wrap>
							<v-flex xs12>
								<v-select
								:items="catgs"
							solo
							multiple
							item-text="title"
								item-value="id"
								v-model="supplier.catg_id"
								@change="changeCatg"
								label="الفئة الرئيسية"></v-select>
							</v-flex>
							<v-flex xs12>
								<v-select
								:items="subCatgs"
							solo
								label="الفئة الثانوية"
								multiple
								item-text="title"
								item-value="id"
								v-model="supplier.subcatg_id"></v-select>
							</v-flex>
						</v-layout>
					</v-card-title>
				</v-card>
			</v-container>
			<v-container>
				<v-alert :value="error" class="red">
					يرجى تعبئة جميع الحقول المطلوبة
				</v-alert>
			</v-container>
			<v-container>
				<v-btn class="green" block dark @click="store">
					حفظ معلومات المزود الجديدة
				</v-btn>
			</v-container>
		</v-container>

		<v-container v-else>
			<v-card>
				<v-card-title class="black white--text">
					تم تسجيل المستخدم بنجاح 
				</v-card-title>
				<v-card-title>
					تم التسجيل بنجاح يمكن للمستخدم تسجيل الدخول باستخدام المعلومات التالية
				</v-card-title>
				<v-card-title>
					<div class="font-weight-black" style="width: 100%;">
						الاسم : {{supplier.name}}
					</div>
					<div class="font-weight-black" style="width: 100%;">
						رقم الهاتف : {{supplier.phone}}
					</div>
					<div class="font-weight-black" style="width: 100%;">
						رمز المرور: {{supplier.password}}
					</div>
				</v-card-title>
			</v-card>
		</v-container>

		
		<div class="preloader" v-if="loader">
			<v-progress-circular
		      :width="7"
		      :size="100"
		      color="white"
		      indeterminate
		    ></v-progress-circular>
		</div>


	</div>
</template>
<script>
	export default {
		data() {
			return {
				supplier:{},
				countrys:[],
				citys:[],
				subcitys:[],
				catgs:[],
				subCatgs:[],
				error:false,
				success:false,
				loader:false
			}
		},
		methods:{
			openImage() {
				const vm = this;
				vm.$refs.image.click();
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
		          vm.supplier.image = e.target.result;
		      };
		      reader.readAsDataURL(file);
			},
			install() {
				const vm = this;
				axios.get('marketing/newEntry/index').then(response => {
					vm.countrys = response.data.countrys;
					vm.catgs = response.data.catgs;
				}).catch(err => {
					console.log(err)
				});
			},
			store() {
				const vm = this;
				vm.loader = true;
				
				vm.error = false;
				if(vm.supplier.subcity_id) {
				vm.supplier.subcity_id = vm.supplier.subcity_id.toString();

				}
				if(vm.supplier.catg_id) {
				vm.supplier.catg_id = vm.supplier.catg_id.toString();
					
				}

				if(vm.supplier.subcatg_id) {
				vm.supplier.subcatg_id = vm.supplier.subcatg_id.toString();
					
				}
				
				
				axios.post('marketing/supplier/store',vm.supplier).then(response => {
					vm.success = true;
					vm.loader = false;
				}).catch(err => {
					vm.error = true;
					vm.loader = false;
				});
			},
			changeCountry() {
				const vm = this;
				axios.get('marketing/newEntry/changeCountry/' + vm.supplier.country_id).then(response => {
					vm.citys = response.data;
				});
			},
			changeCity() {
				const vm = this;
				axios.get('marketing/newEntry/changeCity/' + vm.supplier.city_id).then(response => {
					vm.subcitys = response.data;
				});
			},
			changeCatg() {
				const vm = this;
				axios.get('marketing/newEntry/changeCatg/' + vm.supplier.catg_id).then(response => {
					console.log(response.data);
					vm.subCatgs = [];
					response.data.forEach(trg => {
						trg.forEach(rm => {
							vm.subCatgs.push(rm);
						})
					});
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
	.image_form{position: fixed; left:-999999999px;}
	.preloader{position: fixed; left: 0px; top:0px; width: 100%;height: 100%; z-index: 300; background-color: rgba(0,0,0,0.6); margin: auto; padding-top: 50%; padding-left:35%;}
</style>