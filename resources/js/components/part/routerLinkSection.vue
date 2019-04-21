<template>
	<div class="routerLinkSection">
		<ul class="list-group bg-dark" style="border-radius: 0px!important; color: white; font-weight: 400;">
		  <li class="list-group-item bg-dark"@click="$router.push({name:'index'})">لوحة التحكم</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'catg'})">الفئات</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'subCatg'})">الفئات الثانويه</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'userreg'})">حسابات المسوقين</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'country'})">الدول</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'city'})">المدن</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'subcity'})">الاحياء</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'suppliers'})">قائمة المزودين</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'needFrom'})">المطلوب منهم</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'bank'})">الحسابات البنكية</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'review'})">طلبات تسجيل المزودين</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'payment'})">الدفعات</li>
		</ul>
	</div>
</template>
<script>
	export default {

	}
</script>
<style>
	.list-group .list-group-item{border-radius: 0px!important; cursor: pointer;}
</style>