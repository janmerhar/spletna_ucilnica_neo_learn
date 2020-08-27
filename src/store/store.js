import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        username: '',
        isLogin: false,
        token: ''
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
        }
    }
})