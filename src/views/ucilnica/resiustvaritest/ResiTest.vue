<template>
  <div>
    <!-- ime testa -->
    <app-glava>{{ testi.ime_testa }}</app-glava>
    <!-- countdown  čudno dela, popravi-->
    <app-countdown :cas="testi.trajanje"></app-countdown>
    <!-- vprašanja in odgovori testa -->

    <app-check-box
      v-for="(vsebina, index) in testi.vsebina"
      :key="index"
      :vsebina="vsebina"
    >
    </app-check-box>

    <!-- gumb za ocenjevanje testa -->
    <button class="mb-5 mt-3 gumb">Zaključi z reševanjem</button>
  </div>
</template>

<script>
import axios from "axios"
import Glava from "../../../components/layout/Glava.vue"
import CheckBox from "../../../components/ucilnica/CheckBox.vue"
// popravi/prepiši countdown
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
  computed: {
    trajanjeTesta() {
      return parseInt(this.testi.trajanje)
    },
  },
  created() {
    axios
      .post("ucilnice/testiocene/resitest.php", {
        testid: this.$route.params.testid,
      })
      .then((res) => {
        if (res.data.status == true) this.testi = res.data
        console.log(this.testi)
      })
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
