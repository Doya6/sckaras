<template>
    <div>
        <section :style="image" class="image">
        <v-card 
          class='pa-5 mx-auto mt-15 text-center'
          width='500px'>
          <!-- <h1 class='text-center justify="center" light-blue lighten-3 white--text'>Home Page</h1> -->
          <v-img 
          height="100%"
          width="100%"
          src="../assets/HomePic.jpg" ></v-img>
        </v-card>
      </section>
    </div>
</template>

<script>

export default {
        data() {
            return {
                image: {backgroundImage: "src='../assets/HomePic.jpg'"}
            };
        }
    };

</script>

<style>
.image {
        width: 100%;
        background-repeat: no-repeat;
    }
  </style>
