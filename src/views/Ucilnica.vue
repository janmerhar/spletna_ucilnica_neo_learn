<template>
  <div>
    <app-glava>{{ ucilnica }}</app-glava>
    <div class="vsebina_sklopa" v-for="sklop in sklopi" :key="sklop.sklop_id">
      <p>
        {{ sklop.ime_sklopa }}
        <button class="gumb-small" @click="removeElement(sklop.id_sklopa)">-</button>
      </p>
      <!-- dodaj @click za brisanje sklopa -->
      <ul>
        <li v-for="list in sklop.vsebina" :key="sklop.id_sklopa + '.' + list.id_vsebine">
          {{ list.besedilo }}
          <button
            class="gumb-small"
            @click="removeElement(sklop.id_sklopa, list.id_vsebine)"
          >-</button>
          <!-- dodaj @click za brisanje vsebine -->
          <!-- preveri tip podatka in ugotovi, ali boš dal link, text ali sliko => method() -->
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Glava from '../components/layout/Glava.vue'

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
      },
      methods: {
        removeElement(id_sklopa, id_vsebine = false) {
          let sendData = {
            id_sklopa
          }

          if(id_vsebine !== false) 
            sendData.id_vsebine = id_vsebine
          
          /*
          axios.post("ucilnice/vsebina/vsebinaremove.php", sendData)
          .then(response => console.log(response))
          .catch(err => console.log(err))
          */

          if(id_vsebine !== false) {
           for(const [index, sklop] of this.sklopi.entries()) {
              if(sklop.id_sklopa == id_sklopa) {
                for(const [index2, vsebina] of this.sklopi[index].vsebina.entries()) {
                  if(vsebina.id_vsebine == id_vsebine) {
                    console.log(vsebina.id_vsebine)
                    this.sklopi[index].vsebina.splice(index2, 1)
                  }
                }
              }
            }
          }
          else {
            for(const [index, sklop] of this.sklopi.entries()) {
              if(sklop.id_sklopa == id_sklopa) {
                console.log(index)
                this.sklopi.splice(index, 1)
                break
              }
            }
          }
          
          
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