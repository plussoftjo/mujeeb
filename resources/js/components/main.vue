<template>
	<div class="main">
		<nav class="navbar navbar-dark bg-dark" style="background-color: #ededed;">
		  <a class="navbar-brand" href="#">
		    <img :src="require('./imgs/logo.png')" width="40" height="40" alt="">
		  </a>
		</nav>
		<div class="bg-light" style="padding-top: 0px;" :style="{height:height}">
			<div class="pages">
				<div class="left">
					<routerLinkSection></routerLinkSection>
				</div>
				<div class="right">
					<div class="card">
						<h5 class="card-title bg-dark" style="padding: 5px; color: white;">{{$route.name}}</h5>
						<div class="card-body">
							<router-view></router-view>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import routerLinkSection from './part/routerLinkSection';
	export default {
		data() {
			return {
				height:'0px'
			}
		},
		mounted() {
			const vm = this;
			vm.height = window.innerHeight + 'px';
		},
		components:{routerLinkSection}
	}
</script>
<style>
	.pages{display: flex; color: black;}
	.pages .left{width: 20%;}
	.pages .right{width: 80%;}
</style>