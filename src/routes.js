import LoginForm from './components/loginregister/LoginForm.vue'
import RegisterForm from './components/loginregister/RegisterForm.vue'
import Index from './components/index/Index.vue'
import MyUcilnice from './components/index/MyUcilnice.vue'

export const routes = [
    { path: '/', name: 'index', component: Index },
    { path: '/my', name: 'my', component: MyUcilnice },
    { path: '/:ucilnica', name: 'index', component: Index },
    { path: '/login', name: 'login', component: LoginForm },
    { path: '/register', name: 'register', component: RegisterForm },

]