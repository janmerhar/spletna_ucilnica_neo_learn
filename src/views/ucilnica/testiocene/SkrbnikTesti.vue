<template>
  <div>
    <app-glava>Pregled testov</app-glava>
    <app-tabela :tabela="testi">Ni testov za pregled</app-tabela>
  </div>
</template>

<script>
import axios from 'axios'
import Glava from '../../../components/layout/Glava.vue'
import Tabela from '../../../components/ucilnica/Tabela.vue'
    export default {
        data() {
            return {
                testi: {}
            }
        },
        components: {
            appGlava: Glava,
            appTabela: Tabela,
        },
        created() {
            axios.post("ucilnice/testiocene/skrbniktesti.php", {
                type: 'vsi',
                ucilnica: this.$store.getters.getUcilnica
            })
            .then(res => {
                if(res.data.status == true)
                    this.testi = res.data.tabela
            })
        }
    }
</script>

<style lang="scss" scoped>
</style>