<template>
    <div>
      <NavBar/>
      <h3 class='text-center light-blue lighten-3 white--text'>Aktivity</h3>
      <v-card height="300px"
      class='px-auto mx-auto mt-3'>
      <div>
          <h4 class='ml-10'>Kalendář akcí</h4>
      </div>
      </v-card>
      <v-card height="300px"
      class='px-auto mx-auto mt-3'>
      <div>
          <h4 class='ml-10'>Moje rezervace</h4>
      </div>
      </v-card>

    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'
export default {
  name: 'Aktivity',
  components: {
    NavBar
  }
}
</script>