import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

import { routes } from './routes/routes'
import { store } from './store/store'


Vue.use(VueRouter)
const router = new VueRouter({
  routes,
  mode: 'history'
})

// https://dev.to/ljnce/use-axios-api-with-vue-cli-54i2
Vue.use(VueAxios, axios)

axios.defaults.baseURL = 'http://localhost/koda/vuelearn/php/'
axios.defaults.headers.post['Content-Type'] = 'application/json'
// nastavim default authetication header na prazen niz
axios.defaults.headers.common['Authorization'] = ''

new Vue({
  render: h => h(App),
  router,
  store,
}).$mount('#app')
