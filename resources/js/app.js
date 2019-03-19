require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
window.Vue.use(VueRouter);
import { routes } from './routes.js';

const router = new VueRouter({
  routes,
  scrollBehavior (proudect, home, savedPosition) {
  return { x: 0, y: 0 }
}
});

import main from './components/main.vue';



const app = new Vue({
    el: '#app',
    router,
    render: h => h(main)
});
