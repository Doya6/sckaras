<template>
  <v-card class="mx-auto overflow-hidden">
    <v-app-bar color="light-blue lighten-3" dark>
      <v-app-bar-nav-icon class="hidden-md-and-up" @click="drawer = true"></v-app-bar-nav-icon>
      <router-link to="/">
        <v-img src='@/assets/LOGO-Karas.jpg' alt="logo" max-height="50" max-width="50"></v-img>
      </router-link>
      <v-toolbar-title class='ml-5 hidden-xs-only'>Společenské Centrum Karas</v-toolbar-title>
      <v-toolbar-title class='ml-5 hidden-sm-and-up'>SC Karas</v-toolbar-title>
      <v-spacer></v-spacer>
      <div class="hidden-sm-and-down">
        <v-btn to="/" color="amber lighten-1" class="mx-1">Home</v-btn>
        <v-btn to="/Aktivity" color="amber lighten-1" class="mx-1">Aktivity</v-btn>
        <v-btn to="/Fotogalerie" color="amber lighten-1" class="mx-1">Fotogalerie</v-btn>
        <v-btn to="/Contact"  color="amber lighten-1" class="mx-1">Kontakt</v-btn>
      </div>
      <v-spacer></v-spacer>
      
      <v-card
      class="mx-auto"
      max-width="344"
      disabled
      flat
      color="light-blue lighten-3" dark
    >
      <v-card-text  class=" text--primary text-center">
        <div class="white--text">Uživatel:</div>
        <div>{{ loggedUserName }}</div>
      </v-card-text>
    </v-card>
      
      <div>
        <v-icon
          large
          v-on:click="showLoginForm()"
        >
         mdi-account 
         </v-icon>
      </div>

      

    </v-app-bar>

    <v-navigation-drawer v-model="drawer" fixed temporary >
      <v-list nav dense>
        <v-list-item-group
          v-model="group"
          active-class="light-blue lighten-3"
        >
          <v-list-item to="/" >
            <v-list-item-icon>
              <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item>

          <v-list-item to="/Aktivity" >
            <v-list-item-icon>
              <v-icon>mdi-calendar-month</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Aktivity</v-list-item-title>
          </v-list-item>

          <v-list-item to="/Fotogalerie" >
            <v-list-item-icon>
              <v-icon>mdi-image</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Fotogalerie</v-list-item-title>
          </v-list-item>
         
          <v-list-item to="/Contact" >
            <v-list-item-icon>
              <v-icon>mdi-phone</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Kontakt</v-list-item-title>
          </v-list-item>

        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <!-- Login Form -->
          <div v-if="loginShow">
            <v-dialog v-model="dialog" max-width="600px" min-width="360px">
              <div>
                <v-tabs
                  v-model="tab"
                  show-arrows
                  background-color="light-blue lighten-3"
                  icons-and-text
                  dark
                  grow
                >
                  <v-tabs-slider color="light-blue lighten-3"></v-tabs-slider>
                  <v-tab v-for="i in tabs" :key="i">
                    <v-icon large>{{ i.icon }}</v-icon>
                    <div class="caption py-1">{{ i.name }}</div>
                  </v-tab>
                  <v-tab-item>
                    <v-card class="px-4">
                      <v-card-text>
                        <v-form ref="loginForm" v-model="valid" lazy-validation>
                          <v-row>
                            <v-col cols="12">
                              <v-text-field
                                v-model="loginEmail"
                                :rules="loginEmailRules"
                                label="E-mail"
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                v-model="loginPassword"
                                :append-icon="show1 ? 'eye' : 'eye-off'"
                                :rules="[rules.required, rules.min]"
                                :type="show1 ? 'text' : 'password'"
                                name="input-10-1"
                                label="Heslo"
                                hint="At least 8 characters"
                                counter
                                @click:append="show1 = !show1"
                              ></v-text-field>
                            </v-col>
                            <v-col class="d-flex" cols="12" sm="6" xsm="12"> </v-col>
                            <v-spacer></v-spacer>
                            <v-col class="d-flex" cols="12" sm="3" xsm="12" align-end>
                              <v-btn
                                x-large
                                block
                                :disabled="!valid"
                                color="success lighten-2"
                                @click="validate"
                              >
                                Login
                              </v-btn>
                            </v-col>
                          </v-row>
                        </v-form>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                  <v-tab-item>
                    <v-card class="px-4">
                      <v-card-text>
                        <v-form ref="registerForm" v-model="valid" lazy-validation>
                          <v-row>
                            <v-col cols="12" sm="6" md="6">
                              <v-text-field
                                v-model="userName"
                                :rules="[rules.required]"
                                label="Uživatelské jméno"
                                maxlength="20"
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                v-model="email"
                                :rules="emailRules"
                                label="E-mail"
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                              <v-text-field
                                v-model="phoneNumber"
                                
                                label="Telefon"
                                maxlength="16"
                                
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                v-model="password"
                                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                :rules="[rules.required, rules.min]"
                                :type="show1 ? 'text' : 'password'"
                                name="input-10-1"
                                label="Heslo"
                                hint="Alespoň 8 znaků"
                                counter
                                @click:append="show1 = !show1"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field
                                block
                                v-model="verify"
                                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                :rules="[rules.required, passwordMatch]"
                                :type="show1 ? 'text' : 'password'"
                                name="input-10-1"
                                label="Potvrzení hesla"
                                counter
                                @click:append="show1 = !show1"
                              ></v-text-field>
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                              <v-btn
                                x-large
                                block
                                :disabled="!valid"
                                color="success lighten-2"
                                @click="validate"
                                >Register</v-btn
                              >
                            </v-col>
                          </v-row>
                        </v-form>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                </v-tabs>
              </div>
            </v-dialog>
          </div>

  </v-card>
  
