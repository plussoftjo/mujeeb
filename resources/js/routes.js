import index from './components/pages/index.vue';
import catg from './components/pages/catg.vue';
import subCatg from './components/pages/subCatg';
import userreg from './components/pages/userreg';
import country from './components/pages/country';
import city from './components/pages/city';
import subcity from './components/pages/subcity';
import suppliers from './components/pages/suppliers';
import needFrom from './components/pages/needFrom';
import bank from './components/pages/bank';
import review from './components/pages/review';
import payment from './components/pages/payment';
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
	},
	{
		path:'/suppliers',
		name:'suppliers',
		component:suppliers
	},
	{
		path:'/needFrom',
		name:'needFrom',
		component:needFrom
	},
	{
		path:'/bank',
		name:'bank',
		component:bank
	},
	{
		path:'/review',
		name:'review',
		component:review
	},
	{
		path:'/payment',
		name:'payment',
		component:payment
	}
];