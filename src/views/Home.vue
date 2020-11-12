<template>
<div>
  <div mx-auto class="bckg" :style="bgImage">
    <v-card class="pa-3 mx-auto text-center" width="500px" position="fixed" top='100px'>
      <!-- <h1 class='text-center justify="center" light-blue lighten-3 white--text'>Home Page</h1> -->
      <v-img height="100%" width="100%" src="../assets/HomePic.jpg"></v-img>
    </v-card>
  </div>  
</div>
</template>

<script>
export default {
  data() {
    return {
      bgImage: {
        backgroundImage: `url(${require("../assets/bckg.jpg")})`,
      },
    };
  },
};
</script>

<style>
.bckg {
  width: 100%;
  height: 600px;
  background-size: cover;
}
</style>
