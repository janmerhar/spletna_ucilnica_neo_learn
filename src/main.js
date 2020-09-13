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

const checkLogin = async () => {
  const res = await axios.post("libraries/beforeEach.php", { token: store.getters.getToken })
  store.commit("setToken", res.data.token)
}

// zagotavlja preverjanje prijave
router.beforeEach((to, from, next) => {
  checkLogin()
  console.log(store.getters.getToken)
  if (to.name == "login" || to.name == "register") {
    if (store.getters.getToken === null)
      next()
    else next(false)
  }
  else {
    if (store.getters.getToken !== null)
      next()
    else next({ name: 'login' })
  }
})


// https://dev.to/ljnce/use-axios-api-with-vue-cli-54i2
Vue.use(VueAxios, axios)

// https://stackoverflow.com/questions/44479681/cors-php-response-to-preflight-request-doesnt-pass-am-allowing-origin
axios.defaults.baseURL = 'https://localhost/koda/vuelearn/php/'
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded'
// nastavim default authetication header na prazen niz
axios.defaults.headers.common['Authorization'] = "AUTH_TOKEN";
// axios.defaults.headers.common['Access-Control-Allow-Origin'] = 'http://localhost:8080'
axios.defaults.withCredentials = true


new Vue({
  render: h => h(App),
  router,
  store,
}).$mount('#app')
