import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        username: '',
        isLogin: false,
        Ucilnica: '',
        ucilnica: '',
    },
    mutations: {
        setUsername: (state, username) => {
            state.username = username
        },
        setToken: (state, token) => {
            state.token = token
        },
        setLogin: (state, isLogin) => {
            state.isLogin = isLogin
        },
        setUcilnica: (state, ucilnica) => {
            state.ucilnica = ucilnica
        }
    },
    getters: {
        getUsername: state => {
            return state.username
        },
        getLogin: state => {
            return state.isLogin
        },
        getToken: state => {
            return state.token
        },
        getUcilnica: state => {
            return state.ucilnica
        },
    }
})