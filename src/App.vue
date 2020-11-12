<template>
  <v-app id="inspire">
    <div>
      <NavBar />
      <router-view/>
    </div>
  </v-app>
</template>

<script>
import NavBar from "./components/NavBar.vue";

export default {
  components:{
    NavBar
  },
  
}
</script>

<style>
#inspire {
  background: none;
</style>


