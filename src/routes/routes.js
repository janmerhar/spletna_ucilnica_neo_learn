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
import UporabnikiPregled from '../views/ucilnica/uprabniki/UporabnikiPregled.vue'
import SkrbnikTesti from '../views/ucilnica/testiocene/SkrbnikTesti.vue'
import OceneTesta from '../views/ucilnica/testiocene/OceneTesta.vue'

import ResiTest from '../views/ucilnica/resiustvaritest/ResiTest.vue'

export const routes = [
    {
        path: '/test',
        component: Token_test
    },
    // 404 napake
    {
        path: '*',
        component: NotFound
    },
    // index
    {
        path: '/',
        name: 'index',
        component: Index
    },
    // uporabnikove včlanjene učilnice
    {
        path: '/my',
        name: 'my',
        component: MyUcilnice
    },
    // učilnice
    {
        path: '/ucilnica/:ucilnica',
        name: 'ucilnica',
        components: {
            default: Ucilnica,
            'leva_skatla': LevaSkatla,
            'desna_skatla': DesnaSkatla
        },
    },
    // uporabnikov pogled na svoje ocene in teste, ki jih lahko reši
    {
        path: '/ucilnica/:ucilnica/myocene',
        name: 'myocene',
        components: {
            default: UporabnikTesti,
            'leva_skatla': LevaSkatla,
            'desna_skatla': DesnaSkatla
        },
    },
    // reševanje testov
    {
        path: '/ucilnica/:ucilnica/resi/:testid',
        name: "resi",
        component: ResiTest
    },
    // skrbnikov pogled na včlanjene uporabnike
    {
        path: '/ucilnica/:ucilnica/uporabniki',
        name: 'uporabniki',
        components: {
            default: UporabnikiPregled,
            'leva_skatla': LevaSkatla,
            'desna_skatla': DesnaSkatla
        },
    },
    // skrbnikov pogled na teste v učilnici
    {
        path: '/ucilnica/:ucilnica/testi',
        name: 'testi',
        components: {
            default: SkrbnikTesti,
            'leva_skatla': LevaSkatla,
            'desna_skatla': DesnaSkatla
        },
    },
    // skrbnikov pogled na ocene določenega testa
    {
        path: '/ucilnica/:ucilnica/testi/:testid',
        name: 'test',
        components: {
            default: OceneTesta,
            'leva_skatla': LevaSkatla,
            'desna_skatla': DesnaSkatla
        },
    },
    // loginregister
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
    // vnos nove učilnice
    {
        path: '/new',
        name: 'new',
        component: NewUcilnica
    },
]