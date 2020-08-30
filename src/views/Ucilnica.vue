<template>
  <div>
    <app-glava>{{ ucilnica }}</app-glava>
    <app-sklop-vsebina v-for="sklop in sklopi" :sklop="sklop" :key="sklop.sklop_id"></app-sklop-vsebina>
  </div>
</template>

<script>
import axios from 'axios'
import Glava from '../components/layout/Glava.vue'
import SklopVsebina from '../components/ucilnica/SklopVsebina.vue'
    export default {
        // dodaj še Vuex za preverjanje logina in skrbnika
      data() {
        return {
          sklopi: {},
        }
      },
      computed: {
        ucilnica() {
          return this.$store.getters.getUcilnica
        }
      },
      components: {
        appGlava: Glava,
        appSklopVsebina: SklopVsebina,
      },
      methods: {
        removeElement(id_sklopa, id_vsebine = false) {
          let sendData = {
            id_sklopa
          }
          if(id_vsebine !== false)
            sendData.id_vsebine = id_vsebine
          
          axios.post("ucilnice/vsebina/vsebinaremove.php", sendData)
          .then(response => console.log(response))
          .catch(err => console.log(err))
        }
      },
      created() {
        // spremenim ime učilnice 
        this.$store.commit('setUcilnica', this.$route.params.ucilnica)
        // prevzemi podatke iz učilnice
        axios.post('ucilnice/vsebina/vsebinaucilnice.php', {
          ucilnica: this.ucilnica
        })
        .then(response => {
          this.sklopi = response.data
        })
        .catch(error => console.log(error))
      }
    }
</script>

<style lang="scss" scoped>
</style>