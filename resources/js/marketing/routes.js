import index from './components/pages/index.vue';
import newEntry from './components/pages/newEntry.vue';
import done from './components/pages/done.vue';
export const routes = [
{
	path:'/',
	name:'index',
	component:index
},{
	path:'/newEntry',
	name:'newEntry',
	component:newEntry
},
{
	path:'/done',
	name:'done',
	component:done
}]