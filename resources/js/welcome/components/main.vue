<template>
	<v-app>
		<v-toolbar dark>
		    <v-toolbar-title>Mujeeb</v-toolbar-title>
		  </v-toolbar>
		<v-content>
			<router-view></router-view>
		</v-content>
	</v-app>
</template>
<script>
	export default {
		data () {
	      return {
	        items: [
	          { title: 'dashboard', icon: 'dashboard',at:'index' },
	          { title: 'New Entry', icon: 'question_answer',at:'newEntry' }
	        ],
	        right: null,
	        drawer:false
	      }
	    }
	}
</script>
<style>
	.ff{font-family: 'Cairo', sans-serif !important;}
</style>