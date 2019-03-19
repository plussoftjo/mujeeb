<template>
	<div class="routerLinkSection">
		<ul class="list-group bg-dark" style="border-radius: 0px!important; color: white; font-weight: 400;">
		  <li class="list-group-item bg-dark">Dashboard</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'catg'})">Catgoray</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'subCatg'})">Sub Catgoray</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'userreg'})">User Marketing</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'country'})">Country</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'city'})">City</li>
		  <li class="list-group-item bg-dark" @click="$router.push({name:'subcity'})">subcity</li>
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