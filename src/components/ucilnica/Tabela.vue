<template>
  <!-- 
  <div v-if="!tabela.empty">
  -->
  <table class="table mt-3">
    <tr>
      <th scope="col" class="table-th" v-for="header in tabela.headers" :key="header">{{ header }}</th>
    </tr>
    <tr v-for="(row, rowIndex) in tabela.vsebina" :key="rowIndex">
      <td v-for="(col, colIndex) in row" :key="rowIndex + '.' + colIndex">
        <a href="#" v-if="col.link">{{ col.text }}</a>
        <template v-else>{{ col.text }}</template>
      </td>
    </tr>
  </table>
  <!--
  </div>
  <div v-else>{{ tabela.empty }}</div>
  -->
</template>

<script>
    export default {
        props: ['tabela'],

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