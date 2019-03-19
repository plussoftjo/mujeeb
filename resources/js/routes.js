import index from './components/pages/index.vue';
import catg from './components/pages/catg.vue';
import subCatg from './components/pages/subCatg';
import userreg from './components/pages/userreg';
import country from './components/pages/country';
import city from './components/pages/city';
import subcity from './components/pages/subcity';
export const routes = 
[
	{
		path:'/',
		name:'index',
		component:index
	},
	{
		path:'/catg',
		name:'catg',
		component:catg
	},
	{
		path:'/subCatg',
		name:'subCatg',
		component:subCatg
	},
	{
		path:'/userreg',
		name:'userreg',
		component:userreg
	},
	{
		path:'/country',
		name:'country',
		component:country
	},
	{
		path:'/city',
		name:'city',
		component:city
	},
	{
		path:'/subcity',
		name:'subcity',
		component:subcity
	}
];