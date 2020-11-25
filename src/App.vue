<template>
  <v-app>
    <div>
      <NavBar />
      <router-view/>
      <Footer />
    </div>
  </v-app>
</template>

<script>
import NavBar from "./components/NavBar.vue";
import Footer from "./components/Footer.vue";

export default {
  components:{
    NavBar,
    Footer
  },
  
}
</script>




