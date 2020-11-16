<template>
<div>
    
    <v-section v-if="this.userLevel === '1'">
      <h1 class='pl-6 justify="center" light-blue lighten-3 white--text'>Správa uživatelských přístupů UserLevel: {{ userLevel }}</h1>
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-autocomplete
            v-model="value"
            label="Users"
            filled
            solo
            v-bind:items="items">
            Seznam
            </v-autocomplete>
          </v-col>
        </v-row>    
      <v-btn v-on:click="show">SHOW</v-btn>
    </v-section>
    <p v-else>Pro vstup na tuto stránku nemáte oprávnění.</p>
    
   
</div>
</template>

<script>
export default {
  mounted() {
    this.userLevel = this.$store.getters.getUserLevel;
    
  },
  
  methods: {
    show(){
    alert(this.items);
    alert(this.values);
    alert(this.value);
    }
  },
  
  data() {
    return {
      userLevel: '',
      items: ['foo', 'bar', 'fizz', 'buzz'],
      values: ['foo', 'bar'],
      value: null,
    };
  },
};
</script>

<style>

</style>
