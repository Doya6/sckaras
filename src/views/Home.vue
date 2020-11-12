<template>
    <div>
      <section>
        <div :style="image" class="image"></div>
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
                image: {backgroundImage: "https://www.google.com/search?q=background&rlz=1C1GCEB_enGB875GB876&sxsrf=ALeKk010YDf3S43fqI2KNP_GIFq6PR1yow:1605190387752&tbm=isch&source=iu&ictx=1&fir=v2hClYlC2HKtzM%252CUQ7UItca9yWkEM%252C_&vet=1&usg=AI4_-kRGYVIWhmIy_1CTLWbKJnH1DfOjuw&sa=X&ved=2ahUKEwjjje-WmP3sAhWeSEEAHbuGCZ8Q9QF6BAgKEGg#imgrc=v2hClYlC2HKtzM)"}
            };
        }
    };

</script>

<style>
    .image {
        height: 150px;
        background-repeat: no-repeat;
    }
</style>
