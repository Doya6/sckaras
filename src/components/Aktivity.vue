<template>
    <div>
      <h3 class='text-center light-blue lighten-3 white--text'>Aktivity</h3>
      <v-card height="300px"
      class='px-auto mx-auto mt-3'>
      <div>
          <h4 class='ml-10'>Kalendář akcí</h4>
          <h2 > Datum now: {{ datum }} </h2>
      </div>
      </v-card>
      <v-card height="300px"
      class='px-auto mx-auto mt-3'>
      <div>
          <h4 class='ml-10'>Moje rezervace</h4>
          <h2 > User ID: {{ loggedUserId }} </h2>
      </div>
      </v-card>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'

export default {
  name: 'Aktivity',
  components: {
    NavBar
  },
  props: { 
    loggedUser: {
      type: Object,
      required: true,
    }
  },
  data: () => ({
    loggedUserId: 1,
    datum: Date.now()

  }),
  methods:{
    aktivityList() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras/getActivityList.php", {
        dateStart: Date.now(),
      })
      .then((response) => {
        if (response.data[0].userPswd == this.loginPassword) {
          this.loggedUser.id = response.data[0].userID;
          this.loggedUser.name = response.data[0].userName;
          this.loggedUser.email = response.data[0].userEmail;
          this.loginEmail = "";
          this.loginPassword = "";
          this.loginShow = false;
        } else {
          alert("Zadali jste nesprávné heslo.");
          this.loginPassword = "";
        }
      });
    }
  }
}
</script>