<template>
	<v-app>
		<v-toolbar dark>
		    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
		    <v-toolbar-title>Mujeeb Marketing</v-toolbar-title>
		  </v-toolbar>
		<v-navigation-drawer v-model="drawer" absolute
	      dark
	      temporary>
		    <v-toolbar flat>
		      <v-list>
		        <v-list-tile>
		          <v-list-tile-title class="title">
		            Mujeeb
		          </v-list-tile-title>
		        </v-list-tile>
		      </v-list>
		    </v-toolbar>

		    <v-divider></v-divider>

		    <v-list dense class="pt-0">
		      <v-list-tile
		        v-for="item in items"
		        :key="item.title"
		        @click="$router.push({name:item.at})"
		      >
		        <v-list-tile-action>
		          <v-icon>{{ item.icon }}</v-icon>
		        </v-list-tile-action>

		        <v-list-tile-content>
		          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
		        </v-list-tile-content>
		      </v-list-tile>
		    </v-list>
		  </v-navigation-drawer>
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