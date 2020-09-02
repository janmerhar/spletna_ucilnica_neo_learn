<template>
  <div class="col">
    <div class="card mt-3 bg-greyish border-blue">
      <div class="card-body">
        <p class="card-title font-weight-bolder">{{ ucilnica.ime }}</p>
        <p class="card-text">Kategorija: {{ ucilnica.kategorija }}</p>
        <p>
          <router-link
            href="#"
            class="btn btn-outline-info my-2 my-sm-0"
            :to="{ name: 'ucilnica', params: {ucilnica: ucilnica.ime} }"
          >Vstop {{ ucilnica.isJavna ? '' : 'z geslom' }}</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: {
            ucilnica: Object
        },
    }
</script>

<style>
</style>
