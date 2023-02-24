<template>
  <div>
    <app-glava>{{ testIme }}</app-glava>
    <app-tabela :tabela="rezultati">Ni ocen za ogled</app-tabela>
  </div>
</template>

<script>
import axios from "axios"
import Glava from "../../../components/layout/Glava.vue"
import Tabela from "../../../components/ucilnica/Tabela.vue"

export default {
  data() {
    return {
      rezultati: {},
      testIme: "",
    }
  },
  components: {
    appGlava: Glava,
    appTabela: Tabela,
  },
  methods: {},
  created() {
    axios
      .post("ucilnice/testiocene/skrbniktesti.php", {
        ucilnica: this.$route.params.ucilnica,
        type: this.$route.params.testid,
      })
      .then((res) => {
        if (res.data.status == true) {
          this.testIme = res.data.ime_testa
          this.rezultati = res.data.tabela
        }
      })
  },
}
</script>

<style lang="scss" scoped></style>
