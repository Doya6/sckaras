<template>
  <div>
    <!-- MOJE REZERVACE ------------------------------------------------------------------>
    <v-row no-gutters align="center" class="light-blue lighten-3 white--text">
      <v-col class="pl-4 rows" cols="12">
        <h3 class="py-3">
          Moje rezervace
          <span class="rezervaceStav px-6 body-2"> {{ rezervaceStav }}</span>
        </h3>
      </v-col>
    </v-row>
    <div>
      <v-row
        v-for="(myActivity, index) in listOfMyActivities"
        v-bind:key="index"
        class="rows px-3"
      >
        <v-col
          cols="6"
          xs="5"
          sm="7"
          md="8"
          lg="9"
          class="pl-2 pr-0"
          align="start"
        >
          <h5 class="mb-0">
            {{ myActivity.eventStartDate.slice(0, -3) }} -
            {{ myActivity.eventEndDate.slice(11, -3) }} hod
          </h5>
          <p class="mb-0">{{ myActivity.eventName }}</p>
        </v-col>
        <v-col
          cols="2"
          xs="2"
          sm="2"
          md="2"
          lg="1"
          class="pl-2 pr-0"
          align="center"
        >
          <p class="my-0 hidden-xs-only">obsazenost</p>
          <p class="my-0 hidden-sm-and-up">obs.</p>
          <p class="my-0">
            {{ myActivity.mySUM == null ? 0 : myActivity.mySUM }}/{{
              myActivity.maxSumOfAttendees
            }}
          </p>
        </v-col>
        <v-col cols="4" xs="5" sm="2" md="2" lg="2" class="pr-2" align="end">
          <v-btn
            depressed
            v-on:click="zrusitRezervaci(myActivity.myEventID)"
            v-bind:disabled="Date.parse(myActivity.eventStartDate) < datum"
            >Zrušit</v-btn
          >
        </v-col>
      </v-row>
    </div>
    <!-- KALENDAR ------------------------------------------------------------------>
    <v-row no-gutters align="center" class="light-blue lighten-3 white--text">
      <v-col class="pl-4" cols="6">
        <h3 class="py-3">Kalendář aktivit</h3>
      </v-col>
      <v-col class="pr-4" cols="6" align="end">
        <v-btn v-on:click="aktivityFilter()" color="light-blue lighten-3">
          Filtr aktivit
        </v-btn>
      </v-col>
    </v-row>
    <!-- VYBER TYPU ---------------------------------------------------------------->
    <v-dialog v-model="aktFilter" max-width="350px" min-width="200px">
      <v-list class="pa-0">
        <v-list-item
          v-for="(type, i) in listOfAktivityTypes"
          v-bind:key="i"
          class="mx-4"
        >
          <v-list-item-content>
            <v-list-item-title v-text="type.eventTypeDesc"></v-list-item-title>
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
          <v-btn
            v-model="selectedActivityTypes"
            v-on:click="applyTypeFilter()"
            class="mx-auto"
            mb="0"
            width="100%"
            color="light-blue lighten-3"
          >
            Použít filtr
          </v-btn>
        </v-row>
      </v-list>
    </v-dialog>
    <!-- VYBER TYPU ^^^^ ---------------------------------------------------------------------->
    <v-card height="450px" class="px-3 mx-auto scroll">
      <v-row
        v-for="(activity, index) in listOfActivities"
        v-bind:key="index"
        class="rows"
      >
        <v-col
          v-on:click="showAktivityCard(index)"
          cols="6"
          xs="5"
          sm="7"
          md="8"
          lg="9"
          class="pl-2 pr-0"
          align="start"
        >
          <h5 class="mb-0">
            {{ activity.eventStartDate.slice(0, -3) }} -
            {{ activity.eventEndDate.slice(11, -3) }} hod
          </h5>
          <p class="mb-0">{{ activity.eventName }}</p>
        </v-col>
        <v-col
          cols="2"
          xs="2"
          sm="2"
          md="2"
          lg="1"
          class="pl-2 pr-0"
          align="center"
          v-on:click="obsazenostUserNameShow(activity.event_id)"
        >
          <p class="my-0 hidden-xs-only">obsazenost</p>
          <p class="my-0 hidden-sm-and-up">obs.</p>
          <p class="my-0">
            {{ activity.mySUM == null ? 0 : activity.mySUM }}/{{
              activity.maxSumOfAttendees
            }}
          </p>
        </v-col>
        <v-col cols="4" xs="5" sm="2" md="2" lg="2" class="pr-2" align="end">
          <v-btn
            depressed
            v-on:click="rezervovat(activity.myEventID)"
            v-bind:disabled="
              activity.mySUM == activity.maxSumOfAttendees ||
              userID == '' ||
              Date.parse(activity.eventStartDate) < datum ||
              activity.eventCancelDate != '0000-00-00 00:00:00'
            "
          >
            {{ btnPopis(index) }}
          </v-btn>
        </v-col>
      </v-row>
    </v-card>
    <!-- aktivity Card -------------------------------------------------->
    <v-dialog
      v-if="aktivityCard"
      v-model="aktivityCard"
      max-width="600px"
      min-width="360px"
    >
      <div>
        <v-card
          class="mx-auto"
          max-width="600"
          min-width="360px"
          outlined
          min-height="200px"
        >
          <v-row no-gutters id="closeIcon"
            ><v-icon v-on:click="showAktivityCard(index)" small
              >mdi-close</v-icon
            ></v-row
          >
          <v-row no-gutters class="px-3 pb-3">
            <v-col class="pr-3" xs="7" sm="8">
              <div class="mb-2">
                {{
                  listOfActivities[selectedAktivityCard].eventStartDate.slice(
                    0,
                    -3
                  )
                }}
                -
                {{
                  listOfActivities[selectedAktivityCard].eventEndDate.slice(
                    11,
                    -3
                  )
                }}
                hod
              </div>
              <div class="headline mb-1 pl-2">
                {{ listOfActivities[selectedAktivityCard].eventName }}
              </div>
              <div>{{ listOfActivities[selectedAktivityCard].eventDesc }}</div>
              <div align="end" class="mt-4">
                obsazeno
                {{
                  listOfActivities[selectedAktivityCard].mySUM == null
                    ? 0
                    : listOfActivities[selectedAktivityCard].mySUM
                }}
                míst z
                {{ listOfActivities[selectedAktivityCard].maxSumOfAttendees }}
                <span>
                  <v-btn
                    depressed
                    v-on:click="
                      rezervovat(
                        listOfActivities[selectedAktivityCard].myEventID
                      )
                    "
                    align="end"
                    v-bind:disabled="
                      listOfActivities[selectedAktivityCard].mySUM ==
                        listOfActivities[selectedAktivityCard]
                          .maxSumOfAttendees ||
                      userID == '' ||
                      Date.parse(
                        listOfActivities[selectedAktivityCard].eventStartDate
                      ) < datum ||
                      listOfActivities[selectedAktivityCard].eventCancelDate !=
                        '0000-00-00 00:00:00'
                    "
                    class="ml-2"
                  >
                    {{ btnPopis(selectedAktivityCard) }}
                  </v-btn>
                </span>
              </div>
            </v-col>

            <v-col xs="5" sm="4" align="end" class="rightColumn">
              <v-list-item-avatar tile size="80" color="grey">
                <v-img
                  height="100%"
                  width="100%"
                  v-bind:src="`https://mytestwww.tode.cz/SCKaras/AvatarPics/${listOfActivities[selectedAktivityCard].initializator_id}.jpg`"
                ></v-img>
              </v-list-item-avatar>
              <div class="mr-4 font-weight-light">Organizátor:</div>
              <div class="mr-4" id="kontaktText">
                {{ listOfActivities[selectedAktivityCard].userName }}
              </div>
              <div class="mr-4 font-weight-light">Telefon:</div>
              <div class="mr-4" id="kontaktText">
                {{ listOfActivities[selectedAktivityCard].userPhoneNum }}
              </div>
              <div class="mr-4 font-weight-light">E-mail:</div>
              <div class="mr-4" id="kontaktText">
                {{ listOfActivities[selectedAktivityCard].userEmail }}
              </div>
              <div
                v-if="
                  userID ==
                    listOfActivities[selectedAktivityCard].initializator_id ||
                  this.actUserLevel == 1
                "
              >
                <v-btn
                  depressed
                  v-on:click="
                    zrusit(listOfActivities[selectedAktivityCard].myEventID)
                  "
                  align="end"
                  v-bind:disabled="
                    listOfActivities[selectedAktivityCard].mySUM ==
                      listOfActivities[selectedAktivityCard]
                        .maxSumOfAttendees ||
                    userID == '' ||
                    Date.parse(
                      listOfActivities[selectedAktivityCard].eventStartDate
                    ) < datum ||
                    listOfActivities[selectedAktivityCard].eventCancelDate !=
                      '0000-00-00 00:00:00'
                  "
                  class="ml-2 mt-2"
                >
                  Zrušit událost
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-card>
      </div>
    </v-dialog>
    <!-- obsazenostUserName Card -------------------------------------------------->
    <v-dialog v-model="obsazenostUserName" max-width="320px" min-width="250px">
      <v-list class="pa-0">
        <h4 class="ml-2" >Na tuto aktivitu jsou přihlášeni uživatelé:</h4>
        <v-list-item
          v-for="(obsName, index) in obsazenostNames"
          v-bind:key="index"
          class="ml-4"
        > 
          <div v-text="obsName.userName"></div>
        </v-list-item>
      </v-list>
    </v-dialog>
  </div>
