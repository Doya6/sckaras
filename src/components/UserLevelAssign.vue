<template>
  <div>
    <v-container v-if="this.actUserLevel === '1'">
      <v-card class="pa-5 mx-auto mt-5" width="500px">
        <h2 class="pl-6 justify=&quot;center&quot; black white--text">
          Správa uživatelských přístupů
        </h2>
        <v-row no-gutters align="center"
      justify="center">
          <v-col xs="11" sm="11" md="8">
            <v-autocomplete
              class="ma-3"
              v-model="selectedUser"
              label="Users"
              filled
              solo
              v-bind:items="allUsers"
              item-text="userEmail"
              item-value="userEmail"
            >
            </v-autocomplete>
          </v-col>
          <v-col cols="1" align="center">
            <p id="currLevel">{{ userLevel2show }}</p>
          </v-col>
          <v-col xs="11" sm="11" md="3" >
            <v-autocomplete
              class="ma-3"
              v-model="selectedLevel"
              label="Level"
              filled
              solo
              v-bind:items="levels"
            >
            </v-autocomplete>
          </v-col>
        </v-row>

        <v-row no-gutters>
          <v-col cols="9" left>
            <p>Level 1 - Admin - zadává/spravuje všechny aktivity a edituje přístupová
            práva (level)
            </p>
            <p>Level 2 - Správce svých aktivit - zadáva a spravuje pouze své aktivity
            </p>
            <p>Level 3 - Uživatel - výchozí nastavení pro každého nově zaregistrovaného
            uživatele
            </p>
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
    this.actUserLevel = this.$store.getters.getUserLevel;
    this.getUserList();
  },

  computed:{
    userLevel2show () {
    
          if (this.selectedUser != ''){ 
        return (this.allUsers[(this.allUsers.findIndex(i => i.userEmail === this.selectedUser))].userLevel);
        }
    
   
    }
  },
  
  methods: {
    save() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras.dev/updateLevel.php", {
         email: this.selectedUser,
         level: this.selectedLevel
      })
      .then((response) => {   
      });
      this.getUserList();
    },

    getUserList() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras.dev/selectAllUsers.php", {
      })
      .then((response) => {
        this.allUsers = (response.data);
      }); 
    }
  },
  
  data: () => ({
      actUserLevel: '',

      allUsers: [],
      selectedUser: '',
      levels: [1, 2, 3],
      selectedLevel: undefined,
      showUpdate: false
  }),
  
};
</script>

<style scoped>
#currLevel{
  font-size: 3.5vh;
}

</style>

