<template>
  <div id="countdown" class="h4 text-center bg-blue"></div>
</template>

<script>
let cas_minute

function countdown(minutes) {
  let seconds = 60
  let mins = minutes
  function tick() {
    let counter = document.getElementById("countdown")
    let current_minutes = mins - 1
    seconds--
    counter.innerHTML =
      current_minutes.toString() +
      ":" +
      (seconds < 10 ? "0" : "") +
      String(seconds)
    if (seconds >= 0) {
      counter.style.width =
        ((current_minutes * 60 + seconds) / (cas_minute * 60)) * 100 + "%"
      setTimeout(tick, 1000)
    } else if (mins > 1) {
      countdown(mins - 1)
    }
    // koda za FORM SUBMIT, ko se čas izteče
    else {
      // mogoče naredim emitter
      let form = document.getElementsByTagName("form")[0]
      form.submit()
    }
  }
  tick()
}

export default {
  props: ["cas_minute"],
  created() {
    cas_minute = this.cas_minute
  },
  mounted() {
    countdown(this.cas_minute)
  },
}
</script>

<style lang="scss" scoped></style>
