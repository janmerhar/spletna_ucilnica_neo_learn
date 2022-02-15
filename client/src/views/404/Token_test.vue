<template>
  <div>
    Token: {{ $store.getters.getToken }}
    <p @click="token">iizpoi</p>
  </div>
</template>

<script>
import axios from "axios"
export default {
  methods: {
    token() {
      axios
        .post("headers.php", {
          username: "merjan",
          // token: this.$store.getters.getToken,
        })
        .then((res) => {
          console.log(res.data)
          this.$store.commit("setToken", res.data.token)
        })
        .catch((err) => console.log(err))
    },
  },
}
</script>

<style lang="scss" scoped></style>
