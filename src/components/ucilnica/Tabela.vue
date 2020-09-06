<template>
  <div v-if="tabela.vsebina">
    <table class="table mt-3">
      <tr>
        <th
          scope="col"
          class="table-th"
          v-for="header in tabela.headers"
          :key="header"
        >
          {{ header }}
        </th>
      </tr>
      <tr v-for="(row, rowIndex) in tabela.vsebina" :key="rowIndex">
        <td v-for="(col, colIndex) in row" :key="rowIndex + '.' + colIndex">
          <p
            v-if="col.event"
            class="link-blue"
            @click="emitter(col.event.name, col.event.value)"
          >
            {{ col.text }}
          </p>
          <router-link class="lnk-blue" v-else-if="col.to" :to="col.to">
            {{ col.text }}
          </router-link>
          <template v-else>{{ col.text }}</template>
        </td>
      </tr>
    </table>
  </div>
  <div v-else>
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: ["tabela"],
  methods: {
    emitter(name, value) {
      this.$emit(name, value)
    },
  },
}
</script>

<style lang="scss" scoped></style>

<!-- 
    tabela {
        headers: [],
        vsebina: [
            [{text, param, path, event, eventName}],
        ],
    }
    dodaj še preverjanje, če so na voljo kakšni testi za reševanje
-->
