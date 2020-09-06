<template>
  <div>
    <!-- ime testa -->
    <app-glava>Reši test</app-glava>
    <!-- countdown -->
    <app-countdown :cas_minute="15"></app-countdown>
    <!-- vprašanja in odgovori testa -->
    <app-check-box></app-check-box>
    <!-- gumb za ocenjevanje testa -->
    <input
      type="submit"
      value="Zaključi z reševanjem"
      id="ustvari_test"
      class="mb-5 mt-3 gumb"
    />
  </div>
</template>

<script>
// dodaj countdown
// import axios from "axios"
import Glava from "../../../components/layout/Glava.vue"
import CheckBox from "../../../components/ucilnica/CheckBox.vue"
import Countdown from "../../../components/ucilnica/Countdown.vue"

export default {
  // test_id = this.$route.params.testid
  // dodaj v store id testa
  data() {
    // mogoče naredim v-model za izbrane rešitve in kar takega pošljem preko AXIOSa
    return {
      testi: {},
    }
  },
  components: {
    appGlava: Glava,
    appCheckBox: CheckBox,
    appCountdown: Countdown,
  },
}
</script>

<style lang="scss" scoped></style>

<!-- 

  {
    ime_testa,
    trajanje,
    zacetek,
    ----------------------
    vsebina: [
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
    ]
    ----------------------
  }

-->
