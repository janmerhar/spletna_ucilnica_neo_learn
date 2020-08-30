import LoginForm from '../views/loginregister/LoginForm.vue'
import RegisterForm from '../views/loginregister/RegisterForm.vue'
import Index from '../views/index/Index.vue'
import MyUcilnice from '../views/index/MyUcilnice.vue'
import NewUcilnica from '../views/NewUcilnica.vue'

import Ucilnica from '../views/Ucilnica.vue'
import LevaSkatla from '../components/layout/LevaSkatla.vue'
import DesnaSkatla from '../components/layout/DesnaSkatla.vue'

import NotFound from '../views/404/NotFound.vue'

export const routes = [
    {
        path: '*',
        component: NotFound
    },
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
        path: '/ucilnica/:ucilnica',
        name: 'ucilnica',
        components: {
            default: Ucilnica,
            'leva_skatla': LevaSkatla,
            'desna_skatla': DesnaSkatla
        },
        children: [

        ],
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
    },
    // dodaj path '*' za vse izgubljene linke AKA 404
]