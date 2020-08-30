<template>
  <div class="vsebina_sklopa">
    <p>
      {{ sklop.ime_sklopa }}
      <button class="gumb-small">-</button>
    </p>
    <!-- dodaj @click za brisanje sklopa -->
    <ul>
      <li v-for="list in sklop.vsebina" :key="sklop.id_sklopa + '.' + list.id_vsebine">
        {{ list.besedilo }}
        <button class="gumb-small">-</button>
        <!-- dodaj @click za brisanje vsebine -->
        <!-- preveri tip podatka in ugotovi, ali boš dal link, text ali sliko => method() -->
      </li>
    </ul>
  </div>
</template>

<script>
    export default {
        props: ['sklop']
    }
</script>

<style lang="scss" scoped>
</style>

/*
    NAVODILA:
    
    struktura propsa sklop:
    {
        ime_sklopa,
        id_sklopa, => uporaba za brisanje
        vsebina: [
            {
                id_vsebine,
                vrsta,
                besedilo,
            },
        ]
    }