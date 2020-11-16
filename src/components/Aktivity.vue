<template>
    <div>
      <!-- MOJE REZERVACE ------------------------------------------------------------------>
      <v-row no-gutters align="center" class='light-blue lighten-3 white--text'>
        <v-col class="pl-4 rows" cols="12" >
          <h3 class="py-3">Moje rezervace <span class="rezervaceStav px-6 body-2"> {{ rezervaceStav }}</span></h3>
        </v-col>
      </v-row>
      <v-row
        v-for="(myActivity, index) in listOfMyActivities"
        v-bind:key="index"
        class = "rows px-3"
        >
        <v-col  cols="6" xs="5" sm="7" md="8" lg="9" class = "pl-2 pr-0" align="start">
          <h5 class="mb-0" > {{ myActivity.eventStartDate.slice(0, -3) }}  - {{ myActivity.eventEndDate.slice(11, -3) }} hod</h5>
          <p class="mb-0"> {{ myActivity.eventName }}</p>
        </v-col>
        <v-col  cols="2" xs="2" sm="2" md="2" lg="1" class = "pl-2 pr-0" align="center">
          <p class = "my-0 hidden-xs-only"> obsazenost </p>
          <p class = "my-0 hidden-sm-and-up"> obs. </p>
          <p class = "my-0"> {{ myActivity.mySUM == null ? 0 :  myActivity.mySUM }}/{{ myActivity.maxSumOfAttendees }}</p>
        </v-col>
        <v-col  cols="4" xs="5" sm="2" md="2" lg="2" class = "pr-2" align="end">
          <v-btn>Zrušit</v-btn>
        </v-col>
        </v-row>
      <!-- KALENDAR ------------------------------------------------------------------>
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
      <!-- VYBER TYPU ---------------------------------------------------------------->
      <v-dialog  v-model="dialog" max-width="350px" min-width="200px">  
        <v-list class= "pa-0">
            <v-list-item
              v-for="(type, i) in listOfAktivityTypes"
              v-bind:key="i"
              class="mx-4" 
            >
              <v-list-item-content>
                <v-list-item-title v-text="type.eventTypeDesc" ></v-list-item-title>
              </v-list-item-content>
              <v-list-item-action>
                <v-checkbox 
                  v-on:click="addToSelectedActivityTypes(type.eventType_id)"
                  color="light-blue lighten-3"
                  v-bind:value="type"
                ></v-checkbox>
              </v-list-item-action>
            </v-list-item>
          <v-row no-gutters>
            <v-btn   v-model="selectedActivityTypes" v-on:click="applyTypeFilter()" class="mx-auto" mb="0" width="100%" color="light-blue lighten-3" >
              Použít filtr  
            </v-btn>
          </v-row>
        </v-list>
      </v-dialog>
      <!-- VYBER TYPU ^^^^ ---------------------------------------------------------------------->
      <v-card height="450px" 
      class='px-3 mx-auto scroll'
      >
        <v-row
          v-for="(activity, index) in listOfActivities"
          v-bind:key="index"
          class = "rows"
          >
          <v-col  v-on:click="showAktivityCard(index)" cols="6" xs="5" sm="7" md="8" lg="9" class = "pl-2 pr-0" align="start">
            <h5 class="mb-0" > {{ activity.eventStartDate.slice(0, -3) }}  - {{ activity.eventEndDate.slice(11, -3) }} hod</h5>
            <p  class="mb-0"> {{ activity.eventName }}</p>
          </v-col>
          <v-col  cols="2" xs="2" sm="2" md="2" lg="1" class = "pl-2 pr-0" align="center">
           <p class = "my-0 hidden-xs-only"> obsazenost </p>
           <p class = "my-0 hidden-sm-and-up"> obs. </p>
           <p class = "my-0"> {{ activity.mySUM == null ? 0 :  activity.mySUM }}/{{ activity.maxSumOfAttendees }}</p>
          </v-col>
          <v-col  cols="4" xs="5" sm="2" md="2" lg="2" class = "pr-2" align="end">
            <v-btn
              depressed v-on:click=naCoSiKliknul(activity.myEventID)
              v-bind:disabled="(activity.mySUM == activity.maxSumOfAttendees) || (userID =='')"
             >
              Rezervovat
            </v-btn>
          </v-col>
        </v-row>
      </v-card>
      <!-- aktivity Card -------------------------------------------------->
       <v-dialog v-if="aktivityCard" v-model="aktivityCard" max-width="600px" min-width="360px" >
        <div>
          <v-card
            class="mx-auto"
            max-width="600"
            min-width="360px"
            outlined
            min-height="200px"
          >
            <v-row no-gutters class="pa-3">
              <v-col class="pr-3" xs="7" sm="9">
                <div class="mb-2">
                  {{ listOfActivities[selectedAktivityCard].eventStartDate.slice(0, -3) }} - 
                  {{ listOfActivities[selectedAktivityCard].eventEndDate.slice(11, -3) }} hod
                </div>
                <div class="headline mb-1  pl-2">
                  {{ listOfActivities[selectedAktivityCard].eventName }}
                </div>
                <div>{{ listOfActivities[selectedAktivityCard].eventDesc }}
                </div>
                <div  align="end" class="mt-4">
                  Je obsazeno {{ listOfActivities[selectedAktivityCard].mySUM == null ? 0 :  listOfActivities[selectedAktivityCard].mySUM }} míst z {{ listOfActivities[selectedAktivityCard].maxSumOfAttendees }}
                <span >
                  <v-btn
                  align="end" v-bind:disabled="(listOfActivities[selectedAktivityCard].mySUM == listOfActivities[selectedAktivityCard].maxSumOfAttendees) || (userID =='')"
                  class="ml-2">              
                  Rezervovat
                  </v-btn>
                  <!-- <v-input>
                  počet míst
                  </v-input> -->
                </span>  
                </div> 
              </v-col>
            
              <v-col xs="5" sm="3" align="end" class="rightCollumn">
                <v-list-item-avatar
                  tile
                  size="80"
                  color="grey">
                  <v-img height="100%" width="100%" src="https://mytestwww.tode.cz/SCKaras/AvatarPics/" + ${listOfActivities[selectedAktivityCard].initializator_id} +".jpg"></v-img>
               <v-img height="100%" width="100%" v-bind:src="require('https://mytestwww.tode.cz/SCKaras/AvatarPics/' + listOfActivities[selectedAktivityCard].initializator_id + '.jpg')"></v-img>
               
               v-bind:src="require('../myimages/' + myFilename)"
               
               </v-list-item-avatar>
                <div class="mr-4 font-weight-light">
                  Organizátor:
                </div>
                <div class="mr-4" id=kontaktText>
                  {{ listOfActivities[selectedAktivityCard].userName }}
                </div>
                <div class="mr-4 font-weight-light">
                  Telefon:
                </div>
                <div class="mr-4" id=kontaktText>
                  {{ listOfActivities[selectedAktivityCard].userPhoneNum }}
                </div>
                <div class="mr-4 font-weight-light">
                  E-mail:
                </div>
                <div class="mr-4" id=kontaktText>
                  {{ listOfActivities[selectedAktivityCard].userEmail }}
                </div>
              </v-col>
            </v-row>  
          </v-card>
        </div>
      </v-dialog>
      
    </div>
