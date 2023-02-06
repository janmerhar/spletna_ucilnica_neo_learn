<template>
  <div>
    <app-nav-bar :userData="userData"></app-nav-bar>
    <div class="container-fluid nav-odmik">
      <div class="row">
        <!-- levi del -->
        <div class="col-md-2 order-md-1 order-1">
          <!-- dodaj levo skatlo router view -->
          <router-view name="leva_skatla"></router-view>
        </div>
        <!-- sredinski del učilnice AKA main part -->
        <div class="col order-md-2 order-3">
          <router-view></router-view>
        </div>
        <!-- desni del -->
        <div class="col-md-2 order-md-3 order-2">
          <!-- dodaj desno skatlo router view -->
          <router-view name="desna_skatla"></router-view>
        </div>
      </div>
    </div>
    <app-footer></app-footer>
  </div>
</template>

<script>
import NavBar from './components/layout/NavBar.vue'
import Footer from './components/layout/Footer.vue'
import axios from 'axios'

export default {
    data() {
        return {
            userData: {
              username: '',
              isLogged: false,
            },
        }
    },
    components: {
        AppNavBar: NavBar,
        AppFooter: Footer
    },
    computed: {
      getToken() {
        return this.$store.getters.getToken
    },
    getUsername() {
      return this.$store.getters.getUsername
    },
    isLoggedIn() {
      const token = this.getToken

      if (token) {
        const jwt = this.parseJwt(token)

        const validTime = jwt.exp
        const currTime = parseInt(Date.now() / 1000)

        return validTime - currTime > 0
      }

      return false
    },
  },
    },
    watch: {
      getToken: (newToken, oldToken) => {
        if(newToken != oldToken)
          axios.defaults.headers.common['Authorization'] = newToken
      }
    },
}
</script>

<style></style>