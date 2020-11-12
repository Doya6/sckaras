<template>
  <v-app style="
    background: rgba(0,0,0,0);">
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


