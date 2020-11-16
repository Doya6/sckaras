<template>
<div> 
    <v-container v-if="this.userLevel === '1'">
      <v-card 
      class='pa-5 mx-auto mt-5'
      width='500px'>
        <h2 class='pl-6 justify="center" black white--text'>Správa uživatelských přístupů</h2>
        <v-row no-gutters>
          <v-col cols="9">
            <v-autocomplete class="ma-3"
            v-model="selectedUser"
            label="Users"
            filled
            solo
            v-bind:items="allUsers"
            item-text="userEmail"
            item-value="userEmail">
            </v-autocomplete>
          </v-col>
          <v-col cols="3">
            <v-autocomplete class="ma-3"
            v-model="selectedLevel"
            label="Level"
            filled
            solo
            v-bind:items="levels">
            </v-autocomplete> 
          </v-col>
        </v-row> 
        <v-row no-gutters>
          <v-col cols="9" left>
            <h4>Level 1</h4> - Admin - zadává/spravuje všechny aktivity a edituje přístupová práva (level)
            <h4>Level 2</h4> - Správce svých aktivit - zadáva a spravuje pouze své aktivity
            <h4>Level 3</h4> - Uživatel - výchozí nastavení pro každého nově zaregistrovaného uživatele
          </v-col>  
          <v-col cols="3" class="text-right">
            <v-btn v-on:click="save">SAVE</v-btn>
          </v-col>
        </v-row>    
      </v-card>
    </v-container>
    <p v-else>Pro vstup na tuto stránku nemáte oprávnění.</p>  
</div>
</template>

<script>
import axios from 'axios'

export default {
  mounted() {
    this.userLevel = this.$store.getters.getUserLevel;
    this.getUserList();
  },
  
  methods: {
    save() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras/updateLevel.php", {
         email: this.selectedUser,
         level: this.selectedLevel
      })
      .then((response) => {   
      });
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
      selectedUser: undefined,
      levels: [1, 2, 3],
      selectedLevel: undefined
  }),
  
};
</script>
