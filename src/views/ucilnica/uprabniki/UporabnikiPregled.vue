<template>
  <div>
    <app-glava>Pregled uporabnikov</app-glava>
    <app-tabela :tabela="uporabniki">Ni včlanjenih uporabnikov</app-tabela>
  </div>
</template>

<script>
import axios from 'axios'
import Glava from '../../../components/layout/Glava.vue'
import Tabela from '../../../components/ucilnica/Tabela.vue'

    export default {
        data() {
            return {
                uporabniki: {} 
            }
        },
        mounted() {
            axios.post("uporabnik/vclanjeniuporabniki.php", {
                ucilnica: this.$store.getters.getUcilnica
            })
            .then(res => {
                if(res.data.status === true) {
                    this.uporabniki = res.data.tabela
                }
            })
        },
        components: {
            appTabela: Tabela,
            appGlava: Glava
        }
    }
</script>

<style lang="scss" scoped>
</style>