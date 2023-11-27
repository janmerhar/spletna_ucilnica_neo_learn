<template>
  <div class="mb-3">
    <p class="font-weight-bold">{{ vsebina.naslov }}</p>

    <div v-for="(checkbox, index) in vsebina.checkboxi" :key="index">
      <input
        type="checkbox"
        :key="checkbox.name + '.' + checkbox.value"
        :name="checkbox.name + '.' + checkbox.value"
      />
      &nbsp; {{ checkbox.besedilo }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["vsebina"],
}
</script>

<style lang="scss" scoped></style>

<!-- 

  {
    ime_testa,
    trajanje,
    zacetek,
    vsebina: [
    ----------------------
      {
        naslov, => samo vprašanje
        checkboxi: [
            {
                besedilo,
                name => HTML atribut, -> idvprasanja
                value => HTML atribut
            },
        ]
      },
    ----------------------
    ]
  }

-->
