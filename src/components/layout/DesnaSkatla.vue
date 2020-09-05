<template>
  <div class="container-fluid mt-md-5 mt-3 border-blue text-center" v-if="isAdmin">
    Skrbnik
    <ul class="list-group-flush">
      <br />
      <li class="i list-group-item bg-greyish">
        <a href="#">Ustvari test</a>
      </li>
      <li class="i list-group-item bg-greyish">
        <a href="#">Ocene in testi</a>
      </li>
      <li class="i list-group-item bg-greyish">
        <a href="#">Pregled uporabnikov</a>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      isAdmin: false
    }
  },
  mounted() {
    // ko je kreirana preveri, ali je uporabnik skrbnik
    let data = {
      username: this.$store.getters.getUsername,
      ucilnica: this.$store.getters.getUcilnica,
      type: 'isAdmin',
    }
    axios.post("uporabnik/clanstvo.php", data)
    .then(res => {
      if(res.data.status == true) 
        this.isAdmin = res.data.type == 'admin' ? true : false
    })
  }
    
}
</script>