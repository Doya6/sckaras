<template>
    <div>
        <NavBar/>
        <h3 class='text-center light-blue lighten-3 white--text'>Fotogalerie</h3>
        <div class='kontejner'>
          <div class='foto'><img src="../assets/Pics/001.jpg"></div>
          <div class='foto'><img src="../assets/Pics/002.jpg"></div>
          <div class='foto'><img src="../assets/Pics/003.jpg"></div>
          <div class='foto'><img src="../assets/Pics/004.jpg"></div>
          <div class='foto'><img src="../assets/Pics/005.jpg"></div>
          <div class='foto'><img src="../assets/Pics/006.jpg"></div>
          <div class='foto'><img src="../assets/Pics/007.jpg"></div>
          <div class='foto'><img src="../assets/Pics/008.jpg"></div>
          <div class='foto'><img src="../assets/Pics/009.jpg"></div>
        </div>
    </div>    
</template>

<script>
import NavBar from '@/components/NavBar.vue'

export default {
  name: 'Fotogalerie',
  components: {
    NavBar
  },
}
</script>
<style scoped>
.kontejner{
  display: grid;
  grid-template-columns: repeate(3, 1fr);
  grid-template-rows: repeate(3, 1fr);
}
img{
  object-fit: cover;
  width: 100%;
  height: 100%;
}
.foto:nth-child(3n){
  grid-column: span 2;
  grid-row: span 2;
}
</style>