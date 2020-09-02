<template>
  <div class="create">
    <p class="h3">Ustvari učilnico</p>
    <form>
      <!-- select za kategorijo -->
      <select v-model="kategorija" required>
        <option disabled value>Izberite kategorijo</option>
        <template v-for="kategorija in kategorije">
          <option :key="kategorija">{{ kategorija }}</option>
        </template>
      </select>
      <br />
      <input
        class="create"
        type="text"
        name="imeucilnice"
        required
        placeholder="Ime učilnice"
        v-model="imeUcilnice"
      />
      <br />Zasebna učilnica:
      DA
      <input
        type="radio"
        name="zaseben"
        value="true"
        v-model="isJavna"
        required
      />
      NE
      <input type="radio" name="zaseben" value="false" v-model="isJavna" checked />
      <br />
      <template v-if="javnaUcilnica">
        <input
          name="geslo"
          class="create"
          id="pass"
          type="password"
          placeholder="Geslo učilnice"
          v-model="geslo"
        />
      </template>
      <br />
      <input type="submit" value="Potrdi" @click.prevent="createUcilnica" />
    </form>
  </div>
</template>

<script>
import axios from 'axios'
    export default {
        data() {
            return {
                isJavna: "false",
                kategorije: [],
                kategorija: '',
                geslo: '',
                imeUcilnice: ''
            }
        },
        computed: {
            javnaUcilnica() {
                return this.isJavna == "true" ? true : false;
            }
        },
        methods: {
          createUcilnica() {
            let sendData = {
              kategorija: this.kategorija,
              imeUcilnice: this.imeUcilnice,
              isJavna: this.javnaUcilnica == true ? "javna" : "zasebna"
            }
            if(this.javnaUcilnica == true)
              sendData.geslo = this.geslo
            console.log(sendData)

            axios.post("/ucilnice/adducilnica/adducilnica.php", sendData)
            .then(res => {
              console.log(res.data.status)
              if(res.data.status == true)
                this.$router.push({
                  name: "ucilnica",
                  params: {
                    ucilnica: this.ucilnica
                  },
                })
            })
          }
        },
        created() {
            // pridobi vse kategorije
            axios.get("/kategorije.php")
            .then(res => this.kategorije = res.data)
            .catch(error => console.log(error))
        }
    }
</script>

<style lang="scss" scoped>
</style>