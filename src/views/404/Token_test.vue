<template>
  <div>
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
          token:
            "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6Im1lcmphbiIsImV4cCI6MTU5OTk0MzczMX0.PEh2JgyudO7GehC5KhxOXTBtBbWVbL_DPYfPktrob0o",
        })
        .then((res) => {
          console.log(res.data)
        })
        .catch((err) => console.log(err))
    },
  },
}
</script>

<style lang="scss" scoped></style>
