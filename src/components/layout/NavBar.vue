<template>
  <nav class="navbar navbar-expand-md navbar-dark nav-bg fixed-top">
    <router-link :to="{ name: 'index'}" class="navbar-brand nav-font-color">
      <img src="/images/logo.svg" width="30" height="30" class="d-inline-block align-top" />
      Neo learn
    </router-link>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarTogglerDemo02"
      aria-controls="navbarTogglerDemo02"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mx-auto">
        <template v-if="isLogged">
          <li class="nav-item active">
            <router-link class="nav-link nav-font-color underline" :to="{ name: 'index' }">Učilnice</router-link>
          </li>
          <li class="nav-item active">
            <router-link
              :to="{ name: 'my' }"
              class="nav-link nav-font-color underline"
              href="#"
            >Moje učilnice</router-link>
          </li>
        </template>
      </ul>
      <template v-if="isLogged">
        <a href="#" class="btn btn-outline-info my-2 my-sm-0 ml-1">{{ getUsername }} (odjava)</a>
      </template>
      <template v-else>
        <router-link :to="{name: 'login'}" class="btn btn-outline-info my-2 my-sm-0 ml-1">Prijava</router-link>
        <router-link
          :to="{name: 'register'}"
          class="btn btn-outline-info my-2 my-sm-0 ml-1"
        >Registracija</router-link>
      </template>
    </div>
  </nav>
</template>

<script>
export default {
    computed: {
      isLogged() {
        return this.$store.getters.getLogin
      },
      getUsername() {
        return this.$store.getters.getUsername
      }
    }
}
</script>

<style scoped>
</style>