</template>


<script>
export default {
  computed: {
    passwordMatch() {
      return () => this.password === this.verify || "Hesla vzájemně nesouhlasí";
    },
  },
  methods: {
    showLoginForm(){
      this.loginShow = true;
      this.dialog = true;
    },
    validate() {
      if (this.$refs.loginForm.validate()) {
        this.loginPassword = '';
        this.loginEmail = '';
        this.loginShow = false;
        alert("jakoze Odeslano");
        
      }
      if (this.$refs.registerForm.validate()) {
        
        if (this.$refs.testExistsInDB(users, this.userName)){
          alert("user OK");
          alert("jakoze success");
          this.userName = '';
          this.phoneNumber = '';
          this.email = '';
          this.password = '';
          this.verify = '';
          this.loginShow = false;
        } else this.userName = 'zadej jine';
      }
    },
    testExistsInDB(db_table, db_value){
      return false;    
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
  },
  data: () => ({
    drawer: false,
    group: null,
    loggedUserName: 'JaJsemLogged',

    loginShow: false,
    dialog: true,
    tab: 0,
    tabs: [
      { name: "Přihlášení", icon: "mdi-account" },
      { name: "Registrace", icon: "mdi-account-outline" },
    ],
    valid: true,

    userName: "",
    phoneNumber: "",
    email: "",
    password: "",
    verify: "",
    
    loginPassword: "",
    loginEmail: "",
    loginEmailRules: [
      (v) => !!v || "Musí být vyplněno",
      (v) => /.+@.+\..+/.test(v) || "E-mail není platný",
    ],
    emailRules: [
      (v) => !!v || "Musí být vyplněno",
      (v) => /.+@.+\..+/.test(v) || "E-mail není platný",
    ],

    show1: false,
    rules: {
      required: (value) => !!value || "Musí být vyplněno",
      min: (v) => (v && v.length >= 8) || "Min 8 znaků",
    },
  }),
};
</script>



<style scoped>
 
</style>
