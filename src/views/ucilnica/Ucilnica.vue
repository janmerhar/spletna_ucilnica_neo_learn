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
    <div class="vnos_podatkov mb-5" v-if="isAdmin">
      <div id="formdiv">
        <!--  -->
        <form
          id="form"
          enctype="multipart/form-data"
          method="post"
          class="form"
        >
          <ul id="formul" class="list-style-none">
            <!-- POIMENOVANJE SKLOPA -->
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
            <!-- VNOS PODATKOV -->
            <li v-for="(polje, index) in vnosPodatkov.vsebina" :key="index">
              <template v-if="polje.vrsta == 'text'">
              <input
                  type="text"
                placeholder="Vnesite besedilo"
                class="width-large"
                v-model="vnosPodatkov.vsebina[index].vnos"
                :name="index + 1"
              />
              </template>
              <template v-else>
                <input
                  type="file"
                  value=""
                  class="width-large"
                  :name="index + 1"
                  ref="file"
                />
              </template>
              <button
                class="gumb-small"
                @click.prevent="odstraniPolje(index)"
                v-if="isAdmin"
              >
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
  data() {
    return {
      sklopi: [],
      vnosPodatkov: {
        ime_sklopa: "",
        vsebina: [],
      },
      isAdmin: false,
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
    getVsebina() {
      axios
        .post("ucilnice/vsebina/vsebinaucilnice.php", {
          ucilnica: this.$route.params.ucilnica,
        })
        .then((response) => {
          delete response.data.token
          this.sklopi = response.data
        })
        .catch((error) => console.log(error))
    },

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
      formData.append("ucilnica", this.ucilnica)
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
            this.getVsebina()
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
        .then(() => {
          this.getVsebina()
        })
        .catch((err) => console.log(err))
    },
    btn1() {
      this.vnosPB()
      window.$("#input").modal("hide")
    },
    btn2() {
      window.$("#input").modal("hide")
    },

    preveriClanstvo() {
      let data = {
        username: this.$store.getters.getUsername,
        ucilnica: this.ucilnica,
        type: "isAdmin",
      }
      axios.post("uporabnik/clanstvo.php", data).then((res) => {
        if (res.data.status == true)
          this.isAdmin = res.data.type == "admin" ? true : false
      })
    },
  },
  computed: {
    ucilnica() {
      return this.$route.params.ucilnica
    },
  },
  components: {
    appGlava: Glava,
    appModal: Modal,
  },
  created() {
    this.preveriClanstvo()
    this.getVsebina()
  },
}
</script>

<style lang="scss" scoped></style>
