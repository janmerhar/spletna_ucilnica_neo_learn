<template>
  <div>
    <app-glava>Ustvari test</app-glava>
    <!-- header elementi OZ: info o testu-->
    <div
      class="row row-cols-xl-4 row-cols-md-2 row-cols-1 mt-2 no-gutters mb-3"
    >
      <div class="col">
        <input
          type="text"
          name="ime"
          placeholder="Ime testa"
          required=""
          class="width-100"
          pattern="[a-žA-Ž0-9 ]+"
          v-model="test.ime_testa"
        />
      </div>
      <div class="col">
        <input
          type="number"
          placeholder="Število vprašanj na testu"
          required=""
          class="width-100"
          min="2"
          step="1"
          name="stvprasanj"
          v-model="test.st_vprasanj"
        />
      </div>
      <div class="col">
        <input
          type="number"
          name="trajanje"
          placeholder="Trajanje testa"
          required=""
          class="width-100"
          min="1"
          step="1"
          v-model="test.trajanje"
        />
      </div>
      <div class="col">
        <button class="gumb-small float-right">
          Potrdi vnos
        </button>
      </div>
    </div>
    <!-- začetek dela z vprašanji -->
    <ul class="list-style-none">
      <div
        v-for="(vprasanje, index) in test.vprasanja"
        :key="index"
        class="mb-3"
      >
        <!-- polje za vnos vprašanja -->
        <input
          type="text"
          :name="'vprasanje' + index"
          required=""
          :placeholder="'Vprašanje' + (index + 1)"
          class="width-100"
          v-model="test.vprasanja[index].vprasanje"
        />
        <!-- polja za vnos odgovorov -->
        <li
          v-for="(odgovor, indexOdg) in vprasanje.odgovori"
          :key="index + '.' + indexOdg"
          class="mb-1"
        >
          <div class="input-group mt-2 width-large">
            <input
              type="text"
              :name="'odg' + (index + 1) + '.' + (indexOdg + 1)"
              required=""
              :placeholder="'Odgovor' + (indexOdg + 1)"
              class="form-control"
              v-model="test.vprasanja[index].odgovori[indexOdg].odgovor"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                DA<input
                  type="radio"
                  :name="'radio' + (index + 1) + '.' + (indexOdg + 1)"
                  required=""
                  :value="true"
                  v-model="test.vprasanja[index].odgovori[indexOdg].isTrue"
                />NE<input
                  type="radio"
                  :name="'radio' + (index + 1) + '.' + (indexOdg + 1)"
                  required=""
                  :value="false"
                  v-model="test.vprasanja[index].odgovori[indexOdg].isTrue"
                />
              </div>
            </div>
            <button class="gumb-minus">-</button>
          </div>
        </li>
        <button class="gumb-small">Dodaj odgovor</button>
      </div>
    </ul>
  </div>
</template>

<script>
// import axios from "axios"
import Glava from "../../../components/layout/Glava.vue"

export default {
  data() {
    return {
      test: {
        ime_testa: "",
        st_vprasanj: null,
        trajanje: null,
        vprasanja: [
          {
            vprasanje: null,
            odgovori: [
              {
                odgovor: null,
                isTrue: null,
              },
              {
                odgovor: null,
                isTrue: null,
              },
            ],
          },
          {
            vprasanje: null,
            odgovori: [
              {
                odgovor: null,
                isTrue: null,
              },
              {
                odgovor: null,
                isTrue: null,
              },
            ],
          },
        ],
      },
    }
  },
  components: {
    appGlava: Glava,
  },
}
</script>

<style lang="scss" scoped></style>
