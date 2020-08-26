import LoginForm from '../views/loginregister/LoginForm.vue'
import RegisterForm from '../views/loginregister/RegisterForm.vue'
import Index from '../views/Index.vue'
import MyUcilnice from '../views/MyUcilnice.vue'
import NewUcilnica from '../views/NewUcilnica.vue'

export const routes = [
    {
        path: '/',
        name: 'index',
        component: Index
    },
    {
        path: '/my',
        name: 'my',
        component: MyUcilnice
    },
    {
        path: '/:ucilnica',
        name: 'index',
        component: Index
    },
    {
        path: '/login',
        name: 'login',
        component: LoginForm
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterForm
    },
    {
        path: '/new',
        name: 'new',
        component: NewUcilnica
    }
]