<template>
  <div>
    <div class="login mb-5">
      <h2>Registracija</h2>
      <div class="vnos">
        <input
          type="text"
          name="username"
          placeholder="Uporabniško ime"
          required
          pattern="[a-zA-Z0-9]+"
          id="username"
          v-model="formData.username"
        />

        <input
          type="text"
          name="ime"
          placeholder="Ime"
          required
          pattern="[a-zA-Z ]+"
          v-model="formData.ime"
        />

        <input
          type="text"
          name="priimek"
          placeholder="Priimek"
          required
          pattern="[a-zA-Z ]+"
          v-model="formData.priimek"
        />

        <input
          type="email"
          name="email1"
          placeholder="E-pošta"
          required
          v-model="formData.email1"
        />

        <input
          type="email"
          name="email2"
          placeholder="Ponovi e-pošto"
          required
          v-model="formData.email2"
        />

        <input
          type="password"
          name="geslo"
          placeholder="Geslo"
          required
          id="password"
          v-model="formData.password1"
        />
        <div class="mb-4">
          <div class="pwstrength_viewport_progress"></div>
        </div>
        <input
          type="password"
          name="geslo2"
          placeholder="Ponovi geslo"
          required
          v-model="formData.password2"
        />
      </div>
      <input type="submit" value="Registracija" @click="formSubmit()" />
    </div>

    <div
      class="modal fade"
      id="myModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document" id="napaka">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Opozorilo</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">Napaka pri vnosu podatkov!</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Zapri
            </button>
          </div>
        </div>
      </div>
    </div>
    <app-modal :modal="modal" @btn2="closeModal"></app-modal>
  </div>
</template>
<script>
import axios from "axios"
import Modal from "../../components/alerts/Modal.vue"

export default {
  data() {
    return {
      formData: {
        username: "",
        ime: "",
        priimek: "",
        email1: "",
        email2: "",
        password1: "",
        password2: "",
      },
      modal: {
        id: "register",
        header: "Registracija uspešna",
        body: "Na e-mail smo vam poslali potrditveno povezavo",
        btn2: {
          text: "OK",
        },
      },
    }
  },
  methods: {
    formSubmit() {
      if (
        this.formData.email1 == this.formData.email1 &&
        this.formData.password1 == this.formData.password2
      ) {
        axios
          .post("loginregister/loginregister.php", {
            isLogin: false,
            username: this.formData.username,
            ime: this.formData.ime,
            priimek: this.formData.priimek,
            email: this.formData.email1,
            password: this.formData.password1,
          })
          .then((data) => {
            console.log(data.data)
            // preverim ali je registracija uspešna in preusmerin na login
            // če regisracija uspe, opozori uporabnika o potrditvi računa
            if (data.data.status == true) {
              window.$("#register").modal("show")
            }
          })
          .catch((error) => console.log(error))
      }
    },
    closeModal() {
      window.$("#register").modal("hide")
    },
  },
  components: {
    appModal: Modal,
  },
}
</script>
