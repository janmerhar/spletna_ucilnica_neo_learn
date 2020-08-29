<template>
  <div>
    <app-glava>Iskalnik učilnic</app-glava>
    <app-search-bar searchText="Iskanje učilnic"></app-search-bar>
    <p
      v-if="this.$route.query.search"
      class="mt-3"
    >Rezultati iskanja za {{ this.$route.query.search }}:</p>
    <app-card-collection :ucilnice="ucilnice"></app-card-collection>
    <a href="#">
      <router-link tag="button" class="mb-5 mt-3 gumb" :to="{ name: 'new' }">Ustvari učilnico</router-link>
    </a>
  </div>
</template>

<script>
    import Glava from '../../components/layout/Glava.vue'
    import SearchBar from '../../components/layout/SearchBar.vue'
    import CardCollection from '../../components/index/CardCollection.vue'
    import axios from 'axios'

    export default {
        data: () => {
            return {
                ucilnice: null
            }
        },
        components: {
            appGlava: Glava,
            appSearchBar: SearchBar,
            appCardCollection: CardCollection
        },
        created() {
            let vrsta = 'all'
            // spremeni iskanje
            if(this.$route.query.search)
                vrsta = 'search'
            axios.post('ucilnice/ucilnice.php', {
                type: vrsta,
                niz: this.$route.query.search
            })
            .then(data => this.ucilnice = data.data)
            .catch(error => console.log(error))
        }
    }
</script>

<style>
</style>