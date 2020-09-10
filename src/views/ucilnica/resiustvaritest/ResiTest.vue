<template>
  <div>
    <form>
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
      <button class="mb-5 mt-3 gumb" @click.prevent="oceniTest">
        Zaključi z reševanjem
      </button>
    </form>
  </div>
</template>

<script>
import axios from "axios"
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
  computed: {
    trajanjeTesta() {
      return parseInt(this.testi.trajanje)
    },
  },
  methods: {
    oceniTest() {
      /*
        --------- RegEx -------
        - 0 --> celo st
        - 1 --> levi del / vprasanje id
        - 2 --> desni del / odgovor id
      */
      const levoSt = /(\d+)\.(\d+)/

      // dobim checkboxe, ki so izbrani
      const checkboxi = document.querySelectorAll(
        "input[type=checkbox]:checked",
      )
      const formData = new FormData()

      formData.append("testid", this.$route.params.testid)
      formData.append("username", this.$store.getters.getUsername)
      formData.append("zacetek", this.testi.zacetek)
      // sprehodim se po vsebini checkboxov
      for (const node of checkboxi) {
        formData.append(
          "odgovori[" + levoSt.exec(node.name)[1] + "][]",
          levoSt.exec(node.name)[2],
        )
      }

      axios
        .post("ucilnice/testiocene/vrednotitest.php", formData)
        .then((res) => {
          console.log(res.data)
        })
    },
  },
  created() {
    axios
      .post("ucilnice/testiocene/resitest.php", {
        testid: this.$route.params.testid,
      })
      .then((res) => {
        if (res.data.status == true) this.testi = res.data
        this.$store.commit("setZacetek", this.testi.zacetek)
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
