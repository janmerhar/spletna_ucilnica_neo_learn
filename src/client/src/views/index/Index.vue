<template>
  <div>
    <app-glava>Iskalnik učilnic</app-glava>
    <app-search-bar
      searchText="Iskanje učilnic"
      @search="(iskaniNiz) => searchUcilnica(iskaniNiz)"
    ></app-search-bar>
    <app-card-collection
      :ucilnice="ucilnice"
      @vstop="(ucilnica) => ucilnicaFormKlic(ucilnica)"
    ></app-card-collection>
    <a href="#">
      <router-link tag="button" class="mb-5 mt-3 gumb" :to="{ name: 'new' }"
        >Ustvari učilnico</router-link
      >
    </a>
    <!-- MODAL -->
    <div
      class="modal fade"
      id="vnos"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Vstop v učilnico
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Geslo</span>
              </div>
              <input
                type="password"
                class="form-control"
                placeholder=""
                aria-label="Username"
                aria-describedby="basic-addon1"
                v-model="geslo"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Prekliči
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="ucilnicaVstop"
            >
              Vstopi
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Glava from "../../components/layout/Glava.vue"
import SearchBar from "../../components/layout/SearchBar.vue"
import CardCollection from "../../components/index/CardCollection.vue"
import axios from "axios"

export default {
  data: () => {
    return {
      ucilnice: [],
      izbranaUcilnica: "",
      geslo: "",
    }
  },
  components: {
    appGlava: Glava,
    appSearchBar: SearchBar,
    appCardCollection: CardCollection,
  },
  methods: {
    searchUcilnica(iskaniNiz) {
      axios
        .post("ucilnice/ucilnice.php", {
          type: "search",
          niz: iskaniNiz,
        })
        .then((data) => {
          this.ucilnice = data.data.ucilnice
        })
        .catch((error) => console.log(error))
    },
    ucilnicaFormKlic(ucilnica) {
      this.izbranaUcilnica = ucilnica
      const ucilnicaData = this.ucilnice.filter((el) => el.ime == ucilnica)[0]
      console.log(ucilnicaData)

      if (ucilnicaData.isJavna == true) {
        this.ucilnicaVstop()
      } else if (
        ucilnicaData.isJavna != true &&
        ucilnicaData.isJoined != true
      ) {
        window.$("#vnos").modal("show")
      } else {
        this.$router.push({
          name: "ucilnica",
          params: { ucilnica: ucilnica },
        })
      }
    },
    ucilnicaVstop() {
      axios
        .post("uporabnik/clanstvo.php", {
          type: "vclani",
          ucilnica: this.izbranaUcilnica,
          kljuc: this.geslo,
        })
        .then((res) => {
          console.log(res.data)
          // Pravilno geslo => naredim router skok
          if (res.data.status == true) {
            window.$("#vnos").modal("hide")
            this.$router.push({
              name: "ucilnica",
              params: { ucilnica: this.izbranaUcilnica },
            })
          }
        })
    },
  },
  created() {
    this.searchUcilnica("")
  },
}
</script>

<style></style>
