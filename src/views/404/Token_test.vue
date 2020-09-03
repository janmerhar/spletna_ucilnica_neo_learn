<template>
  <div>
    <p @click="token">iizpoi</p>
  </div>
</template>

    <script>
        import axios from 'axios'
    export default {
            methods: {
                token() {

                    axios.post("headers.php", {
                        name: 'jan'
                }
            )
                .then(res => console.log(res.data))
                .catch(err => console.log(err))
                }
        }
    }
</script>

    <style lang="scss" scoped>
</style>