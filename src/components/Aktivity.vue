<template>
    <div>
      <v-row no-gutters align="center" class='light-blue lighten-3 white--text'>
        
        <v-col class="pl-4" cols="6" >
          <h3 class="py-3">Kalendář aktivit</h3>
        </v-col>
      
        <v-col class="pr-4" cols="6" align="end">
          <v-btn v-on:click="aktivityFilter()" color="light-blue lighten-3">
            Filtr aktivit
          </v-btn>
        </v-col>

      </v-row>

      <v-dialog  v-model="dialog" max-width="350px" min-width="200px">
        
        <v-list class= "pa-0">
            <v-list-item
              v-for="(type, i) in listOfAktivityTypes"
              :key="i"
              class="mx-4" 
            >
              <v-list-item-content >
                <v-list-item-title v-text="type.eventTypeDesc" ></v-list-item-title>
              </v-list-item-content>
              <v-list-item-action>
                <v-checkbox 
                  v-on:click="addToSelectedActivityTypes(type.eventType_id)"
                  color="light-blue lighten-3"
                ></v-checkbox>
              </v-list-item-action>
            </v-list-item>

          <v-row no-gutters>
            <v-btn  v-on:click="applyTypeFilter()" class="mx-auto" mb="0" width="100%" color="light-blue lighten-3" >
              Použít filtr  
            </v-btn>
          </v-row>
        </v-list>
      </v-dialog>

      <v-card height="350px" 
      class='px-3 mx-auto scroll'
      >
        <v-row
          v-for="(activity, index) in listOfActivities"
          v-bind:key="index"
          class = "rows"
          >
          <v-col  cols="6" xs="5" sm="7" md="8" lg="9" class = "pl-2 pr-0" align="start">
            <h5 class="mb-0" > {{ activity.eventStartDate.slice(0, -3) }}  - {{ activity.eventEndDate.slice(10, -3) }} hod</h5>
            <p class="mb-0"> {{ activity.eventDesc }}</p>
          </v-col>
          <v-col  cols="2" xs="2" sm="2" md="2" lg="1" class = "pl-2 pr-0" align="center">
           <p class = "my-0 hidden-xs-only"> obsazenost </p>
           <p class = "my-0 hidden-sm-and-up"> obs. </p>
           <p class = "my-0"> {{ activity.mySUM == null ? 0 :  activity.mySUM }}/{{ activity.maxSumOfAttendees }}</p>
          </v-col>
          <v-col  cols="4" xs="5" sm="2" md="2" lg="2" class = "pr-2" align="end">
            <v-btn
              depressed v-on:click=naCoSiKliknul(activity.myEventID)
             >
              Rezervovat
            </v-btn>
          </v-col>
        </v-row>
      </v-card>
      
      <v-card height="300px"
      class='px-auto mx-auto'
      >
      <div>
          <h3 class='text-left pl-6 light-blue lighten-3 white--text py-3'>Moje rezervace</h3>
          <h2 > Datum now: {{ datum }} </h2>
          <h2 > UserID: {{ loggedUserId }} </h2>
          
      </div>
      </v-card>
      
    </div>
</template>

<script>
import axios from'axios'
//import router from '../router'

export default {

  mounted() {
    this.getAktivityTypeList(),
    this.getAktivityList()
    //this.message = this.$store.getters.getMessage;
    //this.$store.dispatch("setMessage");
  },
  created() {
    //this.id = this.$route.params.id;
  },
  
  data: () => ({
    //message: '',

    dialog: false,
    
    listOfAktivityTypes: [],
    selectedActivityTypes: [],
    listOfActivities: [],
    
    loggedUserId: 1,
    datum: Date.now()    
    
  }),
  
  methods:{

    getAktivityTypeList() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras/selectEventTypeList.php", {
      })
      .then((response) => {
        this.listOfAktivityTypes = (response.data);
      });
      
    },

    getAktivityList() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras/selectEvents.php", {
         sqlStringWhere: this.selectedActivityTypes  
      })
      .then((response) => {
      
          this.listOfActivities = (response.data);
          
          // let activity;
          // for (activity in this.listOfActivities){
          //   axios
          //   .post("https://mytestwww.tode.cz/SCKaras/selectSumObsazenost.php", {
          //     selsectEventId: activity.event_id 
          //   })
          //   .then((response) => {
          //     if ((response.data) == null){
          //       this.listOfActivities.push({obsazenost: "0"});
          //     } else { 
          //       this.listOfActivities.push({obsazenost: (response.data)});
          //     }
          //   });
          // }
      });
    },
      
    addToSelectedActivityTypes(TypeId){
      if (this.selectedActivityTypes.includes(TypeId)) {
        this.selectedActivityTypes.splice(this.selectedActivityTypes.indexOf(TypeId), 1);
    } else
      this.selectedActivityTypes.push(TypeId);
    },

    applyTypeFilter(){
      this.getAktivityList();
      this.dialog = false;
    },

    naCoSiKliknul(eventId){
      alert(`Kliknul si na eventId ${eventId}`)
    },

    aktivityFilter(){
      this.dialog = !this.dialog;
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
  .click-enabled{
    pointer-events: all;
    cursor: pointer;
  }
  .click-disabled{
    pointer-events: none;
  }
</style>
