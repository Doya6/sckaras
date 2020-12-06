<template>
  <div>
    <v-container v-if="this.actUserLevel === '1' || this.actUserLevel === '2'">
      <v-card class="pa-5 mx-auto mt-5" width="500px">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-select
            v-model="selectedType"
            :items="listOfAktivityTypes"
            :rules="[(v) => !!v || 'Položka je povinná']"
            label="Typ aktivity"
            required
            item-text="eventTypeDesc"
            item-value="eventTypeDesc"
          >
          </v-select>

          <v-text-field
            v-model="nazev"
            :counter="100"
            :rules="[(v) => !!v || 'Položka je povinná']"
            label="Název aktivity"
            required
          >
          </v-text-field>

          <v-textarea
            v-model="popis"
            :counter="300"
            :rules="[(v) => !!v || 'Položka je povinná']"
            name="popis"
            label="Popis aktivity"
            required
            value=""
            hint=""
          >
          </v-textarea>

          <v-row>
            <!-- START DATE  ---------------------------------->
            <v-col cols="6" sm="6" md="6">
              <v-menu
                v-model="menu2"
                :rules="[(v) => !!v || 'Položka je povinná']"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="startDate"
                    label="Start date"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    :rules="[(v) => !!v || 'Položka je povinná']"
                  ></v-text-field>
                </template>
                <v-date-picker
                  v-model="startDate"
                  @input="menu2 = false"
                  locale="cz"
                ></v-date-picker>
              </v-menu>
            </v-col>
            <!-- START TIME  ---------------------------------->
            <v-col cols="6" sm="6" md="6">
              <v-menu
                ref="menu8"
                v-model="menu1"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="startTime"
                    label="Start time"
                    prepend-icon="mdi-clock-time-four-outline"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    :rules="[(v) => !!v || 'Položka je povinná']"
                  ></v-text-field>
                </template>
                <v-time-picker
                  v-if="menu1"
                  v-model="startTime"
                  full-width
                  format="24hr"
                  @click:minute="$refs.menu8.save()"
                ></v-time-picker>
              </v-menu>
            </v-col>
          </v-row>
          <v-row>
            <!-- END DATE  ---------------------------------->
            <v-col cols="6" sm="6" md="6">
              <v-menu
                v-model="menu4"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="endDate"
                    label="End date"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    :rules="[(v) => !!v || 'Položka je povinná']"
                  ></v-text-field>
                </template>
                <v-date-picker
                  v-model="endDate"
                  @input="menu4 = false"
                  locale="cz"
                ></v-date-picker>
              </v-menu>
            </v-col>
            <!-- END TIME  ---------------------------------->
            <v-col cols="6" sm="6" md="6">
              <v-menu
                ref="menu9"
                v-model="menu3"
                :rules="[(v) => !!v || 'Položka je povinná']"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="endTime"
                    label="End time"
                    prepend-icon="mdi-clock-time-four-outline"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    :rules="[(v) => !!v || 'Položka je povinná']"
                  ></v-text-field>
                </template>
                <v-time-picker
                  v-if="menu3"
                  v-model="endTime"
                  full-width
                  format="24hr"
                  @click:minute="$refs.menu9.save()"
                ></v-time-picker>
              </v-menu>
            </v-col>
          </v-row>
          <!-- MIN OSOB ---------------------------------->
          <v-row>
            <v-col cols="6">
              <v-text-field
                id="maxMinOsob"
                v-model.number="minAttendees"
                label="min osob"
                append-outer-icon="mdi-plus-box"
                @click:append-outer="incrementMIN"
                prepend-icon="mdi-minus-box"
                @click:prepend="decrementMIN"
                :rules="[(v) => v > 0 || 'Položka je povinná']"
              >
              </v-text-field>
            </v-col>
            <!-- MAX OSOB ---------------------------------->
            <v-col cols="6">
              <v-text-field
                id="maxMinOsob"
                v-model.number="maxAttendees"
                label="max osob"
                append-outer-icon="mdi-plus-box"
                @click:append-outer="incrementMAX"
                prepend-icon="mdi-minus-box"
                @click:prepend="decrementMAX"
                :rules="[(v) => v > 0 || 'Položka je povinná']"
              >
              </v-text-field>
            </v-col>
          </v-row>
          <v-row justify="space-around">
            <v-btn color="warning" v-on:click="resetValidation" class="my-1">
              Vymazat ověření
            </v-btn>
            <v-btn color="error" v-on:click="reset" class="my-1"> Vymazat </v-btn>
            <v-btn :disabled="!valid" color="success" v-on:click="validate" class="my-1">
              Odeslat
            </v-btn>
          </v-row>
        </v-form>
      </v-card>
    </v-container>
    <p v-else>Pro vstup na tuto stránku nemáte oprávnění.</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  mounted() {
    this.actUserLevel = this.$store.getters.getUserLevel;
    this.actUserID = this.$store.getters.getUserID;
  },
  created() {
    this.getAktivityTypeList();
  },

  data() {
    return {
      actUserLevel: "",
      actUserID: "",
      listOfAktivityTypes: [],

      valid: true,

      selectedType: "",
      selectedTypeID: "",

      nazev: "",
      nazevRules: [
        (v) => !!v || "Název je povinná položka",
        (v) => (v && v.length <= 100) || "Název musí mít maximálně 100 znaků",
      ],

      popis: "",
      popisRules: [
        (v) => !!v || "Popis je povinná položka",
        (v) => (v && v.length <= 300) || "Popis musí mít maximálně 300 znaků",
      ],

      startTime: null,
      menu1: false,
      modal: false,

      startDate: new Date().toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu2: false,

      endTime: null,
      menu3: false,
      modal: false,

      endDate: new Date().toISOString().substr(0, 10),
      menu: false,
      modal: false,
      menu4: false,

      startDateTime: "",
      endDateTime: "",

      minAttendees: "1",
      maxAttendees: "10",
    };
  },

  methods: {
    getAktivityTypeList() {
      axios
        .post("https://mytestwww.tode.cz/SCKaras/selectEventTypeList.php", {})
        .then((response) => {
          this.listOfAktivityTypes = response.data;
        });
    },

    incrementMIN() {
      if (this.minAttendees === undefined) {
        this.minAttendees = 0;
      }
      this.minAttendees++;
    },
    decrementMIN() {
      if (this.minAttendees > 0) {
        this.minAttendees--;
      }
      if (this.minAttendees === undefined) {
        this.minAttendees = 1;
      }
    },
    incrementMAX() {
      if (this.maxAttendees === undefined) {
        this.maxAttendees = 0;
      }
      this.maxAttendees++;
    },
    decrementMAX() {
      if (this.maxAttendees > 0) {
        this.maxAttendees--;
      }
      if (this.maxAttendees === undefined) {
        this.maxAttendees = 1;
      }
    },

    validate() {
      this.$refs.form.validate();
      if (this.valid) {
        this.startDateTime = this.startDate + " " + this.startTime;
        this.endDateTime = this.endDate + " " + this.endTime;
        this.selectedTypeID = this.listOfAktivityTypes[
          this.listOfAktivityTypes.findIndex(
            (x) => x.eventTypeDesc == this.selectedType
          )
        ].eventType_id;
        axios
          .post("https://mytestwww.tode.cz/SCKaras/insertIntoSQL.php", {
            insertIntoTable: "Events",
            insertIntoColumns:
              "eventType_id, eventName, eventDesc, eventStartDate, eventEndDate, minSumOfAttendees, maxSumOfAttendees, initializator_id",
            insertValues: `'${this.selectedTypeID}', '${this.nazev}', '${this.popis}', '${this.startDateTime}', '${this.endDateTime}', '${this.minAttendees}', '${this.maxAttendees}', '${this.actUserID}'`,
          })
          .then((response) => {
            console.log(response.data);
            alert("Nová aktivita byla založna");
            this.reset();
          });
      }
    },

    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
  },
};
</script>




<style scoped>
v-input input #maxMinOsob {
  text-align: center;
}
</style>
