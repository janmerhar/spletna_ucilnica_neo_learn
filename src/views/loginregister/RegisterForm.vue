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

        <input type="email" name="email1" placeholder="E-pošta" required v-model="formData.email1" />

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
          v-model="formData.password2 "
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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Opozorilo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">Napaka pri vnosu podatkov!</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
          </div>
        </div>
      </div>
    </div>
    <!-- $('#myModal').modal('show') -->
  </div>
</template>

<!-- pozneje dodelaj / popravi
<script src="node_modules/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
jQuery(document).ready(function () {
    "use strict";
    var options = {};
    options.ui = {
        viewports: {
            progress: ".pwstrength_viewport_progress"
        },
        showVerdictsInsideProgressBar: true
    };
    options.common = {
        debug: true,
        onLoad: function () {
            $('#messages').text('Start typing password');
        }
    };
    $('#password').pwstrength({
        ui: { showVerdictsInsideProgressBar: true }
    });
});
-->
<script>
import axios from 'axios'

export default {
    data() {
      return {
        formData: {
          username: '',
          ime: '',
          priimek: '',
          email1: '',
          email2: '',
          password1: '',
          password2: ''
        }
      }
    },
    methods: {
      formSubmit() {
        if((this.formData.email1 == this.formData.email1) && (this.formData.password1 == this.formData.password2)) {
          axios.post('loginregister/loginregister.php', {
            isLogin: false,
            username: this.formData.username,
            ime: this.formData.ime,
            priimek: this.formData.priimek,
            email: this.formData.email1,
            password: this.formData.password1,
          })
          .then(data => {
            console.log(data.data)
            // shrani token v Vuex
          })
          .catch(error => console.log(error))
        }
      }
    }
}
</script>