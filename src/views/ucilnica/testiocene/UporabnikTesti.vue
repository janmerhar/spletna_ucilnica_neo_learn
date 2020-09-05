<template>
  <div>
    <app-tabela :tabela="nereseniTesti"></app-tabela>karneki test za uporabnikove testiocene
  </div>
</template>

<script>
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