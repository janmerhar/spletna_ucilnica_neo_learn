<template>
  <div class="create">
    <p class="h3">Ustvari učilnico</p>
    <form action="php/adducilnica.php" method="post">
      <!-- select za kategorijo -->
      <select name="kategorija">
        <template v-for="kategorija in kategorije">
          <option :value="kategorija" :key="kategorija">{{ kategorija }}</option>
        </template>
      </select>
      <br />
      <input class="create" type="text" name="imeucilnice" required placeholder="Ime učilnice" />
      <br />Zasebna učilnica:
      DA
      <input type="radio" name="zaseben" value="true" v-model="isJavna" />
      NE
      <input type="radio" name="zaseben" value="false" v-model="isJavna" checked />
      <br />
      <template v-if="javnaUcilnica">
        <input name="geslo" class="create" id="pass" type="password" placeholder="Geslo učilnice" />
      </template>
      <br />
      <input type="submit" value="Potrdi" />
    </form>
  </div>
</template>

<script>
import axios from 'axios'
    export default {
        data() {
            return {
                isJavna: "false",
                kategorije: []
            }
        },
        computed: {
            javnaUcilnica() {
                return this.isJavna == "true" ? true : false;
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