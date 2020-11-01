<template>
    <div>
        <v-card 
          class='pa-5 mx-auto mt-15 text-center'
          width='250px'>
          <h1 class='text-center justify="center" light-blue lighten-3 white--text'>Home Page</h1>
        </v-card>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'

export default {
  name: 'Home',
  components: {
    NavBar
  }
}
</script>