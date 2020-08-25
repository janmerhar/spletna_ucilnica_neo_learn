import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vuex from 'vuex'

import { routes } from './routes'

Vue.use(VueRouter)
const router = new VueRouter({
  routes,
  mode: 'history'
})

// https://dev.to/ljnce/use-axios-api-with-vue-cli-54i2
Vue.use(VueAxios, axios)
Vue.use(Vuex)

axios.defaults.baseURL = 'http://localhost/koda/vuelearn/php/'
axios.defaults.headers.post['Content-Type'] = 'application/json'

new Vue({
  render: h => h(App),
  router,
}).$mount('#app')
