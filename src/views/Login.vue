<template>
    <div>
        <NavBar/>
        <!-- <h3 class='text-center light-blue lighten-3 white--text'>Přihlášení</h3> -->
        <Login/>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'
import Formular from '@/components/Login.vue'
export default {
  name: 'Login',
  components: {
    NavBar,
    Login
  }
}
</script>