</template>

<script>
import axios from'axios'

export default {

  mounted() {
    this.userID = this.$store.getters.getUserID;
    
    this.getAktivityTypeList()
    this.getAktivityList()
    this.getMyAktivityList()
  },

  computed: {
   rezervaceStav: function () {
    if (this.userID == '') {
      return "- pro zobrazení vašich rezervací se musíte přihlásit"
     }
    if (this.listOfMyActivities == '0'){
      return "- nemáte žádné rezervace"
    }
   }
  },
  
  data: () => ({
    userID: '',
    aktivityCard: false,
    selectedAktivityCard: undefined,
    dialog: false,
    
    listOfAktivityTypes: [],
    selectedActivityTypes: [],
    listOfActivities: [],
    listOfMyActivities: [],
    
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
      });
    },
    
    getMyAktivityList() {
    axios
      .post("https://mytestwww.tode.cz/SCKaras/selectMyEvents.php", {
         sqlStringUserID: this.userID  
      })
      .then((response) => {
          this.listOfMyActivities = (response.data);
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
    },
    showAktivityCard(index){
      this.aktivityCard = !this.aktivityCard;
      this.selectedAktivityCard = index;
      console.log(this.listOfActivities);
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
.rezervaceStav{
  color: black;
}
.rightCollumn{
border-left: 1px solid gray;
}
#kontaktText{
  color: #64B5F6;
}

</style>
