<template>
  <div class="h4 text-center bg-blue" :style="{ width: width }">
    {{ preostali_cas }}
  </div>
</template>

<script>
// ne morem dobiti vrednosti iz props fix
// https://stackoverflow.com/questions/50994302/vuejs-passing-props-to-data-doesnt-work

export default {
  props: {
    cas: {
      type: Number,
    },
  },
  data() {
    return {
      minute: this.cas,
      sekunde: 0,
    }
  },
  computed: {
    preostali_cas() {
      return this.minute + ":" + this.sekunde
    },
    width() {
      return ((this.minute * 60 + this.sekunde) / (this.cas * 60)) * 100 + "%"
    },
  },
  methods: {
    countdown() {
      setInterval(() => {
        this.sekunde--
        if (this.sekunde < 0) {
          this.sekunde = 59
          this.minute--
        }
        if (this.minute < 0) this.$emit("timeover", "")
      }, 1000)
    },
  },
  watch: {
    cas(newValue) {
      this.minute = newValue
    },
  },
  created() {
    this.countdown()
  },
}
</script>

<style lang="scss" scoped></style>
