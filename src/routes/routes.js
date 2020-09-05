import LoginForm from '../views/loginregister/LoginForm.vue'
import RegisterForm from '../views/loginregister/RegisterForm.vue'
import Index from '../views/index/Index.vue'
import MyUcilnice from '../views/index/MyUcilnice.vue'
import NewUcilnica from '../views/index/NewUcilnica.vue'

import Ucilnica from '../views/ucilnica/Ucilnica.vue'
import LevaSkatla from '../components/layout/LevaSkatla.vue'
import DesnaSkatla from '../components/layout/DesnaSkatla.vue'

import NotFound from '../views/404/NotFound.vue'
import Token_test from '../views/404/Token_test.vue'

import UporabnikTesti from '../views/ucilnica/testiocene/UporabnikTesti.vue'

export const routes = [
    {
        path: '/test',
        component: Token_test
    },
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
        // poskusi samo z nadaljevanjem novih routov, namesto, da delam child ocmponente
        /*
        children: [
            {
                path: '',

                components: {
                    default: Ucilnica,
                    'leva_skatla': LevaSkatla,
                    'desna_skatla': DesnaSkatla
                },
            },
            {
                path: 'myocene',
                name: 'myocene',
                component: MyUcilnice
            },
        ],*/
    },
    {
        path: '/ucilnica/:ucilnica/myocene',
        name: 'myocene',
        component: UporabnikTesti
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