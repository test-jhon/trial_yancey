
require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueRouter)

const routes = [
  { path: '/cars', component: require('./pages/Car.vue').default },
  { path: '/manufacturers', component: require('./pages/Manufacturer.vue').default },
  { path: '/types', component: require('./pages/Type.vue').default },
  { path: '/colors', component: require('./pages/Color.vue').default },
]

const router = new VueRouter({
  routes
})

const app = new Vue({
  el: '#app',
  router,
});
