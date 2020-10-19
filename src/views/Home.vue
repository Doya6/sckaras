<template>
    <div>
        <NavBar/>
        <h3 class='text-center light-blue lighten-3 white--text'> Home Page</h3>
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