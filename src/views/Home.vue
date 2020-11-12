<template>
    <div>
        <section>
        <div :style="image" class="image"></div>
    </section>
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
                image: {backgroundImage: "url(https://via.placeholder.com/150)"}
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
