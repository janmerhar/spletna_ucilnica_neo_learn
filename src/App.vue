<template>
  <div>
    <app-nav-bar
      :userData="{ username: getUsername, isLogged: isLoggedIn }"
    ></app-nav-bar>
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
import NavBar from "./components/layout/NavBar.vue"
import Footer from "./components/layout/Footer.vue"
import axios from "axios"

export default {
  components: {
    AppNavBar: NavBar,
    AppFooter: Footer,
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
  methods: {
    parseJwt(token) {
      return JSON.parse(Buffer.from(token.split(".")[1], "base64").toString())
    },

    regenerateToken() {
      axios.post("loginregister/refresh_token.php").then((data) => {
        // If there is an error,
        if (data.data.error) {
          // Redirect on login if there is no way to restore login
          if (this.$route.name != "login" && this.$route.name != "register") {
            this.$router.push({ name: "login" })
          }

          return
        }
        // There's no error an we receive new token
        else {
          const token = data.data.token
          const jwt_data = this.parseJwt(token)

          this.$store.commit("setUsername", jwt_data.username)
          this.$store.commit("setToken", token)

          axios.defaults.headers.common["Authorization"] = "Bearer " + token
        }
      })
    },

    checkToken() {
      const token = this.getToken

      // Token je podan
      if (token) {
        const jwt = this.parseJwt(token)

        const validTime = jwt.exp
        const currTime = parseInt(Date.now() / 1000)

        console.log(validTime - currTime)

        if (validTime - currTime > 0) {
          return
        }
      }
      console.log("konec veljavnosti tokena")
      this.regenerateToken()
    },
  },
  beforeCreate() {
    axios.defaults.headers.common["Authorization"] = "Bearer " + this.getToken
  },
  created() {
    setInterval(() => {
      this.checkToken()
    }, 500)
  },
}
</script>

<style></style>
