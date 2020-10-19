<template>
    <div>
        <NavBar/>
        <!-- <h3 class='text-center light-blue lighten-3 white--text'>Přihlášení</h3> -->
        <Formular/>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'
import Formular from '@/components/Formular.vue'
export default {
  name: 'Prihlaseni',
  components: {
    NavBar,
    Formular
  }
}
</script>