<template>
  <div>
    <app-glava>Pregled uporabnikov</app-glava>
    <app-tabela :tabela="uporabniki" @izbris="izbris"
      >Ni včlanjenih uporabnikov</app-tabela
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
      uporabniki: {},
    }
  },
  methods: {
    izbris(event) {
      axios
        .post("uporabnik/clanstvo.php", {
          type: "izbris",
          username: event,
          ucilnica: this.$route.params.ucilnica,
        })
        .then((res) => {
          console.log(res.data)
          if (res.data.status == true) {
            axios
              .post("uporabnik/vclanjeniuporabniki.php", {
                ucilnica: this.$route.params.ucilnica,
              })
              .then((res) => {
                if (res.data.status === true) {
                  this.uporabniki = res.data.tabela
                }
              })
          }
        })
    },
  },
  mounted() {
    axios
      .post("uporabnik/vclanjeniuporabniki.php", {
        ucilnica: this.$route.params.ucilnica,
      })
      .then((res) => {
        if (res.data.status === true) {
          this.uporabniki = res.data.tabela
        }
      })
  },
  components: {
    appTabela: Tabela,
    appGlava: Glava,
  },
}
</script>

<style lang="scss" scoped></style>
