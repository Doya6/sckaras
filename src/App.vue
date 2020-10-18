<template>
  <v-app>
    <div>
      <router-view/>
    </div>
  </v-app>
</template>

<!--
<script>



  data() {
    return {
      menu: false,
      tlacitka: [
      {label: "Domu", ikona: "mdi-home"},
      {label: "K sousedovi", ikona: "mdi-arrow-left-bold-outline"},
      {label: "O me ", ikona: "mdi-home"},
      {label: "Ke me", ikona: "mdi-home"},
      ]
    };
  },
  methods:{
    otevriMenu(){
      this.menu = true;
    }
  },
  mounted() {
        this.$router.push('../components/home');
    }
};
</script>

<style>
.tlacitko{
  color: yellow;
  font-size: 20px;
  font-weight: 700;
  margin: 50px;
}
.menu-tlacitko-text{
  color: white;
  font-weight: 700;
  font-size: 20px; 
}
.obsah-tlacitka{
  width: 100%;
  display: flex;
  justify-content: space-between;
}
</style>
-->