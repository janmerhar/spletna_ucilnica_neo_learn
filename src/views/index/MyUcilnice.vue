<template>
  <div>
    <app-glava>Moje učilnice</app-glava>
    <app-card-collection :ucilnice="ucilnice"></app-card-collection>
    <a href="#">
      <router-link tag="button" class="mb-5 mt-3 gumb" :to="{ name: 'new' }">Ustvari učilnico</router-link>
    </a>
  </div>
</template>

<script>
import Glava from '../../components/layout/Glava.vue'
import CardCollection from '../../components/index/CardCollection.vue'
import axios from 'axios'

  export default {
      data: () => {
          return {
              ucilnice: null
          }
      },
      components: {
        appCardCollection: CardCollection,
        appGlava: Glava
      },
      created() { 
        axios.post('ucilnice/ucilnice.php', {
            type: 'my',
            username: 'merjan' // dobim iz tokena ??? oz. PHP sam določi
        })
        .then(data => this.ucilnice = data.data)
        .catch(error => console.log(error))
      }
  }
</script>

<style lang="scss" scoped>
</style>