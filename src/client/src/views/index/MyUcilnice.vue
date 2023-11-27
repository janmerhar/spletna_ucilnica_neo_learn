<template>
  <div>
    <app-glava>Moje učilnice</app-glava>
    <app-card-collection
      :ucilnice="ucilnice"
      @vstop="
        (ucilnica) => $router.push({ name: 'ucilnica', params: { ucilnica } })
      "
    ></app-card-collection>
    <a href="#">
      <router-link tag="button" class="mb-5 mt-3 gumb" :to="{ name: 'new' }"
        >Ustvari učilnico</router-link
      >
    </a>
  </div>
</template>

<script>
import Glava from "../../components/layout/Glava.vue"
import CardCollection from "../../components/index/CardCollection.vue"
import axios from "axios"

export default {
  data: () => {
    return {
      ucilnice: null,
    }
  },
  components: {
    appCardCollection: CardCollection,
    appGlava: Glava,
  },
  computed: {
    getUsername() {
      return this.$store.getters.getUsername
    },
  },
  created() {
    this.$store.commit("setUcilnica", "")
    this.$store.commit("setSkrbnik", false)

    axios
      .post("ucilnice/ucilnice.php", {
        type: "my",
        username: this.$store.getters.getUsername,
      })
      .then((data) => {
        this.ucilnice = data.data.ucilnice
        this.$store.commit("setToken", data.data.token)
      })
      .catch((error) => console.log(error))
  },
}
</script>

<style lang="scss" scoped></style>
