<template>
    <div>
      <div :style="{'background-image':'url(https://example.com/bg.png)'}">
        <v-card 
          class='pa-5 mx-auto mt-15 text-center'
          width='500px'>
          <!-- <h1 class='text-center justify="center" light-blue lighten-3 white--text'>Home Page</h1> -->
          <v-img 
          height="100%"
          width="100%"
          src="../assets/HomePic.jpg" ></v-img>
        </v-card>
      </div>
    </div>
</template>

<script>

export default {

}

</script>

<style>
.bg {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: url( 'https://cdn.pixabay.com/photo/2016/03/26/13/09/organic-1280537_1280.jpg') no-repeat center center;
    background-size: cover;
    background-color: gray;
    transform: scale(1.1);
  }
  </style>
