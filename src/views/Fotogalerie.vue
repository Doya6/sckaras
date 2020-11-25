<template>
    <div>
        <h3 class='text-center light-blue lighten-3 white--text'>Fotogalerie</h3>
        <div class='kontejner'>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/1.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/2.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/3.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/4.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/5.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/6.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/7.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/8.jpg"></div>
          <div class='foto'><img src="https://mytestwww.tode.cz/SCKaras.dev/PhotoGalery/9.jpg"></div>
        </div>
    </div>    
</template>

<script>

export default {
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