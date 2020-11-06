<template>
    <div>
      <v-row no-gutters align="center" class='light-blue lighten-3 white--text'>
        
        <v-col class="pl-4" cols="6">
          <h3>Kalendář aktivit</h3>
        </v-col>
      
        <v-col class="pr-4" cols="6" align="end">
          <v-btn v-on:click="aktivityFilter()" height="90%"   >
            Typ aktivity - filtr
          </v-btn>
        </v-col>

      </v-row>

      <v-dialog  v-model="dialog" max-width="350px" min-width="200px" >
        <v-list>
          <v-list-item-group 
            multiple
            color="gray"
          >
            <v-list-item
              v-for="(type, i) in listOfAktivityTypes"
              :key="i"
              class="mx-6" 
            >
              <v-list-item-content>
                <v-list-item-title v-text="type.eventTypeDesc" ></v-list-item-title>
              </v-list-item-content>

              <v-list-item-action>
                <v-checkbox
                  
                  color="light-blue lighten-3"
                ></v-checkbox>
              </v-list-item-action>

            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-dialog>

      <v-card height="350px" 
      class='px-3 mx-auto scroll'>
      
        <v-row
          v-for="(activity, index) in listOfActivities"
          v-bind:key="index"
          class = "rows"
        >
        <p class = ml-6 > Termín: {{ listOfActivities.eventStartDate }}</p>
        <p class = ml-6 > Název aktivity: {{ listOfActivities.eventDesc }}</p>
        <v-spacer></v-spacer>
        <v-btn
        depressed v-on:click=naCoSiKliknul(index)
        class = mr-6
        >
          Rezervovat
        </v-btn>
        </v-row>
        <!-- <h2 > Datum now: {{ datum }} </h2> -->
     
      </v-card>
      <v-card height="300px"
      class='px-auto mx-auto mt-3'>
      <div>
          <h3 class='text-left pl-6 light-blue lighten-3 white--text'>Moje rezervace</h3>
          <h2 > User ID: {{ loggedUserId }} </h2>
      </div>
      </v-card>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'
import axios from'axios'

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
  mounted() {
    this.getAktivityTypeList(),
    this.getAktivityList()
  },
  data: () => ({
    dialog: false,
    model: [1],
    
    listOfAktivityTypes: [],
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
        dateStart: Date.now(),
      })
      .then((response) => {
          this.listOfActivities = (response.data);
      });
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
