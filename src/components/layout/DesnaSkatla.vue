<template>
  <div
    class="container-fluid mt-md-5 mt-3 border-blue text-center"
    v-if="isAdmin"
  >
    <p class="text-center">Skrbnik</p>
    <ul class="list-group-flush">
      <li class="i list-group-item bg-greyish">
        <router-link :to="{ name: 'ustvari_test' }" class="link-black"
          >Ustvari test</router-link
        >
      </li>
      <li class="i list-group-item bg-greyish">
        <router-link class="link-black" :to="{ name: 'testi' }"
          >Ocene in testi</router-link
        >
      </li>
      <li class="i list-group-item bg-greyish">
        <router-link class="link-black" :to="{ name: 'uporabniki' }"
          >Pregled uporabnikov</router-link
        >
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
  beforeMount() {
    // ko je kreirana preveri, ali je uporabnik skrbnik
    let data = {
      username: this.$store.getters.getUsername,
      ucilnica: this.$store.getters.getUcilnica,
      type: "isAdmin",
    }
    axios.post("uporabnik/clanstvo.php", data).then((res) => {
      if (res.data.status == true)
        this.isAdmin = res.data.type == "admin" ? true : false
    })
  },
}
</script>
