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
            v-bind:items="allUsers"
            item-text="userName"
            item-value="userName">
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
import axios from 'axios'

export default {
  mounted() {
    this.userLevel = this.$store.getters.getUserLevel;
    getUserList();
  },
  
  methods: {
    show(){
    alert(this.allUsers);
    },
    
    getUserList() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras/selectAllUsers.php", {
      })
      .then((response) => {
        this.allUsers = (response.data);
      });
    }
    
  },
  
  data: () => ({
      userLevel: '',
      allUsers: [],
      value: undefined,
  }),
  
};
</script>

<style>

</style>
