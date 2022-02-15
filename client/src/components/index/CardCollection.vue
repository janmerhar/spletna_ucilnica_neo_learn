<template>
  <div class="row row-cols-sm-2 row-cols-lg-3 row-cols-1 m-0">
    <template v-for="ucilnica in ucilnice">
      <app-card :ucilnica="ucilnica" :key="ucilnica.ime"></app-card>
    </template>
  </div>
</template>

<script>
    import Card from './Card.vue'
    // dodaj še način, ko je vnesen iskalni niz
    export default {
        props: ['ucilnice'],
        components: {
            appCard: Card
        }

    }
</script>

<style lang="scss" scoped>
</style>