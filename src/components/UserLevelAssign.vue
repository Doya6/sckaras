<template>
<div>
    
    <v-section v-if="this.userLevel === '1'">
      <h1 class='pl-6 justify="center" light-blue lighten-3 white--text'>Správa uživatelských přístupů UserLevel: {{ userLevel }}</h1>
      <p>
        list form
      </p>
    </v-section>
    <p v-else>Pro vstup na tuto stránku nemáte oprávnění.</p>
    
   
</div>
</template>

<script>
export default {
  mounted() {
    this.userLevel = this.$store.getters.getUserLevel;
  },
  
  data() {
    return {
      userLevel: ''

      
    };
  },
};
</script>

<style>

</style>