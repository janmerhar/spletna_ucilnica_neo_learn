<template>
  <div class="container-fluid mt-md-5 mt-3 border-blue text-center">
    <p class="text-center">Uporabnik</p>
    <ul class="list-group-flush">
      <li class="i list-group-item bg-greyish">
        <router-link
          class="link-black"
          style="color: rgb(34, 40, 49); cursor: pointer"
          :to="{
            name: 'ucilnica',
            params: { ucilnica: $route.params.ucilnica },
          }"
          >Vsebina učilnice</router-link
        >
      </li>
      <li class="i list-group-item bg-greyish">
        <router-link
          class="link-black"
          style="color: rgb(34, 40, 49); cursor: pointer"
          :to="{ name: 'myocene' }"
          >Testi in ocene</router-link
        >
      </li>
      <!-- ni viden za skrbnika učilnice -->
      <li class="i list-group-item bg-greyish" v-if="!isAdmin">
        <p class="link-black" @click="izpis">Izpis iz učilnice</p>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios"

export default {
  data() {
    return {
      isAdmin: false,
    }
  },
  methods: {
    izpis() {
      let that = this
      if (!this.isAdmin) {
        let data = {
          username: this.$store.getters.getUsername,
          ucilnica: this.$route.params.ucilnica,
          type: "izbris",
        }

        axios.post("uporabnik/clanstvo.php", data).then((res) => {
          if (res.data.status == true) that.$router.push({ name: "index" })
        })
      }
    },
  },
  mounted() {
    let data = {
      username: this.$store.getters.getUsername,
      ucilnica: this.$route.params.ucilnica,
      type: "isAdmin",
    }

    axios.post("uporabnik/clanstvo.php", data).then((res) => {
      if (res.data.status == true)
        this.isAdmin = res.data.type == "admin" ? true : false
    })
  },
}
</script>
