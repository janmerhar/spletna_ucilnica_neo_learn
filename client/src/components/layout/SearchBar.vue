<template>
  <div class="input-group mt-4">
    <input
      type="text"
      class="form-control"
      :placeholder="searchText"
      name="search"
      aria-label="Recipient's username"
      aria-describedby="button-addon2"
      v-model="iskaniNiz"
    />
    <div class="input-group-append">
      <input
        type="button"
        class="btn btn-outline-info my-2 my-sm-0"
        id="button-addon2"
        :value="buttonText"
      />
    </div>
  </div>
</template>

<script>
    // manjka še event, ko kliknem na gumb za iskanje
    export default {
        data: () => {
            return {
                iskaniNiz: ''
            }
        },
        props: {
            buttonText: {
                type: String,
                default: 'Išči'
            },
            searchText: {
                type: String,
                default: 'Vnesite iskalni niz'
            }
        }
        
    }
</script>

<style lang="scss" scoped>
</style>