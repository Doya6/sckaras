<template>
    <div>
        <NavBar/>
        <!-- <h3 class='text-center light-blue lighten-3 white--text'>Přihlášení</h3> -->
        <LoginForms/>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'
import LoginForms from '@/components/LoginForms.vue'
export default {
  name: 'Login',
  components: {
    NavBar,
    LoginForms
  }
}
</script>
