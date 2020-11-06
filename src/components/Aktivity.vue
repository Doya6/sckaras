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
          <v-col  cols="6" xs="8" class = "pl-2" align="start">
            <p class="mb-0"> {{ activity.eventStartDate.slice(0, -3) }}</p>
            <p class="mb-0"> {{ activity.eventDesc }}</p>
          </v-col>
          <v-spacer></v-spacer>
          <v-col  cols="6" xs="4" class = "pr-2" align="end">
            <v-btn
              depressed v-on:click=naCoSiKliknul(index)
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
          <h2 > User ID: {{ loggedUserId }} </h2>
      </div>
      </v-card>
      
    </div>
</template>

<script>
import axios from'axios'

export default {
  props: { 
    loggedUser: {
      type: Object,
      required: true,
    }
  },
  mounted() {
    this.getAktivityTypeList(),
    this.getAktivityList()
  },
 
  data: () => ({
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
        
      })
      .then((response) => {
          this.listOfActivities = (response.data);
      });
    },
    
    addToSelectedActivityTypes(TypeId){
      if (this.selectedActivityTypes.includes(TypeId)) {
        this.selectedActivityTypes.splice(this.selectedActivityTypes.indexOf(TypeId), 1);
    } else
      this.selectedActivityTypes.push(TypeId);
    },

    applyTypeFilter(){
      this.dialog = false;
    },

    naCoSiKliknul(index){
      alert(`Kliknul si na index ${index}`)
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
