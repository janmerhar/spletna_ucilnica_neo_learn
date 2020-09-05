<template>
  <div>
    <app-glava>Pregled testov</app-glava>
    <app-tabela :tabela="nereseniTesti">Ni testov za reševanje</app-tabela>
    <app-tabela :tabela="reseniTesti">Ni testov za reševanje</app-tabela>
  </div>
</template>

<script>
import Glava from '../../../components/layout/Glava.vue'
import Tabela from '../../../components/ucilnica/Tabela.vue'
import axios from 'axios'
    export default {
        data() {
            return {
                nereseniTesti: {},
                reseniTesti: {},
            }
        },
        components: {
            appTabela: Tabela,
            appGlava: Glava
        },
        created() {
            axios.post("ucilnice/testiocene/uporabniktesti.php", {
                type: 'nereseni',
                ucilnica: this.$store.state.ucilnica,
                username: this.$store.state.username,
            })
            .then(res => {
                if(res.data.status == true) {
                    this.nereseniTesti = res.data.tabela
                }
            })

            axios.post("ucilnice/testiocene/uporabniktesti.php", {
                type: 'reseni',
                ucilnica: this.$store.state.ucilnica,
                username: this.$store.state.username,
            })
            .then(res => {
                if(res.data.status == true) {
                    this.reseniTesti = res.data.tabela
                }
            })
        }
    }
</script>

<style lang="scss" scoped>
</style>

<!-- 
    tabela {
        headers: [],
        path_name: ''
        vsebina: [
            [{text, param}],
        ],
    }
    dodaj še preverjanje, če so na voljo kakšni testi za reševanje
-->