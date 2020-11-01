<template>
    <div>
      <h3 class='text-center light-blue lighten-3 white--text'>Kalendář aktivit - (add filtry)</h3>
      <v-card height="300px" 
      class='px-auto mx-auto mt-3 scroll'>
      <div>
        <v-row
          v-for="(activity, index) in ListOfActivities"
          v-bind:key="index"
          class = "rows"
        >
        <p class = ml-6 > Termín: {{ activity.date }}</p>
        <p class = ml-6 > Název aktivity: {{ activity.name }}</p>
        <p class = ml-6 text-right> Obsazenost: {{ activity.obsazenost }}</p>
        <v-spacer></v-spacer>
        <v-btn
        depressed v-on:click=naCoSiKliknul(index)
        class = mr-6
        >
          Rezervovat
        </v-btn>
        </v-row>
        <!-- <h2 > Datum now: {{ datum }} </h2> -->
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
    datum: Date.now(),
    ListOfActivities: [
      {id: '01',
      date: '20201111',
      name: 'dalsi akce 1',
      obsazenost: '5 / 5'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 2',
      obsazenost: '8 / 10'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 3',
      obsazenost: '2 / 10'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 4',
      obsazenost: '3 / 5'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 5',
      obsazenost: '6 / 15'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 6',
      obsazenost: '5 / 7'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 7',
      obsazenost: '4 / 12'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 8',
      obsazenost: '12 / 20'},
       {id: '02',
      date: '20201112',
      name: 'dalsi akce 9',
      obsazenost: '3 / 6'},
    ]
  }),
  methods:{
    getAktivityList() {
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
    },

    naCoSiKliknul(index){
      alert(`Kliknul si na index ${index}`)
    }

  }
}
</script>

<style>
.scroll {
   overflow-y: scroll
}
.rows{
  border-bottom: 1px solid Lightgray;
}
</style>