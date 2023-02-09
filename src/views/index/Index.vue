<template>
  <div>
    <app-glava>Iskalnik učilnic</app-glava>
    <app-search-bar searchText="Iskanje učilnic"></app-search-bar>
    <p v-if="this.$route.query.search" class="mt-3">
      Rezultati iskanja za {{ this.$route.query.search }}:
    </p>
    <app-card-collection :ucilnice="ucilnice"></app-card-collection>
    <a href="#">
      <router-link tag="button" class="mb-5 mt-3 gumb" :to="{ name: 'new' }"
        >Ustvari učilnico</router-link
      >
    </a>
  </div>
</template>

<script>
import Glava from "../../components/layout/Glava.vue"
import SearchBar from "../../components/layout/SearchBar.vue"
import CardCollection from "../../components/index/CardCollection.vue"
import axios from "axios"

export default {
  data: () => {
    return {
      ucilnice: [],
    }
  },
  components: {
    appGlava: Glava,
    appSearchBar: SearchBar,
    appCardCollection: CardCollection,
  },
  methods: {
    searchUcilnica(iskaniNiz) {
    axios
      .post("ucilnice/ucilnice.php", {
          type: "search",
          niz: iskaniNiz,
      })
      .then((data) => {
        this.ucilnice = data.data.ucilnice
      })
      .catch((error) => console.log(error))
    },
  },
  created() {
    this.searchUcilnica("")
  },
}
</script>

<style></style>
