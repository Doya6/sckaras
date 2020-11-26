<template>
<div>
  <div mx-auto class="bckg" :style="bgImage">
    
    <v-card class="pa-3 mx-auto text-center karta" width="500px" height="350px">
      <!-- <h1 class='text-center justify="center" light-blue lighten-3 white--text'>Home Page</h1> -->
      
      <img src="https://mytestwww.tode.cz/SCKaras.dev/HomePagePic/HPPic.jpg">
      
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

<style scoped>
.bckg {
  width: 100%;
  height: 600px;
  background-size: cover;
}
.karta{
  position: relative;
  top: 18%;
}
img {
    max-width: 100%;
    max-height: 100%;
}
</style>
