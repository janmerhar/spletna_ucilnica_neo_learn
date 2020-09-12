<template>
  <div>
    <!-- naslov učilnice -->
    <app-glava>{{ ucilnica }}</app-glava>
    <!-- prikaz vsebine -->
    <div class="vsebina_sklopa" v-for="sklop in sklopi" :key="sklop.sklop_id">
      <p class="font-weight-bold text-uppercase">
        {{ sklop.ime_sklopa }}
        <button class="gumb-small" @click="removeElement(sklop.id_sklopa)">
          -
        </button>
      </p>
      <ul>
        <li
          v-for="list in sklop.vsebina"
          :key="sklop.id_sklopa + '.' + list.id_vsebine"
        >
          <template v-if="list.vrsta == 'text'">{{ list.besedilo }}</template>
          <template v-else-if="list.vrsta == 'image'">
            <img src="#" :alt="list.besedilo" width="25%" height="auto" />
          </template>
          <template v-else-if="list.vrsta == 'file'">
            <a href="#">{{ list.besedilo }}</a>
          </template>
          <button
            class="gumb-small"
            @click="removeElement(sklop.id_sklopa, list.id_vsebine)"
          >
            -
          </button>
        </li>
      </ul>
    </div>
    <!-- vnos nove vsebine -->
    <div class="vnos_podatkov mb-5">
      <div id="formdiv">
        <form
          action="php/insert_sklop.php"
          id="form"
          enctype="multipart/form-data"
          method="post"
          class="form"
        >
          <ul id="formul" class="list-style-none">
            <li id="ime_sklopa">
              <div class="input-group mt-4">
                <input
                  type="text"
                  name="ime_sklopa"
                  placeholder="Vnesite ime sklopa"
                  class="form-control"
                  aria-describedby="button-addon2"
                  v-model="vnosPodatkov.ime_sklopa"
                />
                <div class="input-group-append">
                  <input
                    type="submit"
                    class="btn btn-outline-info my-2 my-sm-0"
                    id="button-addon2"
                    value="Vnesi"
                    @click.prevent="vnosPB"
                  />
                </div>
              </div>
            </li>
            <li v-for="(polje, index) in vnosPodatkov.vsebina" :key="index">
              <input
                :type="polje.vrsta == 'text' ? 'text' : 'file'"
                required
                placeholder="Vnesite besedilo"
                class="width-large"
                v-model="vnosPodatkov.vsebina[index].vnos"
                :name="index + 1"
              />
              <button class="gumb-small" @click.prevent="odstraniPolje(index)">
                -
              </button>
            </li>
          </ul>
        </form>
        <div>
          <button id="text" class="gumb" @click="dodajPolje('text')">
            Besedilo
          </button>
          <button id="file" class="gumb" @click="dodajPolje('file')">
            Dokument
          </button>
          <button id="picture" class="gumb" @click="dodajPolje('image')">
            Slika
          </button>
        </div>
      </div>
    </div>
    <app-modal :modal="modal" @btn1="btn1" @btn2="btn2"></app-modal>
  </div>
</template>

<script>
import axios from "axios"
import Glava from "../../components/layout/Glava.vue"
import Modal from "../../components/alerts/Modal.vue"

export default {
  // dodaj še Vuex za preverjanje logina in skrbnika
  /*
          struktura za dodajanje podatkov
          vnosPodatkov {
            ime_sklopa,
            vsebina: [
              {
                vrsta, => text, file, image
                vnos
              },
            ]
          }

        */
  data() {
    return {
      sklopi: {},
      vnosPodatkov: {
        ime_sklopa: "",
        vsebina: [],
      },
      modal: {
        id: "input",
        header: "Napaka",
        body: "Vnos podatkov ni uspel",
        btn1: {
          text: "Poskusi ponovno",
        },
        btn2: {
          text: "OK",
        },
      },
    }
  },
  methods: {
    vnosPB() {
      // dobim podatke o datotekah
      const files = document.querySelectorAll("[type=file]")
      const texts = document.querySelectorAll("[type=text]")
      if (files.length + texts.length < 2) return
      const formData = new FormData()

      for (const file of files) {
        formData.append(file.name, file.files[0])
      }

      formData.append("ime_sklopa", texts[0].value)
      for (let i = 1; i < texts.length; i++) {
        formData.append("text[" + texts[i].name + "]", texts[i].value)
      }
      formData.append("ucilnica", this.$store.getters.getUcilnica)
      // uporabniško ime => kar na samem strežniku
      axios
        .post("ucilnice/vsebina/vsebinavnos.php", formData)
        .then((res) => {
          if (res.data.status === true) {
            // izpraznem celoten vnosni obrazec
            // še osveži podatke
            this.vnosPodatkov = {
              ime_sklopa: "",
              vsebina: [],
            }

            // ponovno prevzamem vsebino učilnice
            axios
              .post("ucilnice/vsebina/vsebinaucilnice.php", {
                ucilnica: this.ucilnica,
              })
              .then((response) => {
                this.sklopi = response.data
              })
          } else window.$("#input").modal("show")
        })
        .catch((err) => console.log(err))
    },
    dodajPolje(vrsta) {
      let polje = {
        vrsta,
        vnos: "",
      }

      this.vnosPodatkov.vsebina.push(polje)
    },
    odstraniPolje(index) {
      this.vnosPodatkov.vsebina.splice(index, 1)
    },
    removeElement(id_sklopa, id_vsebine = false) {
      let sendData = {
        id_sklopa,
      }

      if (id_vsebine !== false) sendData.id_vsebine = id_vsebine

      axios
        .post("ucilnice/vsebina/vsebinaremove.php", sendData)
        .then((response) => {
          if (response.data.status === true) {
            if (id_vsebine !== false) {
              for (const [index, sklop] of this.sklopi.entries()) {
                if (sklop.id_sklopa == id_sklopa) {
                  for (const [index2, vsebina] of this.sklopi[
                    index
                  ].vsebina.entries()) {
                    if (vsebina.id_vsebine == id_vsebine) {
                      this.sklopi[index].vsebina.splice(index2, 1)
                      // brisanje celotnega sklopa, če ne vsebuje vseh elementov
                      if (this.sklopi[index].vsebina.length === 0)
                        this.sklopi.splice(index, 1)
                    }
                  }
                }
              }
            } else {
              for (const [index, sklop] of this.sklopi.entries()) {
                if (sklop.id_sklopa == id_sklopa) {
                  this.sklopi.splice(index, 1)
                }
              }
            }
          }
        })
        .catch((err) => console.log(err))
    },
    btn1() {
      vnosPB()
      window.$("#input").modal("hide")
    },
    btn2() {
      window.$("#input").modal("hide")
    },
  },
  computed: {
    ucilnica() {
      return this.$store.getters.getUcilnica
    },
  },
  components: {
    appGlava: Glava,
    appModal: Modal,
  },
  created() {
    // spremenim ime učilnice
    this.$store.commit("setUcilnica", this.$route.params.ucilnica)
    // prevzemi podatke iz učilnice
    axios
      .post("ucilnice/vsebina/vsebinaucilnice.php", {
        ucilnica: this.$route.params.ucilnica,
      })
      .then((response) => {
        this.sklopi = response.data
      })
      .catch((error) => console.log(error))
  },
}
</script>

<style lang="scss" scoped></style>
