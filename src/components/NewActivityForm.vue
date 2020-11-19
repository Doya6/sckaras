<template>
  <div>
    <v-container v-if="this.actUserLevel === '1' || this.actUserLevel === '2'">
      <v-card class="pa-5 mx-auto mt-5" width="500px">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-select
            v-model="selectedType"
            :items="listOfAktivityTypes"
            :rules="[(v) => !!v || 'Item is required']"
            label="Typ aktivity"
            required
            item-text="eventTypeDesc"
            item-value="eventTypeDesc"
          >
          </v-select>

          <v-text-field
            v-model="nazev"
            :counter="100"
            label="Název aktivity"
            required
          >
          </v-text-field>

          <v-textarea
            v-model="popis"
            :counter="300"
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
                ref="menu"
                v-model="menu1"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="starTime"
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
                  ></v-text-field>
                </template>
                <v-time-picker
                  v-if="menu1"
                  v-model="startTime"
                  format="24hr"
                  full-width
                  @click:minute="$refs.menu.save(time)"
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
                ref="menu"
                v-model="menu3"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="endTime"
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
                  ></v-text-field>
                </template>
                <v-time-picker
                  v-if="menu3"
                  v-model="endTime"
                  format="24hr"
                  full-width
                  @click:minute="$refs.menu.save(time)"
                ></v-time-picker>
              </v-menu>
            </v-col>
          </v-row>
          <!-- MIN OSOB ---------------------------------->
          <v-row>
            <v-col cols="6">
            <v-text-field
              v-model.number="minAttendees" 
              label="min osob" 
              append-outer-icon="mdi-plus-box" 
              @click:append-outer="incrementMIN" 
              prepend-icon="mdi-minus-box" 
              @click:prepend="decrementMIN">
            </v-text-field>
            </v-col>
          <!-- MAX OSOB ---------------------------------->
            <v-col cols="6">
            <v-text-field
              v-model.number="maxAttendees" 
              label="max osob" 
              append-outer-icon="mdi-plus-box" 
              @click:append-outer="incrementMAX" 
              prepend-icon="mdi-minus-box" 
              @click:prepend="decrementMAX">
            </v-text-field>
            </v-col>
          </v-row>

          <v-checkbox
            v-model="checkbox"
            :rules="[(v) => !!v || 'You must agree to continue!']"
            label="Do you agree?"
            required
          >
          </v-checkbox>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="validate"
          >
            Validate
          </v-btn>

          <v-btn color="error" class="mr-4" @click="reset"> Reset Form </v-btn>

          <v-btn color="warning" @click="resetValidation">
            Reset Validation
          </v-btn>
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
  },
  created() {
    this.getAktivityTypeList();
  },

  computed: {},

  data() {
    return {
      actUserLevel: "",
      listOfAktivityTypes: [],

      valid: true,

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
      
      minAttendees: '1',
      maxAttendees: '10',

      selectedType: null,

      checkbox: false,
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
      this.minAttendees++
    },
    decrementMIN() {
    if(this.minAttendees >0){
      this.minAttendees--
      }
    },
    
    incrementMAX() {
      this.maxAttendees++
    },
    decrementMAX() {
      if(this.maxAttendees >0){
      this.maxAttendees--
      }
    },

    validate() {
      this.$refs.form.validate();
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




<style>
</style>
