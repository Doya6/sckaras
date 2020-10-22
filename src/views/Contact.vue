<template>
    <div>
        <NavBar/>
        <v-content>
    <v-card 
        class='pa-5 mx-auto mt-15 text-center'
        width='250px'
    >
        <div>
            <p>Společenské centrum Karas</p>
            <p>Vymazalova 2285/22 </br>
            615 00 Brno-Židenice</p>
            <p>Tel.: 515 547 884</p>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <a href= "https://www.facebook.com/spolecenskecentrumkaras/" class="fa fa-facebook"></a>
        </div>
    </v-card>
    <v-card
    class='mx-auto mt-5 text-center'
        width='400px'>
        <div id="m" class="mapa">
            mapa
        </div>
    </v-card>

</v-content>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'

export default {
  
  components: {
    NavBar
  },
    mounted() {
        this.loadMap();
    },
    methods: {
        loadMap() {
            var center = SMap.Coords.fromWGS84(16.6403656, 49.1980339);
            var cameraPosition = SMap.Coords.fromWGS84(16.6403656, 49.1980339);
            var m = new SMap(JAK.gel("m"), center, 14);
            m.addDefaultLayer(SMap.DEF_BASE).enable();
            m.addDefaultControls();

            var layer = new SMap.Layer.Marker();
            m.addLayer(layer);
            layer.enable();

            var options = {};
            var marker = new SMap.Marker(cameraPosition, "myMarker", options);
            layer.addMarker(marker);
        }
	}
};
</script>

<style scoped>
.fa {
  padding: 10px;
  font-size: 20px;
  width: 40px;
  text-align: center;
  text-decoration: none;
  margin-bottom: 8px;
  /* border-radius: 50%; */
}
.fa:hover {
  opacity: 0.7;
}
.fa-facebook {
  background: #3b5998;
  color: white;
}
.mapa{
    height: 400px;
}
</style>

