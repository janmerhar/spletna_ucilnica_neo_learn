<template>
  <div>
    <app-glava>Pregled testov</app-glava>
    <app-tabela :tabela="testi" @vidnost="vidnost"
      >Ni testov za pregled</app-tabela
    >
  </div>
</template>

<script>
import axios from "axios"
import Glava from "../../../components/layout/Glava.vue"
import Tabela from "../../../components/ucilnica/Tabela.vue"
export default {
  data() {
    return {
      testi: {},
    }
  },
  components: {
    appGlava: Glava,
    appTabela: Tabela,
  },
  methods: {
    vidnost(event) {
      /*
      for (let i = 0; i < this.testi.vsebina.length; i++) {
        // console.log(this.testi.vsebina[i][3])
        // console.log(this.testi.vsebina[i][3].event) // id, vidnost
        if (this.testi.vsebina[i][3].event.id == event.id) {
          this.testi.vsebina[i][3].event.vidnost =
            this.testi.vsebina[i][3].event.vidnost == "ja" ? "ne" : "ja"
        }
        // console.log(this.testi.vsebina[i][3].text)
      }
      */
      const that = this
      axios
        .post("ucilnice/testiocene/spremenividnost.php", {
          test_id: event.id,
          vidnost: event.vidnost,
        })
        .then((res) => {
          if (res.data.status == true) {
            for (let i = 0; i < that.testi.vsebina.length; i++) {
              if (that.testi.vsebina[i][3].event.value.id == event.id) {
                console.log(this.testi.vsebina[i][3].event.value.vidnost)
                this.testi.vsebina[i][3].event.value.vidnost =
                  this.testi.vsebina[i][3].event.value.vidnost == "ja"
                    ? "ne"
                    : "ja"
                console.log(this.testi.vsebina[i][3].text)
                this.testi.vsebina[i][3].text =
                  this.testi.vsebina[i][3].text == "JA" ? "NE" : "JA"
                break
              }
            }
          }
        })
    },
  },
  created() {
    axios
      .post("ucilnice/testiocene/skrbniktesti.php", {
        type: "vsi",
        ucilnica: this.$store.getters.getUcilnica,
      })
      .then((res) => {
        if (res.data.status == true) this.testi = res.data.tabela
      })
  },
}
</script>

<style lang="scss" scoped></style>
