import Vue from "vue"
// import axios from "axios"
import Vuex from "vuex"
import createPersistedState from "vuex-persistedstate"

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    token: "",
    username: "",
    isLogin: false,
    ucilnica: "",
    isSkrbnik: false,
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
    },
    setSkrbnik: (state, isSkrbnik) => {
      state.isSkrbnik = isSkrbnik
    },
  },
  getters: {
    getUsername: (state) => state.username,
    getLogin: (state) => state.isLogin,
    getToken: (state) => state.token,
    getUcilnica: (state) => state.ucilnica,
    getSkrbnik: (state) => state.isSkrbnik,
  },
  actions: {
    // async checkLogin({ commit, state }) {
    //   await axios
    //     .post("libraries/beforeEach.php", {
    //       token: state.token,
    //     })
    //     .then((res) => {
    //       console.log(res.data)
    //       if (res.data.token) commit("setToken", res.token)
    //     })
    // },
  },
  plugins: [
    createPersistedState({
      paths: ["token", "username", "isLogin", "ucilnica", "isSkrbnik"],
    }),
  ],
})