</template>

<script>
import axios from "axios";

export default {
  mounted() {},

  created() {
    this.userID = this.$store.getters.getUserID;
    this.actUserLevel = this.$store.getters.getUserLevel;
    this.getAktivityTypeList();
    this.getMyAktivityList();
    this.getAktivityList();
  },

  computed: {
    rezervaceStav: function () {
      if (this.userID == "") {
        return "- pro zobrazení vašich rezervací se musíte přihlásit";
      }
      if (this.listOfMyActivities.length == 0) {
        return "- nemáte žádné rezervace";
      }
    },
  },

  data: () => ({
    userID: "",
    actUserLevel: "",
    aktivityCard: false,
    obsazenostUserName: false,
    obsazenostNames: [],
    selectedAktivityCard: undefined,
    dialog: false,
    aktFilter: false,
    listOfAktivityTypes: [],
    selectedActivityTypes: [],
    listOfActivities: [],
    listOfMyActivities: [],
    datum: Date.now(),
    //datum: new Date().toISOString().substr(0, 16),
  }),

  methods: {
    getAktivityTypeList() {
      axios
        .post("https://mytestwww.tode.cz/SCKaras/selectEventTypeList.php", {})
        .then((response) => {
          this.listOfAktivityTypes = response.data;
        });
    },

    getAktivityList() {
      axios
        .post("https://mytestwww.tode.cz/SCKaras/selectEvents.php", {
          sqlStringWhere: this.selectedActivityTypes,
        })
        .then((response) => {
          this.listOfActivities = response.data;
        });
    },

    getMyAktivityList() {
      axios
        .post("https://mytestwww.tode.cz/SCKaras/selectMyEvents.php", {
          sqlStringUserID: this.userID,
        })
        .then((response) => {
          this.listOfMyActivities = response.data;
          console.log(this.listOfMyActivities);
        });
    },

    addToSelectedActivityTypes(TypeId) {
      if (this.selectedActivityTypes.includes(TypeId)) {
        this.selectedActivityTypes.splice(
          this.selectedActivityTypes.indexOf(TypeId),
          1
        );
      } else this.selectedActivityTypes.push(TypeId);
    },

    applyTypeFilter() {
      this.getAktivityList();
      this.aktFilter = false;
    },

    rezervovat(eventId) {
      if (this.foundInSQL) {
        alert(`Uživatelský e-mail ${this.email} už byl zaregistrován.`);
        this.email = "";
      } else {
        axios
          .post("https://mytestwww.tode.cz/SCKaras/insertIntoSQL.php", {
            insertIntoTable: "Rezrvs",
            insertIntoColumns: "event_id, User_id",
            insertValues: `'${eventId}', '${this.userID}'`,
          })
          .then(() => {
            this.getAktivityList();
            this.getMyAktivityList();
            alert("Rezervace byla provedena");
            this.aktivityCard = false;
          });
      }
    },

    zrusitRezervaci(eventId) {
      console.log(eventId);
      console.log(this.userID);
      axios
        .post("https://mytestwww.tode.cz/SCKaras/cancelRezrvs.php", {
          eventID: eventId,
          userID: this.userID,
        })
        .then((response) => {
          this.getMyAktivityList();
          this.getAktivityList();
          alert("Rezervace byla zrušena");
        });
    },

    aktivityFilter() {
      this.aktFilter = !this.aktFilter;
    },

    showAktivityCard(index) {
      this.aktivityCard = !this.aktivityCard;
      this.selectedAktivityCard = index;
    },

    zrusit(myEventID) {
      if (confirm("Událost bude označena jako zrušená")) {
        let datum = new Date().toISOString().substr(0, 16);
        axios
          .post("https://mytestwww.tode.cz/SCKaras/cancelEvent.php", {
            event: myEventID,
            date: datum,
          })
          .then((response) => {
            console.log(this.datum);
            console.log(response.data);
            this.getMyAktivityList();
            this.getAktivityList();
            alert("Aktivita byla zrušena");
          });
      }
    },

    btnPopis(myEventID) {
      let byloZruseno =
        this.listOfActivities[myEventID].eventCancelDate !=
        "0000-00-00 00:00:00";
      return byloZruseno ? "Zrušeno" : "Rezervovat";
    },
    obsazenostUserNameShow(eventID) {
      axios
        .post("https://mytestwww.tode.cz/SCKaras/selectObsNames.php", {
          event: eventID,
        })
        .then((response) => {
          this.obsazenostNames = response.data;
          if (this.obsazenostNames.length != 0){
          this.obsazenostUserName = !this.obsazenostUserName;
          }
          console.log(this.obsazenostNames);
        });
    },
  },
};
</script>






<style scoped>
.scroll {
  overflow-y: scroll;
}
.rows {
  border-bottom: 1px solid Lightgray;
}
.click-enabled {
  pointer-events: all;
  cursor: pointer;
}
.click-disabled {
  pointer-events: none;
}
.rezervaceStav {
  color: black;
}
.rightColumn {
  border-left: 1px solid gray;
}
#kontaktText {
  color: #64b5f6;
}
#closeIcon {
  position: absolute;
  right: 1%;
  top: 2%;
}
</style>
