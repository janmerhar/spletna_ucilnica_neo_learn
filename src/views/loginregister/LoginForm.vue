<template>
  <div>
    <div class="login">
      <h2>Prijava</h2>
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
          type="password"
          name="password"
          placeholder="Geslo"
          required
          id="password"
          v-model="formData.geslo"
        />
      </div>
      <input type="submit" value="Prijavi se!" @click="submitLogin()" />
    </div>
    <app-modal :modal="modal" @btn2="closeModal('error')"></app-modal>
    <app-modal :modal="verify" @btn2="closeModal('verify')"></app-modal>
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
        geslo: "",
      },
      modal: {
        id: "error",
        header: "Napaka pri prijavi",
        body: "Poskusite ponovno",
        btn2: {
          text: "OK",
        },
      },
      verify: {
        id: "verify",
        header: "Uporabniški račun ni potrjen",
        body: "Potrditev svoj uporabniški račun in poskusite ponovno",
        btn2: {
          text: "OK",
        },
      },
    }
  },
  methods: {
    submitLogin() {
      axios
        .post("loginregister/loginregister.php", {
          isLogin: true,
          username: this.formData.username,
          password: this.formData.geslo,
        })
        .then((data) => {
          if (data.data.status == true) {
            let userData = data.data
            this.$store.commit("setUsername", userData.username)
            this.$store.commit("setLogin", userData.status)
            this.$store.commit("setToken", userData.token)

            axios.defaults.headers.common["Authorization"] =
              "Bearer " + userData.token

            this.$router.push({
              name: "index",
            })
          } else if (data.data.status == "verify_account")
            window.$("#verify").modal("show")
          else window.$("#error").modal("show")
        })
        .catch((error) => console.log(error))
    },
    closeModal(id) {
      window.$("#" + id).modal("hide")
    },
  },
  components: {
    appModal: Modal,
  },
}
</script>
